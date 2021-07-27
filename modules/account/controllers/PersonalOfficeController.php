<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 23.07.2021
 * Time: 17:48
 */

namespace app\modules\account\controllers;


use app\models\Order;
use app\models\OrderProduct;
use app\models\Product;
use app\modules\account\models\UserInfo;

class PersonalOfficeController extends AppAccountController
{

    public function actionIndex(){
        $id = \Yii::$app->user->identity->id;

        $model = UserInfo::findOne($id);
        $deliveryType = $model->deliveryHTML(\Yii::$app->user->identity->delivery_type);

        if (\Yii::$app->request->post()){
            if ($model->delivery_type != $_POST['UserInfo']["delivery_type"]){
                $model->city = null;
                $model->department_np = null;
                $model->street = null;
                $model->index_ukr = null;
                $model->house_number = null;
                $model->apartment_number = null;
            }
            if ($model->load(\Yii::$app->request->post()) && $model->save()) {
                \Yii::$app->session->setFlash("success", "Дані успішно змінені");
                return $this->redirect(\Yii::$app->request->referrer);
            }

        }

        return $this->render("index", compact(['model', 'deliveryType']));



//        if (\Yii::$app->request->post()){
//            debug($_POST);

//                if ($_POST['UserInfo']['changePass']) {
//                    if (\Yii::$app->getSecurity()->validatePassword($_POST['UserInfo']['currentPassword'], $model->password)) {
//                    if ($model->load(\Yii::$app->request->post())) {

//                        if ($model->delivery_type != $_POST['UserInfo']["delivery_type"]){
//                            $model->city = null;
//                            $model->department_np = null;
//                            $model->street = null;
//                            $model->index_ukr = null;
//                            $model->house_number = null;
//                            $model->apartment_number = null;
//                        }


                        //$model->load(\Yii::$app->request->post());
//                        $model->password = \Yii::$app->getSecurity()->generatePasswordHash($_POST['UserInfo']['newPassword']);
                        //$model->save();
                        //$model->beforeValidate();
                        //$model->beforeSave();



//                        \Yii::$app->session->setFlash("success", "Дані успішно змінені 1");
                        //return $this->redirect(\Yii::$app->request->referrer);
//                    }
//                    } else {
//                        echo "Pizda";
////                    \Yii::$app->session->setFlash("error", "Ви ввели невірний пароль");
//                    }
//                }
//                else{
//                    if ($model->delivery_type != $_POST['UserInfo']["delivery_type"]){
//                        $model->city = null;
//                        $model->department_np = null;
//                        $model->street = null;
//                        $model->index_ukr = null;
//                        $model->house_number = null;
//                        $model->apartment_number = null;
//                    }
//
//                    if ($model->load(\Yii::$app->request->post()) && $model->save()) {
//                        \Yii::$app->session->setFlash("success", "Дані успішно змінені 2");
////                    return $this->redirect(\Yii::$app->request->referrer);
//                    }
//                }

//            if ($model->load(\Yii::$app->request->post()) && $model->save()) {
//                return $this->redirect('/account');
//            }

//
//            if ($model->load(\Yii::$app->request->post()) && $model->save()) {
//                return $this->redirect(\Yii::$app->request->referrer);
//            }
            //return $this->redirect(\Yii::$app->request->referrer);
//        }
    }

    public function actionMyOrders(){
        $id = \Yii::$app->user->identity->id;

        $order = Order::find()->where(['user_id' => $id])->all();

        return $this->render("my-orders", compact(['order']));
    }

    public function actionDetailOrder($id){

        $userId = \Yii::$app->user->identity->id;

        $userOrderId = Order::find()->select('id')->where(['user_id' => $userId])->asArray()->all();

        $orders = OrderProduct::find()->where(['order_id' => $id])->all();

        if (in_array($id, array_column($userOrderId, 'id'))){
            return $this->render("detail-order", compact('orders'));
        }else{
            return $this->redirect('/account/personal-office/my-orders');
        }
    }
}