<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 01.07.2021
 * Time: 18:29
 */

namespace app\models;


use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return "orders";
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name', 'last_name', 'phone', 'email', 'delivery_type'], 'required'],
            ['note', 'trim'],
            [['city', 'department_np', 'street', 'index_ukr', 'house_number', 'apartment_number', 'payment_type'], 'trim'],
            ['email', 'email'],
            [['created_at', 'update_at'], 'safe'],
            [['qty', 'total'], 'integer'],
            [['status', 'consultation'], 'boolean']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => "Ім'я",
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'last_name' => 'Прізвище',
//            'address' => 'Адрес',
//            'note' => 'Примечание',
        ];
    }

}