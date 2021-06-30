<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 18.06.2021
 * Time: 10:20
 */

namespace app\modules\auth\controllers;
use Yii;


class AdminController extends AppAuthController
{

    public $layout = 'admin';


    public function actionIndex(){

        $this->validUser();

        return $this->render("index");

    }

    public function actionTest(){
        $this->validUser();
        return $this->render("test");
    }

    public function validUser(){
        if(!Yii::$app->user->identity->admin){
            return $this->redirect('/auth/personal-office');
        }
    }
}