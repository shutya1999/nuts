<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 18.06.2021
 * Time: 09:58
 */

namespace app\modules\auth\controllers;
use Yii;


class PersonalOfficeController extends AppAuthController
{
    public $layout = 'personal-office';
    public function actionIndex(){
        $this->validUser();
        return $this->render("index");
    }
    public function validUser(){
        if(Yii::$app->user->identity->admin){
            return $this->redirect('/auth/admin');
        }
    }
}