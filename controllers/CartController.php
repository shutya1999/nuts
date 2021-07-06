<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 22.06.2021
 * Time: 11:52
 */

namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\OrderProduct;
use app\models\Product;

class CartController extends AppController
{
    public function actionAdd($id, $qty, $volume){
        $product = Product::findOne($id);

        if (empty($product)){
            return false;
        }
        $session = \Yii::$app->session;
        $session->open();

        $cart = new Cart();

        $cart->addToCart($product, $volume, $qty);

        if (\Yii::$app->request->isAjax){
            return $this->renderPartial('cart-modal', compact('session'));
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionChangeCart($id, $volume, $qty){
//        echo $id;
        $product = Product::findOne($id);

        if (empty($product)){
            return false;
        }

        $session = \Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->changeCart($id, $volume, $qty);
    }

    public function actionShow(){
        $session = \Yii::$app->session;
        $session->open();

        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function actionDelItem($id, $volume){
        $session = \Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->recalc($id, $volume);

        if (\Yii::$app->request->isAjax){
            return $this->renderPartial('cart-modal', compact('session'));
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionCheckout(){
        $session = \Yii::$app->session;
        $session->open();

        return $this->render('checkout', compact('session'));
    }

    public function actionOrdering(){
        $this->setMeta("Оформлення замовлення");
        $session = \Yii::$app->session;

        $order = new Order();
        $order_product = new OrderProduct();

        if ($order->load(\Yii::$app->request->post())){

//            debug($order);
            $order->qty = $session['cart.qty'];
            $order->total = $session['cart.sum'];

            $transaction = \Yii::$app->getDb()->beginTransaction();

            if (!$order->save() || !$order_product->saveOrderProducts($session['cart'], $order->id)){
                \Yii::$app->session->setFlash("error", "Помилка оформлення заовлення");
                $transaction->rollBack();
            }
            else{
//                debug($order->name);
                $transaction->commit();
                \Yii::$app->session->setFlash("success", "Ваше замовлення прийнято");

                if ($order->payment_type === "Оплата при отриманні"){
                    try{
                        \Yii::$app->mailer->compose('order-admin', [
                            'session' => $session,
                            'order'   => $order])
                            ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
                            ->setTo(\Yii::$app->params['adminEmail'])
                            ->setSubject("Замовлення #{$order->id}")
                            ->send();

                        \Yii::$app->mailer->compose('order-user', ['session' => $session])
                            ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
                            ->setTo($order->email)
                            ->setSubject('Замовлення на сайті Nuts City')
                            ->send();
                    }catch (\Swift_TransportException $e){
                        //var_dump($e); die;
                    }
                }else{

                }


                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');

                return $this->refresh();
            }
        }

        return $this->render("ordering", compact('session', 'order'));
    }

}

