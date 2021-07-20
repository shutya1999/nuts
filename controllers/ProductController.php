<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 21.06.2021
 * Time: 13:45
 */

namespace app\controllers;


use app\models\Product;
use app\models\ReviewForm;
use app\models\Reviews;
use Yii;

class ProductController extends AppController
{
    public function actionView($url){
        $product = Product::find()->where(['url' => $url])->one();

        $this->setMeta("{$product->title} - " . \Yii::$app->name, $product->keywords, $product->description);

        $options = json_decode($product->option);
        $price = [
            key($options) => current($options)[0]
        ];

        $model = new Reviews();

//        $review->load(\Yii::$app->request->post());

        if (\Yii::$app->request->post()){
            $model->product_id = $product->id;
            if ($model->load(\Yii::$app->request->post()) && $model->save()){
                $product->rating = Reviews::find()->where(['product_id' => $product->id])->average('rating');
                \Yii::$app->session->setFlash("success", "Ваш коментар додано");
                return $this->refresh();
            }else{
                \Yii::$app->session->setFlash("error", "Виникла помилка, спробуйте пізніше");
            }
        }
        return $this->render("view", compact(['product', 'price', 'model']));
    }
}

