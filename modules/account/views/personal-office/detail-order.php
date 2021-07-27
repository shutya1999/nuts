<?php //debug($orders->category->id) ?>

<style>
    .img img{
        width: 100%;
        max-width: 100px;
    }
</style>
<div class="container">
    <p class="title title-personal-office">Особистий кабінет</p>
    <div class="personal-office__nav">
        <a href="<?= \yii\helpers\Url::to('/account/personal-office') ?>" class="">аккаунт</a>
        <a href="<?= \yii\helpers\Url::to('/account/personal-office/my-orders') ?>" class="active">Мої замовлення</a>
    </div>
    <table class="personal-office__content _orders">
        <thead>
        <tr>
            <th scope="col">Назва</th>
            <th scope="col">Фото</th>
            <th scope="col">Об'єм</th>
            <th scope="col">Ціна за 1 шт</th>
            <th scope="col">Кількість</th>
            <th scope="col">Сума</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $item) : ?>
            <tr>
                <td scope="row"><?= $item->title ?></td>
                <td class="img"><?= \yii\helpers\Html::img('/img/product/' . $item->product->url . '/' . $item->product->img) ?></td>
                <td><?= $item->volume . " " .  $item->volume_type?></td>
                <td><?= $item->price ?> грн</td>
                <td><?= $item->qty ?></td>
                <td><?= $item->total ?> грн</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
