<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 23.07.2021
 * Time: 18:23
 */

namespace app\modules\account\controllers;
use app\modules\account\models\SignupForm;
use Yii;
use app\models\LoginForm;
use app\models\User;
use app\modules\account\models\SendEmailForm;
use app\modules\account\models\ResetPasswordForm;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;


class AuthController extends AppAccountController
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/account');
//            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/account');
//            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup(){

        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/account');
        }

        $model = new SignupForm();

        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $user = new User();
            $user->username = $model->username;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            $user->name = $model->name;
            $user->phone = $model->phone;

            if($user->save()){
                return $this->redirect("/account/auth/login");
            }
        }

        return $this->render('signup', compact('model'));
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/account');
    }

    public function actionSendEmail()
    {
        $model = new SendEmailForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if($model->sendEmail()):
                    Yii::$app->getSession()->setFlash('warning', 'Проверьте емайл.');
                    return $this->goHome();
                else:
                    Yii::$app->getSession()->setFlash('error', 'Нельзя сбросить пароль.');
                endif;
            }
        }

        return $this->render('sendEmail', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($key)
    {
        try {
            $model = new ResetPasswordForm($key);
        }
        catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->resetPassword()) {
                Yii::$app->getSession()->setFlash('warning', 'Пароль змінено');
                return $this->redirect(['/account/auth/login']);
            }
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

}