<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 16.06.2021
 * Time: 18:42
 */

namespace app\modules\admin\controllers;


use yii\web\Controller;
use yii\filters\AccessControl;

class AppAdminController extends Controller
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