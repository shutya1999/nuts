<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 21.06.2021
 * Time: 13:45
 */

namespace app\controllers;


use app\models\EntryForm;
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

        $model = new EntryForm();
        $model->load(\Yii::$app->request->post());

        if (\Yii::$app->request->isAjax){
            \Yii::$app->response->format = Response::FORMAT_JSON;

            $gty = $model->qty;
            $volume = $model->volume;

            $options = json_decode($product->option);

            foreach (current($options) as $key => $option){
                if ($option->quantity == $volume){
//                    debug(current($options));
                    $priceAJAX = $option->price * $gty;
                    $data = [
                        'id' => $product->id,
                        'volume' => $volume,
                        'volume-type' => key($price),
                        'qty' => $gty,
                        'price' => $priceAJAX
                    ];
                    return $data;
                }
            }
//            debug($product->option);



//            debug($model);
        }
        return $this->render("view", compact(['product', 'price', 'model']));
    }
}