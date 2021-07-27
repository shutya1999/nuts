<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<div class="container ">
    <div class="form form-authorization df">
        <p class="authorization-title">Відновлення паролю</p>
        <div class="form-authorization-wrap">
            <?php $form = ActiveForm::begin() ?>

            <?= $form->field($model, 'username', ['template' => "{input} \n {error}"])
                ->textInput(['placeholder' => 'your_email@mail.com*', 'class' => 'form-fields form-fields__authorization']);?>

            <button class="btn-form btn-brown">Відправити</button>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>