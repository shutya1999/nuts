<?php
use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <style>
        @font-face {
            font-family: 'BebasNeue';
            font-style: normal;
            font-display: swap;
            src: url("/fonts/bebas-neue/BebasNeueRegular.eot");
            src: local('BebasNeue'), local('BebasNeue'),
            url("/fonts/bebas-neue/BebasNeueRegular.eot?#iefix") format('embedded-opentype'),
            url("/fonts/bebas-neue/BebasNeueRegular.woff2") format('woff2'),
            url("/fonts/bebas-neue/BebasNeueRegular.woff") format('woff'),
            url("/fonts/bebas-neue/BebasNeueRegular.ttf") format('truetype');
        }
        @font-face {
            font-family: 'OpenSans';
            font-style: normal;
            font-display: swap;
            src: url("/fonts/open-sans/OpenSans-Bold.eot");
            src: local('OpenSans'), local('OpenSans'),
            url("/fonts/open-sans/OpenSans-Bold.eot?#iefix") format('embedded-opentype'),
            url("/fonts/open-sans/OpenSans-Bold.woff2") format('woff2'),
            url("/fonts/open-sans/OpenSans-Bold.woff") format('woff'),
            url("/fonts/open-sans/OpenSans-Bold.ttf") format('truetype');

            src: url("/fonts/open-sans/OpenSans-Light.eot");
        url("/fonts/open-sans/OpenSans-Light.eot?#iefix") format('embedded-opentype'),
        url("/fonts/open-sans/OpenSans-Light.woff2") format('woff2'),
        url("/fonts/open-sans/OpenSans-Light.woff") format('woff'),
        url("/fonts/open-sans/OpenSans-Light.ttf") format('truetype');
        }
    </style>
    <?php $this->registerCssFile('@web/css/general.css'); ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="header-auxiliary"></div>
<header class="header">
    <div class="container">
        <div class="header-content df">
            <a href="/" class="header-logo">
                <img src="/img/logo.png" alt="Nuts City Logo">
            </a>

            <?= \app\components\MenuWidget::widget([
                'tpl' => 'menu',
                'ul_class' => 'sub-list',
            ]) ?>
            <!--            <ul class="nav df">-->
            <!--                <li class="nav-list sub">-->
            <!--                    <a href="catalog.php" class="nav-link">Каталог товарів</a>-->
            <!--                    <ul class="sub-list">-->
            <!--                        <li class="nav-list"><a href="catalog.php" class="nav-link">Подарункові набори</a></li>-->
            <!--                        <li class="nav-list"><a href="catalog.php" class="nav-link">СертифІкати</a></li>-->
            <!--                        <li class="nav-list"><a href="catalog.php" class="nav-link">ГорІшки</a></li>-->
            <!--                        <li class="nav-list"><a href="catalog.php" class="nav-link">Сухофрукти</a></li>-->
            <!--                        <li class="nav-list"><a href="catalog.php" class="nav-link">Шоколад, пастила, халва, гранола</a></li>-->
            <!--                        <li class="nav-list"><a href="catalog.php" class="nav-link">Кава, напоЇ та Інше</a></li>-->
            <!--                        <li class="nav-list"><a href="catalog.php" class="nav-link">Мед, крем-мед та бджолопродукти</a></li>-->
            <!--                        <li class="nav-list"><a href="catalog.php" class="nav-link">НасІння, крупи та бобовІ</a></li>-->
            <!--                    </ul>-->
            <!--                </li>-->
            <!--                <li class="nav-list"><a href="#review" class="nav-link">Відгуки</a></li>-->
            <!--                <li class="nav-list"><a href="#delivery" class="nav-link">Доставка і оплата</a></li>-->
            <!--                <li class="nav-list"><a href="#contacts" class="nav-link">Контакти</a></li>-->
            <!--            </ul>-->
            <div class="header-contacts df">
                <div class="header-phone sub">
                    <a href="tel:+380 68 123 73 21">+380 68 123 73 21</a>
                    <div class="sub-list">
                        <a class="_mob" href="tel:+380 93 123 73 21">+380 68 123 73 21</a>
                        <a href="tel:+380 93 123 73 21">+380 93 123 73 21</a>
                    </div>
                </div>
                <div class="header-messenger df">
                    <a href="" class="header-messenger__item _viber"></a>
                    <a href="" class="header-messenger__item _telegram"></a>
                </div>
            </div>
            <div class="search-block_wrap">
                <div class="search-block">
                    <input type="text" class="search-fields" placeholder="Пошук товарів ...">
                    <button class="btn btn-brown search-btn">пошук</button>
                </div>
            </div>
            <div class="header-bar dg">
                <div class="header-search">
                    <div class="search-icon"></div>
                </div>
                <div class="header-cart">
                    <div class="goods-in-cart"><span>1</span></div>
                    <div class="header-cart__content">
                        <div class="header-cart__close"></div>
                        <div class="header-cart__item-top">
                            <div class="header-cart__item_wrap">
                                <div class="header-cart__item dg">
                                    <div class="header-cart__img" style="background: url('/img/goods/img1.jpg')"></div>
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
                                    <div class="header-cart__img" style="background: url('/img/goods/img1.jpg')"></div>
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
                                    <div class="header-cart__img" style="background: url('/img/goods/img1.jpg')"></div>
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
                                    <div class="header-cart__img" style="background: url('/img/goods/img1.jpg')"></div>
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
                            <a href="" class="view-cart">Переглянути кошик</a>
                        </div>
                    </div>
                </div>
                <div class="header-lang sub">
                    <a href="">UA</a>
                    <div class="sub-list">
                        <a href="">RU</a>
                    </div>
                </div>
                <a href="/auth/authorization/logout" class="header-profile _logout"></a>
                <div class="burger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="hidden-menu">
                        <div class="hidden-menu__top df">
                            <a href="">Головна</a>
                            <a href="">Каталог</a>
                            <a href="#review">Відгуки</a>
                            <a href="#delivery">Доставка і оплата</a>
                            <a href="#contacts">контакти</a>
                        </div>
                        <div class="hidden-menu__bottom df">
                            <a href="">ПодарунковІ набори</a>
                            <a href="">СертифІкати</a>
                            <a href="">ГорІшки</a>
                            <a href="">Сухофрукти</a>
                            <a href="">Шоколад, пастила, халва, гранола</a>
                            <a href="">Кава, напоЇ та Інше</a>
                            <a href="">Мед, крем-мед та бджолопродукти</a>
                            <a href="">НасІння, крупи та бобовІ</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?//= Yii::$app->getSecurity()->generatePasswordHash('user'); ?>
