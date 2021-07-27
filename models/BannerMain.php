<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 23.07.2021
 * Time: 12:37
 */

namespace app\models;


use yii\db\ActiveRecord;

class BannerMain extends ActiveRecord
{
    public static function tableName()
    {
        return "banner_main";
    }
}