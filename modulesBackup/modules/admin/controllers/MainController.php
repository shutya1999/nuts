<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 16.06.2021
 * Time: 18:42
 */

namespace app\modules\admin\controllers;
use app\models\LoginForm;
use Yii;


class MainController extends AppAdminController
{
    public function actionIndex(){
        return $this->render("index");
    }
    public function actionTest(){
        return $this->render("test");
    }
}