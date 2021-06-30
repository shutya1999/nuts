<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 22.06.2021
 * Time: 11:52
 */

namespace app\controllers;


use app\models\Cart;
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
//        unset($_SESSION);

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

}

