<?php $this->registerCssFile('@web/css/index/index.css'); ?>

<?php
//debug($_SESSION['cart']);
?>

<div class="container indent">
    <div class="title cart-p-title">кошик</div>
    <?php if (!empty($session['cart'])) { ?>
        <div class="cart-p-content">
            <?php foreach ($_SESSION['cart'] as $id => $product) : ?>
                <?php foreach ($product as $item) : ?>
                    <?php if (isset($item['qty'])) : ?>
                        <div class="cart-p-item df">
                            <div class="cart-p-img" style="background: url('/img/product/<?= $product['img']?>')"></div>
                            <p class="cart-p-name"><?= $product['title'] ?> (<?= $product['volume-type']?>: <?= $item['volume'] ?>)</p>
                            <div class="cart-p-price ">
                                <span class="new-price"><?= $item['qty'] * $item['price'] ?> ₴</span>
                            </div>
                            <div class="goods-counter">
                                <label for="count_<?= $id?>_<?= $item['volume'] ?>">Кількість:</label>
                                <input id="count_<?= $id?>_<?= $item['volume'] ?>" class="count" type="number" placeholder="1" value="<?= $item['qty'] ?>" min="1" max="99" onchange="changeCart(<?= "count_" . $id . '_' . $item['volume'] ?>,<?= $id?>, <?= $item['volume']?>)">
                                <span class="btn-counter _plus" onclick="increaseNumber(<?= "count_" . $id . '_' . $item['volume'] ?>); changeCart(<?= "count_" . $id . '_' . $item['volume'] ?>,<?= $id?>, <?= $item['volume']?>);"></span>
                                <span class="btn-counter _minus" onclick="reduceNumber(<?= "count_" . $id . '_' . $item['volume'] ?>); changeCart(<?= "count_" . $id . '_' . $item['volume'] ?>, <?= $id?>, <?= $item['volume']?>);"></span>
                            </div>
                            <a href="<?= \yii\helpers\Url::to(['cart/del-item', 'id' => $id, 'volume' => $item['volume']]) ?>" class="cart-p-del"></a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
        <div class="cart-p-info df">
            <a href="" class="cart-p-back">← Повернутись до магазину</a>
            <div class="cart-p__total-price df">
                <p>до сплати:</p>
                <span><?= $_SESSION['cart.sum'] ?> грн</span>
            </div>
            <a class="btn btn-orange btn-cart-p">Оформити замовлення</a>
        </div>
    <?php }else { ?>
        <div class="cart-p-content _empty">
            <p>В корзині пусто (</p>
            <a href="/" style="">Почати покупки</a>
        </div>
    <?php } ?>
</div>