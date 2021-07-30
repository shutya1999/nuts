<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 27.07.2021
 * Time: 15:12
 */

namespace app\models;


use yii\base\Model;

class CallbackForm extends Model
{
    public $name;
    public $phone;
    public $text;

    public function rules()
    {
        return [
            [['name', 'phone'], 'required'],
            ['text', 'trim']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'  => "Ім'я",
            'phone' => 'Телефон',
            'text'  => 'Питання'
        ];
    }
}