<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.08.2015
 * Time: 15:38
 *
 * @var $user \app\models\User
 */
use yii\helpers\Html;

echo 'Привіт '.Html::encode($user->username).'. ';
echo Html::a('Для зміни паролю перейдіть за посиланням',
    Yii::$app->urlManager->createAbsoluteUrl(
        [
            'account/auth/reset-password',
            'key' => $user->secret_key
        ]
    ));