<?= $content ?>

<footer class="footer">
    <div class="container">
        <div class="footer-content df">
            <div class="footer-column df">
                <a href="" class="text footer-text _hover-orange">Подарункові набори</a>
                <a href="" class="text footer-text _hover-orange">Сертифікати</a>
                <a href="" class="text footer-text _hover-orange">Горішки</a>
                <a href="" class="text footer-text _hover-orange">Сухофрукти</a>
                <a href="" class="text footer-text _hover-orange">Шоколад, пастила, <br> халва, гранола</a>
                <a href="" class="text footer-text _hover-orange">Кава, напої <br> та інше</a>
                <a href="" class="text footer-text _hover-orange">Мед, крем-мед <br> та бджолопродукти</a>
                <a href="" class="text footer-text _hover-orange">Насіння, крупи <br> та бобові</a>
            </div>
            <div class="footer-column df">
                <a href="" class="text footer-text _hover-orange">Відгуки</a>
                <a href="" class="text footer-text _hover-orange">Доставка і оплата</a>
                <a href="" class="text footer-text _hover-orange">Контакти</a>
                <a href="" class="text footer-text _hover-orange">Особистий кабінет</a>
            </div>
            <div class="footer-column df">
                <a href="" class="text footer-text _hover-orange">Політика конфінденційності</a>
                <a href="" class="text footer-text _hover-orange">Умови повернення</a>
                <a href="" class="text footer-text _hover-orange">Договір оферти</a>
                <div class="footer-payment"><img src="/img/payment.png" alt="LiqPay"></div>
            </div>
            <div class="footer-column">
                <p class="footer-form-text">Є питання? Давай вирішувати!</p>
                <form action="" class="form df" method="POST">
                    <input class="form-fields" type="text" name="user_name" placeholder="Введіть ваше ім’я">
                    <input class="form-fields" type="text" name="user_phone" placeholder="+38 (___) ___ __ __">
                    <textarea class="form-fields _textarea" name="user_message" rows="4" placeholder="Напишіть короткий зміст питання"></textarea>
                    <button class="btn-form btn-green">Відправити</button>
                </form>
            </div>
        </div>
    </div>
    <a href="https://yh-web.space/" class="yh-label" target="_blank"></a>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
