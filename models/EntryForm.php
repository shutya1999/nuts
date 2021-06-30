<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 29.06.2021
 * Time: 11:21
 */

namespace app\models;


use yii\base\Model;

class EntryForm extends Model
{
    public $qty;
    public $volume;

    public function rules()
    {
        return [[['qty','volume'], 'trim']];
    }
}