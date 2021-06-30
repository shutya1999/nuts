<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 18.06.2021
 * Time: 09:42
 */

namespace app\modules\auth\controllers;


class MainController extends AppAuthController
{
    public function actionIndex(){
        return $this->render("index");
    }
}