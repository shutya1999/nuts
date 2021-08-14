<?php
use yii\widgets\ActiveForm;
?>

<?php $formCallback = ActiveForm::begin([
    'action' => '/app/callback',
    'options' => [
        'class' => 'form form-callback df'
    ],
    'fieldConfig' => [
        'template' => "{input} \n {error}"
    ]
]) ?>
    <?= $formCallback->field($modelCallback, 'name')->textInput(['placeholder' => 'Введіть ваше ім’я','class' => 'form-fields']) ?>
    <?= $formCallback->field($modelCallback, 'phone')->textInput(['placeholder' => '+38 (___) ___ __ __','class' => 'form-fields mask-phone']) ?>
    <?= $formCallback->field($modelCallback, 'text')->textarea(['placeholder' => 'Напишіть короткий зміст питання','class' => 'form-fields _textarea', 'rows' => 4]) ?>

    <?= \yii\helpers\Html::submitButton('Відправити', ['class' => 'btn-form btn-green']) ?>
<?php ActiveForm::end() ?>