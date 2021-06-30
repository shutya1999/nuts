<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 18.06.2021
 * Time: 09:12
 */

namespace app\modules\admin\controllers;


use yii\web\Controller;

class UserController extends Controller
{
    public function actionIndex(){
        return $this->render("index");
    }
}