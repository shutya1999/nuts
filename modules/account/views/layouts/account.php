<?php

use yii\helpers\Html;
use app\assets\AccountAsset;

AccountAsset::register($this);
?>



<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
            <ul class="nav df">
                <li class="nav-list sub">
                    <p class="nav-link">Каталог товарів</p>
                    <ul class="sub-list">
                        <?php foreach ($this->context->categories as $cat) : ?>
                            <li class="nav-list">
                                <a class="nav-link" href="<?= \yii\helpers\Url::to(['/category/view', 'id' => $cat->id]) ?>"><?= $cat->name ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="nav-list"><a href="/#review" class="nav-link">Відгуки</a></li>
                <li class="nav-list"><a href="/home/delivery" class="nav-link">Доставка і оплата</a></li>
                <li class="nav-list"><a href="/#contacts" class="nav-link">Контакти</a></li>
            </ul>
            <div class="header-contacts df">
                <div class="header-phone sub">
                    <a href="tel:<?= $this->context->information['phone1'] ?>"><?= $this->context->information['phone1'] ?></a>
                    <div class="sub-list">
                        <a class="_mob" href="tel:<?= $this->context->information['phone1'] ?>"><?= $this->context->information['phone1'] ?></a>
                        <a href="tel:<?= $this->context->information['phone2'] ?>"><?= $this->context->information['phone2'] ?></a>
                    </div>
                </div>
                <div class="header-messenger df">
                    <a href="<?= $this->context->information['viber'] ?>" class="header-messenger__item _viber"></a>
                    <a href="<?= $this->context->information['telegram'] ?>" class="header-messenger__item _telegram"></a>
                </div>
            </div>
            <div class="search-block_wrap">
                <div class="search-block">
                    <input type="text" class="search-fields" placeholder="Пошук товарів ...">
                    <button class="btn btn-brown search-btn">пошук</button>
                </div>
                <div class="search-res"><p class="empty-search" >Введіть щось</p></div>
            </div>
            <div class="header-bar dg">
                <div class="header-search">
                    <div class="search-icon"></div>
                </div>
                <div class="header-cart"></div>
                <div class="header-lang sub">
                    <p>UA</p>
                    <div class="sub-list">
                        <a href="">RU</a>
                    </div>
                </div>
                <a href="/account/auth/logout" class="header-profile _logout"></a>
                <div class="burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden-menu">
        <div class="hidden-menu__top df">
            <a href="">Головна</a>
            <a href="">Каталог</a>
            <a href="#review">Відгуки</a>
            <a href="/home/delivery">Доставка і оплата</a>
            <a href="#contacts">контакти</a>
        </div>
        <div class="hidden-menu__bottom df">
            <?php foreach ($this->context->categories as $cat) : ?>
                <a href="<?= \yii\helpers\Url::to(['/category/view', 'id' => $cat->id]) ?>"><?= $cat->name ?></a>
            <?php endforeach; ?>
        </div>
        <div class="hidden-phone">
            <a href="tel:<?= $this->context->information['phone1'] ?>"><?= $this->context->information['phone1'] ?></a>
            <a href="tel:<?= $this->context->information['phone2'] ?>"><?= $this->context->information['phone2'] ?></a>
        </div>
    </div>
</header>

<?= $content ?>
<!---->
<footer class="footer">
    <div class="container">
        <div class="footer-content df">
            <div class="footer-column df">
                <?php foreach ($this->context->categories as $cat) : ?>
                    <a class="text footer-text _hover-orange" href="<?= \yii\helpers\Url::to(['category/view', 'id' => $cat->id]) ?>"><?= $cat->name ?></a>
                <?php endforeach; ?>
            </div>
            <div class="footer-column df">
                <a href="/#review" class="text footer-text _hover-orange">Відгуки</a>
                <a href="/home/delivery" class="text footer-text _hover-orange">Доставка і оплата</a>
                <a href="/#contacts" class="text footer-text _hover-orange">Контакти</a>
                <a href="/account/" class="text footer-text _hover-orange">Особистий кабінет</a>
            </div>
            <div class="footer-column df">
                <a href="<?= \yii\helpers\Url::to(['/home/privacy-policy'])?>" class="text footer-text _hover-orange">Політика конфінденційності</a>
                <a href="<?= \yii\helpers\Url::to(['/home/return'])?>" class="text footer-text _hover-orange">Умови повернення</a>
                <a href="<?= \yii\helpers\Url::to(['/home/contract'])?>" class="text footer-text _hover-orange">Договір оферти</a>
                <div class="footer-payment"><img src="/img/payment.png" alt="LiqPay"></div>
            </div>
            <div class="footer-column">
                <p class="footer-form-text">Є питання? Давай вирішувати!</p>
                <?= \app\widgets\CallbackWidget::widget() ?>
            </div>
        </div>
    </div>
    <a href="https://yh-web.space/" class="yh-label" target="_blank"></a>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
