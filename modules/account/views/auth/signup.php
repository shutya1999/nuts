<?php use yii\widgets\ActiveForm; ?>
<div class="container ">
    <div class="form form-authorization df">
        <p class="authorization-title">Реєстрація</p>
        <p class="authorization-sub-title">
            Заповніть коротку інформацію про себе <br>
            і ви вже майже на місці
        </p>
        <div class="form-authorization-wrap">
            <?php $form = ActiveForm::begin() ?>
                <?= $form->field($model, 'name', ['template' => "{input} \n {error}"])
                    ->textInput(['placeholder' => 'Ваше ім’я*', 'class' => 'form-fields']); ?>

                <?= $form->field($model, 'phone', ['template' => "{input} \n {error}"])
                    ->textInput(['placeholder' => '+38(___) ___ __ __*', 'class' => 'form-fields']); ?>


                <?= $form->field($model, 'username', ['template' => "{input} \n {error}"])
                    ->textInput(['placeholder' => 'your_email@mail.com*', 'class' => 'form-fields']); ?>

                <?= $form->field($model, 'password', ['template' => "{input} \n {error}"])
                    ->passwordInput(['placeholder' => 'Пароль*', 'class' => 'form-fields']); ?>

                <p>Реєструючись, ви погоджутеся з призначеним для користувача угодою</p>
                <button class="btn-form btn-brown">Зареєструватись</button>

            <?php ActiveForm::end() ?>
        </div>
        <a href="<?= \yii\helpers\Url::to('/account/auth/login') ?>" class="link-login">Увійти на сайт</a>
    </div>
</div>