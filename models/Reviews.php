<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 21.06.2021
 * Time: 16:04
 */

namespace app\models;


use yii\db\ActiveRecord;

class Reviews extends ActiveRecord
{
    public static function tableName()
    {
        return "reviews";
    }

}