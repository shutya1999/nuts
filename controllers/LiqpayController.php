<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 28.07.2021
 * Time: 15:51
 */

namespace app\controllers;


use yii\web\Controller;
use yii\web\NotFoundHttpException;


class LiqpayController extends AppController
{
//    public function beforeAction($action)
//    {
//        if ($action->id == 'payment') {
//            $this->enableCsrfValidation = false;
//        }
//
//        return parent::beforeAction($action);
//    }
//
//    public function actions()
//    {
//        return [
//            'result' => [
//                'class' => 'voskobovich\liqpay\actions\CallbackAction',
//                'callable' => 'payment',
//            ]
//        ];
//    }

    function actionPayment()
    {
        echo "Yes";
//        $orderModel = $this->module->orderModel;
//        $orderModel = $orderModel::findOne($model->order_id);
//
//        if(!$orderModel) {
//            throw new NotFoundHttpException('The requested order does not exist.');
//        }
//
//        $orderModel->setPaymentStatus('yes');
//        $orderModel->save(false);
//
//        return 'YES';
    }
}