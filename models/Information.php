<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 21.07.2021
 * Time: 16:45
 */

namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;

class Information extends ActiveRecord
{
    public static function tableName()
    {
        return 'info';
    }
}