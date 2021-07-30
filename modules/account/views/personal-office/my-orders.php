<?php
//$this->registerCssFile('@web/css/index/index.css');
//?>

<?php //debug($order); ?>
<style>
    .empty-order{
        text-align: center;
        margin: 50px auto;
    }
    .empty-order a{
        color: #FFC76C;
    }
</style>
<div class="container indent">
    <p class="title title-personal-office">Особистий кабінет</p>
    <div class="personal-office__nav">
        <a href="<?= \yii\helpers\Url::to('/account/personal-office') ?>" class="">аккаунт</a>
        <a href="<?= \yii\helpers\Url::to('/account/personal-office/my-orders') ?>" class="active">Мої замовлення</a>
    </div>
    <?php if (!empty($order)) : ?>
        <table class="personal-office__content _orders">
            <thead>
            <tr>
                <th class="_desktop" scope="col" valign="center">Номер замовлення</th>
                <th class="_mob" scope="col" valign="center">№</th>
                <th scope="col">Сума</th>
                <th scope="col">Оплата</th>
                <th scope="col">Доставка</th>
                <th scope="col">Додаткова інформація</th>
                <th scope="col">Дата створення</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($order as $item) : ?>
                <?php $date = new DateTime($item->created_at); ?>
                <tr>
                    <td scope="row"><?= $item->id ?></td>
                    <td><?= $item->total ?> грн</td>
                    <td><?= $item->payment_type?></td>
                    <td><?= $item->delivery_type ?></td>
                    <td><a href="<?= \yii\helpers\Url::to(['/account/personal-office/detail-order', 'id' => $item->id]) ?>">деталі замовлення +</a></td>
                    <td><?= $date->format('d-m-Y H:i'); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="empty-order">Поки що ви не зробили жодного замовдення. <a href="<?= \yii\helpers\Url::home() ?>">Почати покупки</a></p>
    <?php endif; ?>

</div>