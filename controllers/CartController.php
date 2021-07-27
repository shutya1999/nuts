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
use app\models\User;
use Yii;

class CartController extends AppController
{
    public function actionAdd($id, $qty, $volume){
        $product = Product::findOne($id);

        if (empty($product)){
            return false;
        }
        $session = \Yii::$app->session;
        $session->open();
//        $session->destroy();
//        $session->de(['cart']);

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
        $deliverySettings = [];
        if (!Yii::$app->user->isGuest) {
            $user = User::findByUsername(Yii::$app->user->identity->username);
            $order = new Order();

            $order->user_id = $user->id;
            $order->name = $user->name;
            $order->last_name = $user->surname;
            $order->phone = $user->phone;
            $order->email = $user->username;
            $order->delivery_type = $user->delivery_type;
            $deliverySettings['delivery_type'] = $user->delivery_type;
            switch ($user->delivery_type){
                case "Нова Пошта":
                    $order->city = $user->city;
                    $order->department_np = $user->department_np;

                    $deliverySettings['city'] = $user->city;
                    $deliverySettings['department_np'] = $user->department_np;
                    break;
                case "Укрпошта":
                    $order->city = $user->city;
                    $order->patronymic = $user->patronymic;
                    $order->street = $user->street;
                    $order->index_ukr = $user->index_ukr;

                    $deliverySettings['city'] = $user->city;
                    $deliverySettings['patronymic'] = $user->patronymic;
                    $deliverySettings['street'] = $user->street;
                    $deliverySettings['index_ukr'] = $user->index_ukr;

                    break;
                case "Кур’єрська доставка":
                    $order->city = $user->city;
                    $order->street = $user->street;
                    $order->house_number = $user->house_number;
                    $order->apartment_number = $user->apartment_number;

                    $deliverySettings['city'] = $user->city;
                    $deliverySettings['street'] = $user->street;
                    $deliverySettings['house_number'] = $user->house_number;
                    $deliverySettings['apartment_number'] = $user->apartment_number;
                    break;
                case "Самовивіз":
                    break;
            }
        }else{
            $order = new Order();
        }

        $order_product = new OrderProduct();

        if ($order->load(\Yii::$app->request->post())){

            $order->qty = $session['cart.qty'];
            $order->total = $session['cart.sum'];

            $transaction = \Yii::$app->getDb()->beginTransaction();

            if (!$order->save() || !$order_product->saveOrderProducts($session['cart'], $order->id)){
                \Yii::$app->session->setFlash("error", "Помилка оформлення заовлення");
                $transaction->rollBack();
            }
            else{
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
//                        debug($e); die;
                    }
                }else{
//                    echo "LiqPay";
                }


                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');

                return $this->refresh();
            }
        }

        return $this->render("ordering", compact(['session', 'order', 'deliverySettings']));
    }

}

