<?php
$this->registerCssFile('@web/css/index/index.css');
?>

<?php
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
?>

<?//= Yii::$app->getSecurity()->generatePasswordHash("user") ?>

<div class="container ">
    <div class="form form-authorization df">
        <p class="authorization-title">Особистий кабінет</p>
        <p class="authorization-sub-title">
            В особистому кабінеті ви можете переглядати ваші замовлення
            та створити обліковий запис
        </p>
        <div class="form-authorization-wrap">
            <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'username', ['template' => "{input} \n {error}"])
                ->textInput(['placeholder' => 'your_email@mail.com*', 'class' => 'form-fields form-fields__authorization']); ?>

            <?= $form->field($model, 'password', ['template' => "{input} \n {error}"])
                ->passwordInput(['placeholder' => 'Пароль*', 'class' => 'form-fields form-fields__authorization']); ?>

            <button class="btn-form btn-brown">Відправити</button>
            <?php ActiveForm::end() ?>
<!--            <input type="email" class="form-fields  form-fields__authorization" placeholder="your_email@mail.com*" required>-->
<!--            <input type="password" class="form-fields form-fields__authorization" placeholder="Пароль*" required>-->
<!--            <button class="btn-form btn-brown">Відправити</button>-->
        </div>
        <?//= Html::a('Забыли пароль?', ['/main/send-email']) ?>
        <a href="/account/auth/send-email" class="link-restore">Забули пароль?</a>
        <a href="<?= \yii\helpers\Url::to('/account/auth/signup') ?>" class="link-registr">Зареєструватися</a>
    </div>
</div>