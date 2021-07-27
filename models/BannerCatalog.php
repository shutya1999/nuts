<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 27.07.2021
 * Time: 13:02
 */

namespace app\models;


use yii\db\ActiveRecord;

class BannerCatalog extends ActiveRecord
{
    public static function tableName()
    {
        return "banner_catalog";
    }
}