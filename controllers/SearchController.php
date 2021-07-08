<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 07.07.2021
 * Time: 18:01
 */

namespace app\controllers;


use app\models\Product;

class SearchController extends AppController
{
    public function actionView($val){
        if ($val != ""){
            $product = Product::find()->where(['like', 'title', $val])->all();
            $count = count($product);

            return $this->renderPartial("view", compact(['product', 'count', 'val']));
        }
    }

}