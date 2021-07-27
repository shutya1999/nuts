<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResetPasswordForm */
/* @var $form ActiveForm */
?>

<div class="container ">
    <div class="form form-authorization df">
        <p class="authorization-title">Зміна паролю</p>
        <div class="form-authorization-wrap">
            <?php $form = ActiveForm::begin() ?>

                <?= $form->field($model, 'password', ['template' => "{input} \n {error}"])
                    ->passwordInput(['placeholder' => 'Введіть новий пароль', 'class' => 'form-fields']) ?>

                <?= Html::submitButton('Змінити', ['class' => 'btn-form btn-brown']) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>