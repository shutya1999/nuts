<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 21.06.2021
 * Time: 13:45
 */

namespace app\controllers;


use app\models\PriceForm;
use app\models\Product;
use yii\web\Response;
use Yii;

class ProductController extends AppController
{
    public function actionView($url){
        $product = Product::find()->where(['url' => $url])->one();

        $options = json_decode($product->option);
        $price = [
            key($options) => current($options)[0]
        ];

        return $this->render("view", compact(['product', 'price']));
    }
}