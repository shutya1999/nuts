<?php $this->registerCssFile('@web/css/general.css'); ?>

<h1 style="text-align: center; margin-top: 50px;">Ваша заявка прийнята !</h1>
<h2 style="text-align: center; margin-bottom: 100px">Скоро з вами зв'яжуться</h2>

<?php
$js = <<<JS
    setTimeout(function() {
        window.location = '/';
    }, 3000)
JS;

$this->registerJs($js);

?>