<?php if ($count != 0) : ?>
    <span class="count-res" data-count="<?= $count ?>"></span>
    <?php foreach ($product as $item) : ?>
        <a href="" class="search-res__item df">
            <div class="search-res__photo" style='background: url("/img/product/<?= $item->img?>")'></div>
            <p class="search-res__title">
                <?= $item->title ?>
            </p>
            <div class="product-cart__price search-res__price">
                <p><?= $item->price ?> ₴
                    <?php if($item->old_price != 0) : ?>
                        <span class="old-price">200 ₴</span>
                    <?php endif; ?>
                </p>
            </div>
        </a>
    <?php endforeach; ?>
<?php else: ?>
    <p style="text-align: center">Нічого не знайдено</p>
<?php endif; ?>