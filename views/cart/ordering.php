<?php $this->registerCssFile('@web/css/index/index.css'); ?>

<div class="container indent">
    <h2 class="title mo-title">Оформлення замовлення</h2>
    <form action="" method="POST" class="mo-content dg">
        <div class="mo-item _contact-details">
            <p class="mo-item__title">Контактні данні</p>
            <div class="mo-item__wrap _form">
                <input type="text" class="form-fields" name="user_name" placeholder="Ваше ім’я*" required>
                <input type="text" class="form-fields" name="user_sec_name" placeholder="Ваше прізвище*" required>
                <input type="text" class="form-fields" name="user_phone" placeholder="38(___) ___ __ __*" required>
                <input type="email" class="form-fields" name="user_email" placeholder="Введіть ваш email*" required>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox" id="consultation1" name="consultation" value="yes">
                <label for="consultation1">Консультація не потрібна. Не телефонуйте мені</label>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox" id="consultation2" name="consultation" value="no" checked>
                <label for="consultation2">Мені необхідна консультація. Зателефонуйте мені</label>
            </div>
        </div>
        <div class="mo-item _delivery">
            <p class="mo-item__title">Доставка</p>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox type-delivery__radio" id="delivery1" name="delivery" value="novaposhta" checked>
                <label for="delivery1">Нова Пошта</label>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox type-delivery__radio" id="delivery2" name="delivery" value="ukrposhta">
                <label for="delivery2">Укрпошта</label>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox type-delivery__radio" id="delivery3" name="delivery" value="courier">
                <label for="delivery3">Кур’єрська доставка</label>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox type-delivery__radio" id="delivery4" name="delivery" value="self_pickup">
                <label for="delivery4">Самовивіз (с.Солонка, вул.Орлика 1)</label>
            </div>
            <div class="mo-line"></div>
            <div class="mo-item__wrap">
                <div class="type-delivery__block novaposhta-wrap active" data-delivery="novaposhta">
                    <div class="search-city">
                        <input type="text" class="form-fields city-name" name="city" data-ref="" placeholder="Введіть місто*" required>
                        <ul class="delivery-list city-list hide"></ul>
                    </div>
                    <div class="search-department">
                        <input type="text" class="form-fields department-input" name="department" placeholder="Введіть номер відділення*" required>
                        <ul class="delivery-list department-list hide"></ul>
                    </div>
                </div>
                <div class="type-delivery__block ukrposhta-wrap" data-delivery="ukrposhta">
                    <input type="text" class="form-fields" name="city" data-ref="" placeholder="Введіть місто*" required>
                    <input type="text" class="form-fields" name="address" placeholder="Введіть вулицю*" required>
                    <input type="number" class="form-fields" name="postindex" placeholder="Поштовий індекс*" required>
                </div>
                <div class="type-delivery__block courier-wrap" data-delivery="courier">
                    <input type="text" class="form-fields" name="city" data-ref="" placeholder="Введіть місто*" required>
                    <input type="text" class="form-fields" name="address" placeholder="Введіть вулицю*" required>
                    <input type="number" class="form-fields" name="postindex" placeholder="Будинок*" required>
                    <input type="number" class="form-fields" name="postindex" placeholder="Квартира*" required>
                </div>
            </div>
        </div>
        <div class="mo-item _payment">
            <p class="mo-item__title">Оплата</p>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox" id="payment1" name="payment" value="novaposhta" checked>
                <label for="payment1">Оплата при отриманні</label>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox" id="payment2" name="payment" value="no">
                <label for="payment2">Оплата картою (LiqPay)</label>
            </div>
            <div class="mo-line"></div>
            <textarea class="form-fields" name="comments" id="" rows="4" maxlength="150" placeholder="Коментар"></textarea>
        </div>
        <div class="mo-item _cart">
            <p class="mo-item__title">Корзина</p>
            <div class="header-cart__item-top">
                <div class="header-cart__item_wrap">
                    <div class="header-cart__item dg">
                        <div class="header-cart__img" style="background: url('assets/img/goods/img1.jpg')"></div>
                        <p class="header-cart__title">Фундук бланшований (підсмажений)</p>
                        <span class="header-cart__delete"></span>
                        <div class="header-cart__info header-cart__count df">
                            <p class="cart-text header-cart__count_title">грам:</p>
                            <span class="cart-text header-cart__count_value">200</span>
                        </div>
                        <div class="header-cart__info header-cart__price df">
                            <p class="cart-text header-cart__price_title">ціна:</p>
                            <span class="cart-text header-cart__price_value">1x</span>
                        </div>
                        <p class="header-cart-price">200 ₴</p>
                    </div>
                    <div class="header-cart__item dg">
                        <div class="header-cart__img" style="background: url('assets/img/goods/img1.jpg')"></div>
                        <p class="header-cart__title">Фундук бланшований (підсмажений)</p>
                        <span class="header-cart__delete"></span>
                        <div class="header-cart__info header-cart__count df">
                            <p class="cart-text header-cart__count_title">грам:</p>
                            <span class="cart-text header-cart__count_value">200</span>
                        </div>
                        <div class="header-cart__info header-cart__price df">
                            <p class="cart-text header-cart__price_title">ціна:</p>
                            <span class="cart-text header-cart__price_value">1x</span>
                        </div>
                        <p class="header-cart-price">200 ₴</p>
                    </div>
                    <div class="header-cart__item dg">
                        <div class="header-cart__img" style="background: url('assets/img/goods/img1.jpg')"></div>
                        <p class="header-cart__title">Фундук бланшований (підсмажений)</p>
                        <span class="header-cart__delete"></span>
                        <div class="header-cart__info header-cart__count df">
                            <p class="cart-text header-cart__count_title">грам:</p>
                            <span class="cart-text header-cart__count_value">200</span>
                        </div>
                        <div class="header-cart__info header-cart__price df">
                            <p class="cart-text header-cart__price_title">ціна:</p>
                            <span class="cart-text header-cart__price_value">1x</span>
                        </div>
                        <p class="header-cart-price">200 ₴</p>
                    </div>
                    <div class="header-cart__item dg">
                        <div class="header-cart__img" style="background: url('assets/img/goods/img1.jpg')"></div>
                        <p class="header-cart__title">Фундук бланшований (підсмажений)</p>
                        <span class="header-cart__delete"></span>
                        <div class="header-cart__info header-cart__count df">
                            <p class="cart-text header-cart__count_title">грам:</p>
                            <span class="cart-text header-cart__count_value">200</span>
                        </div>
                        <div class="header-cart__info header-cart__price df">
                            <p class="cart-text header-cart__price_title">ціна:</p>
                            <span class="cart-text header-cart__price_value">1x</span>
                        </div>
                        <p class="header-cart-price">200 ₴</p>
                    </div>
                </div>
            </div>
            <div class="header-cart__bottom dg">
                <div class="header-cart__discount df">
                    <p>Знижка:</p>
                    <span>200 грн</span>
                </div>
                <div class="header-cart__total-price df">
                    <p>до сплати:</p>
                    <span>2 800 грн</span>
                </div>
                <a href="" class="btn btn-orange btn-to-order">Оформити замовлення</a>
            </div>
        </div>
        <div class="mo-item _promocode">
            <input type="text" class="form-fields" name="promocode" placeholder="Вкажіть промо-код">
            <button class="btn btn-brown">Застосувати промокод</button>
        </div>
    </form>
</div>
