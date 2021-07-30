<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 27.07.2021
 * Time: 15:19
 */

namespace app\widgets;


use app\models\CallbackForm;
use yii\base\Widget;

class CallbackWidget extends Widget
{
    public function init()
    {
        return parent::init();
    }

    public function run()
    {
        $modelCallback = new CallbackForm();
        return $this->render('callback/form', compact('modelCallback'));
    }
}