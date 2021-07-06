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

        $review = new Reviews();
        $reviewForm = new ReviewForm();

        if ($reviewForm->load(Yii::$app->request->post()) && $reviewForm->validate()){

//            debug($reviewForm);

            if ($reviewForm->rating > 0 && $reviewForm->rating < 6){
                $review->product_id = $product->id;
                $review->name = $reviewForm->name;
                $review->phone = $reviewForm->phone;
                $review->text = $reviewForm->text;
                $review->rating = $reviewForm->rating;

//                $review->save();

                if ($review->save()){
                    \Yii::$app->session->setFlash("success", "Ваш коментар додано");
                    $product->rating = Reviews::find()->where(['product_id' => $product->id])->average('rating');
                    $product->save();

                    return $this->refresh();
                }

            }else{
                \Yii::$app->session->setFlash("error", "Виникла помилка, спробуйте пізніше");
            }
        }

        return $this->render("view", compact(['product', 'price', 'reviewForm']));
    }
}