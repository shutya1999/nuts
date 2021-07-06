<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 21.06.2021
 * Time: 16:04
 */

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;



use yii\db\ActiveRecord;

class Reviews extends ActiveRecord
{
    public static function tableName()
    {
        return "reviews";
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['created_at'], 'safe']
        ];
    }

}