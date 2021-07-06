<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 06.07.2021
 * Time: 12:35
 */

namespace app\models;


use yii\base\Model;

class ReviewForm extends Model
{
    public $name;
    public $phone;
    public $text;
    public $rating;

    public function rules()
    {
        return [
            [['name', 'phone', 'text', 'rating'], 'required'],
            ['text', 'trim'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => "Ім'я",
            'phone' => 'Телефон',
            'text' => 'Коментар',
            'rating' => 'Рейтинг'
        ];
    }
}