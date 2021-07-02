<?php
//debug($_SESSION['cart']);
?>

<?php if (!empty($session['cart'])) { ?>
        <div class="goods-in-cart"><span><?= $_SESSION['cart.qty'] ?? '0' ?></span></div>
        <div class="header-cart__content">
            <div class="header-cart__close"></div>
            <div class="header-cart__item-top">
                <div class="header-cart__item_wrap">
                    <?php foreach ($_SESSION['cart'] as $id => $product) : ?>
                        <?php foreach ($product as $item) : ?>
                            <?php if (isset($item['qty'])) : ?>
                                <div class="header-cart__item dg">
                                    <div class="header-cart__img" style="background: url('/img/product/<?= $product['img']?>')"></div>
                                    <p class="header-cart__title"><?= $product['title'] ?></p>
                                    <span class="header-cart__delete" onclick="delProdInCart(<?= $id?>, <?= $item['volume']?>)"></span>
                                    <div class="header-cart__info_wrap">
                                        <div class="header-cart__info header-cart__count df">
                                            <p class="cart-text header-cart__count_title"><?= $product['volume-type'] ?>: </p>
                                            <span class="cart-text header-cart__count_value"><?= $item['volume'] ?></span>
                                        </div>
                                        <div class="header-cart__info header-cart__price df">
                                            <span class="cart-text header-cart__price_value"> <?= $item['qty'] ?>x </span>
                                        </div>
                                        <p class="header-cart-price"><?= $item['qty'] * $item['price'] ?> ₴</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="header-cart__bottom dg">
                <div class="header-cart__discount df">
                    <p>Знижка:</p>
                    <span>0 грн</span>
                </div>
                <div class="header-cart__total-price df">
                    <p>до сплати:</p>
                    <span><?= $_SESSION['cart.sum'] ?? '0'?> грн</span>
                </div>
                <a href="/cart/ordering" class="btn btn-orange btn-to-order">Оформити замовлення</a>
                <a href="/cart/checkout" class="view-cart">Переглянути кошик</a>
            </div>
        </div>
<?php }else{ ?>
    <div class="goods-in-cart"><span><?= $_SESSION['cart.qty'] ?? '0' ?></span></div>
    <div class="header-cart__content _empty">
        <div class="header-cart__close"></div>
        <div class="header-cart__item-top">
            <div class="header-cart__item_wrap">
                <p>В корзині пусто</p>
            </div>
        </div>
    </div>
<?php } ?>

