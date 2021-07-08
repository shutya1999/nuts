<?php $this->registerCssFile('@web/css/index/index.css'); ?>
<?php
use yii\base\Widget;
?>
<?php //debug($order) ?>

<?php if (!empty($session['cart'])) { ?>
    <div class="container indent">
        <h2 class="title mo-title">Оформлення замовлення</h2>
        <?php $form = \yii\widgets\ActiveForm::begin([
            'options' => [
                'class' => 'mo-content dg',
                'onsubmit' => 'return false;',
            ]
        ])?>
        <div class="mo-item _contact-details">
            <p class="mo-item__title">Контактні данні</p>
            <div class="mo-item__wrap _form">
                <?= $form->field($order, 'name', ['template' => "{input}\n {error}\n {hint}"])->textInput(['class' => 'form-fields', 'placeholder' => 'Ваше ім’я*'])?>
                <?= $form->field($order, 'last_name', ['template' => "{input}\n {error}\n {hint}"])->textInput(['class' => 'form-fields', 'placeholder' => 'Ваше прізвище*']) ?>
                <?= $form->field($order, 'phone', ['template' => "{input}\n {error}\n {hint}"])->textInput(['class' => 'form-fields', 'placeholder' => '38(___) ___ __ __*']) ?>
                <?= $form->field($order, 'email', ['template' => "{input}\n {error}\n {hint}"])->textInput(['class' => 'form-fields', 'placeholder' => 'Введіть ваш email*']) ?>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox" id="consultation1" name="Order[consultation]" value="1">
                <label for="consultation1">Консультація не потрібна. Не телефонуйте мені</label>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox" id="consultation2" name="Order[consultation]" value="0" checked>
                <label for="consultation2">Мені необхідна консультація. Зателефонуйте мені</label>
            </div>
        </div>
        <div class="mo-item _delivery">
            <p class="mo-item__title">Доставка</p>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox type-delivery__radio" id="delivery1" name="Order[delivery_type]" data-delivery="novaposhta" value="Нова Пошта" checked>
                <label for="delivery1">Нова Пошта</label>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox type-delivery__radio" id="delivery2" name="Order[delivery_type]" data-delivery="ukrposhta" value="Укрпошта">
                <label for="delivery2">Укрпошта</label>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox type-delivery__radio" id="delivery3" name="Order[delivery_type]" data-delivery="courier" value="Кур’єрська доставка">
                <label for="delivery3">Кур’єрська доставка</label>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox type-delivery__radio" id="delivery4" name="Order[delivery_type]" data-delivery="" value="Самовивіз">
                <label for="delivery4">Самовивіз (с.Солонка, вул.Орлика 1)</label>
            </div>
            <div class="mo-line"></div>
            <div class="mo-item__wrap type-delivery__block_wrap">
                <div class="type-delivery__block novaposhta-wrap active" data-delivery="Нова Пошта">
                    <div class="search-city">
                        <input type="text" class="form-fields city-name" name="Order[city]" data-ref="" placeholder="Введіть місто*" autocomplete="no">
                        <ul class="delivery-list city-list hide"></ul>
                    </div>
                    <div class="search-department">
                        <input type="text" class="form-fields department-input" name="Order[department_np]" placeholder="Введіть номер відділення*" autocomplete="no">
                        <ul class="delivery-list department-list hide"></ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="mo-item _payment">
            <p class="mo-item__title">Оплата</p>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox" id="payment1" name="Order[payment_type]" value="Оплата при отриманні" checked>
                <label for="payment1">Оплата при отриманні</label>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox" id="payment2" name="Order[payment_type]" value="LiqPay">
                <label for="payment2">Оплата картою (LiqPay)</label>
            </div>
            <div class="mo-line"></div>
            <?= $form->field($order, 'note', ['template' => "{input}"])->textarea(['class' => 'form-fields', 'placeholder' => 'Коментар', 'rows' => 4, "maxlength" => '150']) ?>
        </div>

        <div class="mo-item _cart">
            <p class="mo-item__title">Корзина</p>
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
                <button class="btn btn-orange btn-to-order">Оформити замовлення</button>
            </div>
        </div>

        <div class="mo-item _promocode">
            <input type="text" class="form-fields" name="promocode" placeholder="Вкажіть промо-код">
            <button class="btn btn-brown">Застосувати промокод</button>
        </div>
        <?php \yii\widgets\ActiveForm::end(); ?>

    </div>
<?php }else{?>
    <?php if (Yii::$app->session->hasFlash('success')) : ?>
        <p class="title order-success">
            ваше замовлення <br>
            <span>прийнято</span>
        </p>
        <script>
            setTimeout(function () {
                document.location.href = '/'
            }, 5000)
        </script>
    <? else :?>
        <p class="error-order"><?= Yii::$app->session->getFlash("error"); ?></p>
    <?php endif; ?>
<?php } ?>





