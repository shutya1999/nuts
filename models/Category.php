<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 12.06.2021
 * Time: 14:40
 */

namespace app\models;


use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public static function tableName()
    {
        return "category";
    }

}