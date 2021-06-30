<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 18.06.2021
 * Time: 09:41
 */

namespace app\modules\auth\controllers;


use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;


class AppAuthController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}