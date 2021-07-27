<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 26.07.2021
 * Time: 18:19
 */

namespace app\modules\account\models;

use Yii;
use yii\base\Model;
use app\models\User;

class SendEmailForm extends Model
{
    public $username;

    public function rules(){
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'email'],
            ['username', 'exist',
                'targetClass' => User::class,
                'message' => 'Така пошта відсутня'
            ],
        ];
    }

    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne(['username' => $this->username]);

        if($user):
            $user->generateSecretKey();
            if($user->save()):
                return Yii::$app->mailer->compose('resetPassword', ['user' => $user])
                    ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->name.' (відправлено роботом)'])
                    ->setTo($this->username)
                    ->setSubject('Скидання паролю для '.Yii::$app->name)
                    ->send();
            endif;
        endif;

        return false;
    }
}