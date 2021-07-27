<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 26.07.2021
 * Time: 18:31
 */

namespace app\modules\account\models;


use yii\base\Model;
use app\models\User;
use yii\base\InvalidParamException;
use yii\base\InvalidArgumentException;

class ResetPasswordForm extends Model
{
    public $password;
    private $_user;

    public function rules()
    {
        return [
            ['password', 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Пароль'
        ];
    }

    public function __construct($key, $config = [])
    {
        if(empty($key) || !is_string($key))
            throw new InvalidArgumentException('Ключ не може бути порожнім');
        $this->_user = User::findBySecretKey($key);

        if(!$this->_user)
            throw new InvalidArgumentException('Не вірний ключ');
        parent::__construct($config);
    }

    public function resetPassword()
    {
        /* @var $user User */
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removeSecretKey();
        return $user->save();
    }

}