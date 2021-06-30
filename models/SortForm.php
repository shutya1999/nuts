<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 15.06.2021
 * Time: 16:54
 */

namespace app\models;

use yii\base\Model;

class SortForm extends Model
{
    public $category;
    public $other_filters;
    public $lower_price;//нижний порог
    public $top_price;//верхний порог
    public $sort;//тип сортировки (от дорогих к дешевым и тд.)

    public function rules()
    {
        return [[['lower_price', 'top_price', 'sort', 'category', 'other_filters'], 'trim']];
    }
}