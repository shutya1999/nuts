<?php
use yii\helpers\Html;

$this->registerCssFile('@web/css/index/index.css');
?>

<h1>Liqpay</h1>

<?php //if ($model->hasErrors()): ?>
<!--    --><?//= Html::errorSummary($model) ?>
<?php //else: ?>
<!--    --><?//= Html::beginForm('https://www.liqpay.ua/api/checkout', 'post', [
//        'accept-charset' => 'utf8',
//        'id' => 'liqPay-form'
//    ]); ?>
<!--    --><?//= Html::activeHiddenInput($model, 'data'); ?>
<!--    --><?//= Html::activeHiddenInput($model, 'signature'); ?>
<!--    --><?php //if ($autoSubmit): ?>
<!--        --><?//= Html::script("setTimeout(function(){
//                document.getElementById(\"liqPay-form\").submit();
//            }, {$autoSubmitTimeout});"); ?>
<!--    --><?php //else: ?>
<!--        --><?//= Html::submitButton(); ?>
<!--    --><?php //endif; ?>
<!--    --><?//= Html::endForm(); ?>
<?php //endif; ?>

<!--<p>--><?//= $dataPayment ?><!--</p>-->
<!--<p>--><?//= $signature ?><!--</p>-->
<div class="container">
    <form method="POST" id="liqpay" action="https://www.liqpay.ua/api/3/checkout" accept-charset="utf-8" style="display: flex; justify-content: center">
        <input type="hidden" name="data" value="<?= $dataPayment?>"/>
        <input type="hidden" name="signature" value="<?= $signature?>"/>
        <input type="submit" class="btn-buy" value="Оплатити">
    </form>
</div>

<script>
    document.querySelector("#liqpay").submit();
</script>

