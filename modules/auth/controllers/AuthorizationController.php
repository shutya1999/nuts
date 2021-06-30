<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 18.06.2021
 * Time: 09:50
 */

namespace app\modules\auth\controllers;
use app\models\LoginForm;
use app\models\User;
use Yii;


class AuthorizationController extends AppAuthController
{

    public $layout = 'auth';

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
//            return $this->redirect('/admin');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

//            debug(User::findByUsername($model->username));
            if (User::findByUsername($model->username)->admin){
                return $this->redirect('/auth/admin');
            }else{
//                Yii::$app->user->logout();
                return $this->redirect('/auth/personal-office');
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
        return $this->redirect('/auth');
    }
}