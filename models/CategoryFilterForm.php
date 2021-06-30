<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 15.06.2021
 * Time: 16:48
 */

namespace app\models;


use yii\base\Model;

class CategoryFilterForm extends Model
{
    public $categoryFilter;
    public function rules()
    {
        return [["categoryFilter"], "trim"];
    }
}