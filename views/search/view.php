<?php if ($count != 0) : ?>
    <span class="count-res" data-count="<?= $count ?>"></span>
    <?php foreach ($product as $item) : ?>
        <a href="<?= \yii\helpers\Url::to(['product/view', 'url' => $item->url]) ?>" class="search-res__item df">
            <div class="search-res__photo" style='background: url("/img/product/<?= $item->url?>/<?= $item->img?>")'></div>
            <p class="search-res__title">
                <?= $item->title ?>
            </p>
            <div class="product-cart__price search-res__price">
                <?php if ($item->sale) : ?>
                    <p class="goods-price">
                        <span class="old-price"><?= $item->price ?>₴</span>
                        <?= $item->new_price ?>₴
                    </p>
                    <div class="sale-block">
                        <p>Знижка</p>
                        <span><?= $item->sale ?> %</span>
                    </div>
                <?php else: ?>
                    <p class="goods-price"><?= $item->price ?>₴</p>
                <?endif;?>
            </div>
        </a>
    <?php endforeach; ?>
<?php else: ?>
    <p style="text-align: center" class="empty-search">Нічого не знайдено</p>
<?php endif; ?>