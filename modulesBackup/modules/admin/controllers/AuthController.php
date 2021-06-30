<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 16.06.2021
 * Time: 18:49
 */

namespace app\modules\admin\controllers;
use app\models\AdminLoginForm;
use app\models\LoginForm;
use app\models\User;
use Yii;

class AuthController extends AppAdminController
{
    public $layout = 'auth';

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/admin');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

//            debug(User::findByUsername($model->username));
            if (User::findByUsername($model->username)->admin){
                return $this->redirect('/admin');
            }else{
                Yii::$app->user->logout();
                return $this->redirect('/user/');
            }
//            return $this->redirect('/admin');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/admin');
    }
}