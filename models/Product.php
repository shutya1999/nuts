<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 14.06.2021
 * Time: 15:05
 */

namespace app\models;


use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return "product";
    }

    public function getCategory(){
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
    public function getReviews(){
        return $this->hasMany(Reviews::class, ['product_id' => 'id']);
    }
}