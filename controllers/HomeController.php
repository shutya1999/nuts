<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 12.06.2021
 * Time: 12:10
 */

namespace app\controllers;

use app\models\Product;

class HomeController extends AppController
{
    public function actionIndex(){

        $offers = Product::find()->where(['is_offer' => 1])->limit(10)->all();
        return $this->render("index", compact('offers'));
    }
}