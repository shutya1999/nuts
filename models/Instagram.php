<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 21.07.2021
 * Time: 12:07
 */

namespace app\models;


use yii\db\ActiveRecord;

class Instagram extends ActiveRecord
{
    public static function tableName()
    {
        return 'instagram';
    }
}