<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 26.07.2021
 * Time: 17:31
 */

namespace app\modules\account\models;


use yii\base\Model;
use app\models\User;

class SignupForm extends Model
{
    public $name;
    public $phone;
    public $username;
    public $password;

    public function rules() {
        return [
            [['username', 'password', 'phone', 'name'], 'required',],
            //['username', 'email'],
            ['username', 'unique', 'targetClass' => User::class,  'message' => 'Ця пошта вже зайнята'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'E-mail',
            'password' => 'Пароль',
            'phone' => 'Телефон',
            'name' => "Ім'я",
        ];
    }

}