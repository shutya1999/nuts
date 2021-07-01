<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 01.07.2021
 * Time: 10:26
 */

namespace app\controllers;


use app\models\Product;
use yii\web\Controller;
use yii\web\Response;


class PriceController extends Controller
{
    public function actionGetPrice($id, $qty, $volume){
        if (\Yii::$app->request->isAjax){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $product = Product::findOne($id);

            $options = json_decode($product->option);

            foreach (current($options) as $key => $option){
                if ($option->quantity == $volume){
                    $priceAJAX = $option->price * $qty;
                    $data = [
                        'id' => $id,
                        'volume' => $volume,
                        'volume-type' => key($options),
                        'qty' => $qty,
                        'price' => $priceAJAX
                    ];
                    return $data;
                }
            }
        }
    }
}