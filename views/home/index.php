<?php
use toriphes\lazyload\LazyLoad;

$this->registerCssFile('@web/css/index/index.css');
$this->registerJsFile('@web/js/lord-icon.min.js');
?>


<main class="banner">
    <div class="container">
        <div class="swiper-container banner-slider">
            <div class="swiper-wrapper">
                <?php foreach ($banner as $slide) : ?>
                    <div class="swiper-slide">
                        <a href="<?= $slide->link ?>">
                            <img class="lazy _desktop" src="data:image/gif;base64,R0lGODlhAwABAIAAAP///wAAACH5BAEAAAEALAAAAAADAAEAAAICjAsAOw=="
                                 data-src="/img/banner-main/<?= $slide->desktop ?>" >
                            <img class="lazy _tablet" src="data:image/gif;base64,R0lGODlhCQAFAIAAAP///wAAACH5BAEAAAEALAAAAAAJAAUAAAIFjI+py10AOw=="
                                 data-src="/img/banner-main/<?= $slide->tablet ?>" >
                            <img class="lazy _mob" src="data:image/gif;base64,R0lGODlhSQBQAIAAAP///wAAACH5BAEAAAEALAAAAABJAFAAAAJUjI+py+0Po5y02ouz3rz7D4biSJbmiabqyrbuC8fyTNf2jef6zvf+DwwKh8Si8YhMKpfMpvMJjUqn1Kr1is1qt9yu9wsOi8fksvmMTqvX7Lb7LSwAADs="
                                 data-src="/img/banner-main/<?= $slide->mobile ?>" >
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</main>

<div class="index-category indent">
    <div class="container">
        <div class="index-category__content dg">
            <?php for ($i = 0; $i < count($categories); $i++) : ?>
                <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $categories[$i]['id']]) ?>"
                   class="index-category__item df" data-aos="zoom-in" data-aos-once="true" data-aos-offset="100">
                    <h2 class="cat-title"><?= $categories[$i]->name ?></h2>
                    <div class="index-category__img">
                        <?= \yii\helpers\Html::img("/img/index/{$categories[$i]->img}", ["alt" => "Nuts City {$categories[$i]->name}"]) ?>
                    </div>
                    <div class="index-category__link df">
                        <p>Переглянути</p>
                        <div class="arrow"></div>
                    </div>
                </a>
            <?php endfor; ?>
        </div>
    </div>
</div>
<?php if (!empty($offers)) : ?>
    <div class="hit-products">
        <div class="container">
            <h2 class="title">хіт-продукція</h2>
            <div class="hit-products__wrap">

                <div class="hit-products__pagin hit-products__prev"></div>
                <div class="hit-products__pagin hit-products__next"></div>

                <div class="hit-products__content swiper-container">
                    <div class="swiper-wrapper">
                        <?php for($i = 0; $i < count($offers); $i++) : ?>
                            <div class="swiper-slide product-cart">
                                <a href="<?= \yii\helpers\Url::to(['product/view', 'url' => $offers[$i]->url]) ?>" class="product-cart__photo" data-aos="zoom-in" data-aos-once="true" data-aos-offset="50">
                                    <img class="lazy main-photo" src="/img/load.gif"
                                         data-src = "<?= "/img/product/{$offers[$i]->url}/{$offers[$i]->img}" ?>"
                                         alt="<?= $offers[$i]->title ?>">

                                    <img class="lazy sec-photo" src="data:image/gif;base64,R0lGODlhOgAnAIAAAP///wAAACH5BAEAAAEALAAAAAA6ACcAAAIwjI+py+0Po5y02ouz3rz7D4biSJbmiabqyrbuC8fyTNf2jef6zvf+DwwKh8Si8VYAADs="
                                         data-src = "<?= "/img/product/{$offers[$i]->url}/{$offers[$i]->sec_img}" ?>"
                                         alt="<?= $offers[$i]->title ?>">
                                </a>
                                <h3 class="product-cart__name">
                                    <a href="<?= \yii\helpers\Url::to(['product/view', 'url' => $offers[$i]->url]) ?>"><?= $offers[$i]->title ?></a>
                                </h3>
                                <div class="product-cart__info dg form-price" data-id="<?= $offers[$i]->id ?>">
                                    <div class="product-cart__rating">
                                        <span class="star-fill"
                                              style="width: calc((<?= $offers[$i]->rating ?> * 100 / 5) * 1%)"></span>
                                    </div>
                                    <div class="product-cart__price">
                                            <?php if ($offers[$i]->sale) : ?>
                                                <p class="goods-price">
                                                    <span class="old-price"><?= $offers[$i]->price ?>₴</span>
                                                    <?= $offers[$i]->new_price ?>₴
                                                </p>
                                                <div class="sale-block">
                                                    <p>Знижка</p>
                                                    <span><?= $offers[$i]->sale ?> %</span>
                                                </div>
                                            <?php else: ?>
                                                <p class="goods-price"><?= $offers[$i]->price ?>₴</p>
                                            <?endif;?>
                                    </div>
                                    <?php $options = json_decode($offers[$i]->option); ?>
                                    <?php if(key($options) != 'Box') : ?>
                                        <div class="product-cart__count">
                                            <div class="__select" data-state="">
                                                <div class="__select__title" data-default="Option 0" onclick="showSelect(this);">
                                                    <?= key($options) ?>: <?= current($options)[0]->quantity ?>
                                                </div>
                                                <div class="__select__content">
                                                    <?php foreach (current($options) as $key => $option) : ?>
                                                        <input id="singleSelect<?= $key ?>_<?= $offers[$i]->id ?>"
                                                               class="__select__input" type="radio"
                                                               name="volume_<?= $offers[$i]->id ?>"
                                                               value="<?= $option->quantity ?>" <? if ($key === 0) echo "checked" ?> />
                                                        <label for="singleSelect<?= $key ?>_<?= $offers[$i]->id ?>"
                                                               class="__select__label"><?= key($options) . ": " . $option->quantity ?></label>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                    <div class="product-cart__count">
                                        <div class="__select" data-state="">
                                            <div class="__select__title" data-default="Option 0" onclick="showSelect(this);">
                                                <?= current($options)[0]->title ?>
                                            </div>
                                            <div class="__select__content">
                                                <?php foreach (current($options) as $key => $option) : ?>
                                                    <input id="singleSelect<?= $key ?>_<?= $offers[$i]->id ?>"
                                                           class="__select__input" type="radio"
                                                           name="volume_<?= $offers[$i]->id ?>"
                                                           value="<?= $option->quantity ?>" <? if ($key === 0) echo "checked" ?> />
                                                    <label for="singleSelect<?= $key ?>_<?= $offers[$i]->id ?>"
                                                           class="__select__label"><?= $option->title ?></label>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $offers[$i]->id, 'volume' => current($options)[0], 'qty' => 1]) ?>"
                                       data-id="<?= $offers[$i]->id ?>" onclick="addToCart(this)" class="btn btn-orange product-cart__buy add-to-cart">
                                        <p>Купити</p>
                                    </a>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<section class="about indent" id="about">
    <div class="container">
        <div class="about-content">
            <h2 class="title">трІШКИ про <span class="_brown">NUTS CITY</span></h2>
            <div class="about-info dg">
                <p class="text about-info__text">
                    Ми молода сім‘я Андрій та Ірина. Двоє непосид, які горять своєю справою. Любимо горіхи, обожнюємо свою роботу та вас.

                    <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="15px" height="15px" viewBox="0 0 1280.000000 1189.000000" preserveAspectRatio="xMidYMid meet">
                        <metadata>
                            Created by potrace 1.15, written by Peter Selinger 2001-2017
                        </metadata>
                        <g transform="translate(0.000000,1189.000000) scale(0.100000,-0.100000)" fill="#FF0000" stroke="none">
                            <path d="M3250 11884 c-25 -2 -106 -11 -180 -20 -1485 -172 -2704 -1295 -3001 -2764 -133 -660 -67 -1507 171 -2223 252 -753 675 -1411 1397 -2172 342 -360 634 -630 1588 -1470 231 -203 488 -430 570 -505 1024 -920 1735 -1692 2346 -2547 l130 -183 132 0 132 1 130 192 c557 822 1212 1560 2185 2461 191 178 408 373 1027 923 956 852 1445 1343 1841 1850 643 825 968 1603 1064 2553 19 196 17 665 -5 835 -105 805 -441 1497 -998 2054 -557 557 -1250 894 -2054 998 -193 24 -613 24 -810 0 -733 -93 -1379 -387 -1920 -874 -191 -172 -406 -417 -535 -610 -30 -45 -57 -82 -60 -82 -3 0 -30 37 -60 82 -129 193 -344 438 -535 610 -531 478 -1170 773 -1878 867 -146 20 -562 34 -677 24z"/>
                        </g>
                    </svg>

                    <br><br>

                    Цей інтернет-магазин був створений для тих, хто думає про своє фізичне та психологічне здоров’я, оскільки горіхи мають дуже позитивний ефект на життєдіяльність людини.<br><br>

                    Ми більше ніж 2 роки працюємо з горіхами й наша продукція є еталоном якості. Ви можете в цьому переконатись, коли побачите кількість позитивних відгуків у нас в Google або в Instagram
                </p>
                <div class="about-info__img">
                    <img src="/img/index/about.png" alt="Nuts City About">
                </div>
            </div>
            <div class="benefits df">
                <div class="benefits-list">
                    <div class="benefits-item dg">
                        <div class="circle-icon benefits-item__icon df">
                            <lord-icon
                                    src="https://cdn.lordicon.com//rjzlnunf.json"
                                    trigger="loop"
                                    colors="primary:#92ff6c,secondary:#6f4027"
                                    style="width:90%; height:90%">
                            </lord-icon>
                        </div>
                        <p class="benefits-item__title">Свіжі, корисні та смачні</p>
                        <p class="text benefits-item__text">
                            Ми турбуємось про наших клієнтів
                            і гарантуємо якість наших продуктів,
                            продукція проходить відбір та
                            потрапляє до вас в найкращому вигляді
                        </p>
                    </div>
                    <div class="benefits-item dg">
                        <div class="circle-icon benefits-item__icon df">
                            <lord-icon
                                    src="https://cdn.lordicon.com//mdgrhyca.json"
                                    trigger="loop"
                                    colors="primary:#92ff6c,secondary:#6f4027"
                                    style="width:90%;height:90%">
                            </lord-icon>
                        </div>
                        <p class="benefits-item__title">500+ відкугів від клієнтів</p>
                        <p class="text benefits-item__text">
                            Розуміємо потребу клієнтів та надаємо
                            сервіс вищого рівня. Багато задоволених клієнтів залишають нам відгуки в
                            Instagram. <a style="color: #FFC76C" href="https://www.instagram.com/nuts.city/">Ознайомитись→</a>
                        </p>
                    </div>
                    <div class="benefits-item dg">
                        <div class="circle-icon benefits-item__icon df">
                            <lord-icon
                                    src="https://cdn.lordicon.com//kbtmbyzy.json"
                                    trigger="loop"
                                    colors="primary:#92ff6c,secondary:#6f4027"
                                    style="width:90%; height:90%">
                            </lord-icon>
                        </div>
                        <p class="benefits-item__title">4 роки на ринку горішків</p>
                        <p class="text benefits-item__text">
                            В нас є оффлайн пункт продажу і репутація, яка підтверджена роками
                            праці. Ви можете зателефонувати нам
                            і отримати всю необхідну інформацію
                        </p>
                    </div>
                    <div class="benefits-item dg">
                        <div class="circle-icon benefits-item__icon df">
                            <lord-icon
                                    src="https://cdn.lordicon.com//zzcjjxew.json"
                                    trigger="loop"
                                    colors="primary:#92ff6c,secondary:#6f4027"
                                    style="width:90%; height:90%">
                            </lord-icon>
                        </div>
                        <p class="benefits-item__title">Доставка по всій Україні</p>
                        <p class="text benefits-item__text">
                            Завдяки сервісу Нової Пошти ви отримаєте ваше замовлення
                            в найближчий до вас пункт,
                            в зручний для вас час
                        </p>
                    </div>
                </div>
                <div class="benefits-img"><img src="/img/index/benefits.png" alt="Nuts City"></div>
            </div>
        </div>
    </div>
</section>

<?php if (isset($instaFeed) && !empty($instaFeed)) : ?>
    <section class="instagram indent">
        <div class="container">
            <h2 class="title">Ми в <span class="_brown">INSTAGRAM</span></h2>
            <div class="instagram-content df">
                <div class="instagram-photo dg">
                    <?php foreach ($instaFeed as $post) : ?>
                        <a href="<?= $post['link'] ?>" class="instagram-photo--item" style="background-image: url('<?= $post['img'] ?>')" target="_blank"></a>
                    <?php endforeach; ?>
                </div>
                <div class="instagram-info">
                    <p class="text instagram-text">
                        Запрошуємо всіх підписатись до нашої Instagram сторінки,
                        ми періодично влаштовуємо конкурси та анонсуємо нові смаколики <br>🤤<br><br>

                        Також ми ділимося з  вами коханням та цікавими новинами у світі горішків<br>
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="15px" height="15px" viewBox="0 0 1280.000000 1189.000000" preserveAspectRatio="xMidYMid meet">
                            <metadata>
                                Created by potrace 1.15, written by Peter Selinger 2001-2017
                            </metadata>
                            <g transform="translate(0.000000,1189.000000) scale(0.100000,-0.100000)" fill="#FF0000" stroke="none">
                                <path d="M3250 11884 c-25 -2 -106 -11 -180 -20 -1485 -172 -2704 -1295 -3001 -2764 -133 -660 -67 -1507 171 -2223 252 -753 675 -1411 1397 -2172 342 -360 634 -630 1588 -1470 231 -203 488 -430 570 -505 1024 -920 1735 -1692 2346 -2547 l130 -183 132 0 132 1 130 192 c557 822 1212 1560 2185 2461 191 178 408 373 1027 923 956 852 1445 1343 1841 1850 643 825 968 1603 1064 2553 19 196 17 665 -5 835 -105 805 -441 1497 -998 2054 -557 557 -1250 894 -2054 998 -193 24 -613 24 -810 0 -733 -93 -1379 -387 -1920 -874 -191 -172 -406 -417 -535 -610 -30 -45 -57 -82 -60 -82 -3 0 -30 37 -60 82 -129 193 -344 438 -535 610 -531 478 -1170 773 -1878 867 -146 20 -562 34 -677 24z"/>
                            </g>
                        </svg>
                        <br><br>
                        Тут ви можете подивитися відгуки та отримати інформацію про спеціальні пропозиції.
                    </p>
                    <p class="instagram-info__title">
                        Станьте ближче до NutsCity 👇
                    </p>
                    <a href="https://www.instagram.com/nuts.city/" class="btn btn-orange btn-instagram" target="_blank">
                        <p>Підписатись в Instagram</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>

<section class="review indent" id="review">
    <div class="container">
        <h2 class="title">GooGle відгуки</h2>
        <div class="review-top df">
            <div class="review__company-info">
                <p class="review__company-name">NUTS CITY</p>
                <p class="review__company-address"><?= $this->context->information['address'] ?></p>
                <div class="review__company-rating df">
                    <p>5,0</p>
                    <div class="review-star"><span style="width: calc((100% * 5) / 5)"></span></div>
                </div>
            </div>
            <a href="https://www.google.com/search?gs_ssp=eJzj4tVP1zc0LCwuMjIyMCk2YLRSNagwMTdOTEmxMLcwMklMSTY3tzKoSDU0MjWxTDNKs0yyMEwxSPbizCstKVZIziypBABJNhKt&q=nuts+city&rlz=1C1SQJL_enUA886UA886&oq=nuts&aqs=chrome.2.69i60j69i57j46i39i175i199j46i175i199j0j69i60l3.3588j1j1&sourceid=chrome&ie=UTF-8#lrd=0x473add87824adc77:0xe12549f2f9b81d0c,1,,," class="btn btn-green review-top__link" target="_blank">
                <p>Подивитись в GoogleВідгуках</p>
            </a>
        </div>
        <div class="review-content">
            <div class="review-item df">
                <div class="review__user-info dg">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAEALAAAAAABAAEAAAICTAEAOw=="
                            data-src="/img/index/review/user-photo1.png" alt="" class="lazy review__user-avatar">
                    <p class="review__user-name">Вячеслав Трембач</p>
                    <div class="review-star"><span style="width: calc((100% * 5) / 5)"></span></div>
                    <span class="review__user-time">місяць назад</span>
                </div>
                <div class="user-review">
                    <p class="user-review__text">
                        Взял два набора + фисташки, отправили в тот же день, выглядит красиво 🙂 не пробовал,
                        т.к. бралось на подарок, буду ждать отзыв от тех кто будет пробовать, НО думаю,
                        всё вкусно, по виду - так точно 🙂
                        Спасибо @nuts.city
                    </p>
                    <div class="user-review__photos df">
                        <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAEALAAAAAABAAEAAAICTAEAOw=="
                                data-src="/img/index/review/user-review-photo1.png" alt="">
                        <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAEALAAAAAABAAEAAAICTAEAOw=="
                                data-src="/img/index/review/user-review-photo2.png" alt="">
                    </div>
                </div>
            </div>

            <div class="review-item df">
                <div class="review__user-info dg">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAEALAAAAAABAAEAAAICTAEAOw=="
                            data-src="/img/index/review/user-photo2.png" alt="" class="lazy review__user-avatar">
                    <p class="review__user-name">Вероника Бондарец</p>
                    <div class="review-star"><span style="width: calc((100% * 5) / 5)"></span></div>
                    <span class="review__user-time">2 місяця назад</span>
                </div>
                <div class="user-review">
                    <p class="user-review__text">
                        В полном восторге! Очень презентабельный подарок 🎁 🤩 Орешки очень вкусные 🌰👍 Спасибо
                        Вам огромное! И отдельно, за быструю коммуникацию , даже в позднее время суток , и оперативную
                        отправку !
                        Теперь только к Вам 🐿
                    </p>
                    <div class="user-review__photos df">
                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAEALAAAAAABAAEAAAICTAEAOw=="
                                data-src="/img/index/review/user-review-photo2.png" alt="" class="lazy">
                    </div>
                </div>
            </div>

            <div class="review-item df">
                <div class="review__user-info dg">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAEALAAAAAABAAEAAAICTAEAOw=="
                            data-src="/img/index/review/user-photo3.png" alt="" class="lazy review__user-avatar">
                    <p class="review__user-name">Андрей Резников</p>
                    <div class="review-star"><span style="width: calc((100% * 5) / 5)"></span></div>
                    <span class="review__user-time">2 місяця назад</span>
                </div>
                <div class="user-review">
                    <p class="user-review__text">
                        Заказал впервые на подарок учителям на 8 марта подарочный набор "Казка" .
                        Очень красивое и презентабельное оформление не говоря о том что содержимое
                        коробочки очень красивое, вкусное и полезное. Всё в восторге. Спасибо.
                    </p>
                </div>
            </div>

            <div class="review-item hidden-review df">
                <div class="review__user-info dg">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAEALAAAAAABAAEAAAICTAEAOw=="
                         data-src="/img/index/review/user-photo4.png" alt="" class="lazy review__user-avatar">
                    <p class="review__user-name">Yaroslav Malyk</p>
                    <div class="review-star"><span style="width: calc((100% * 5) / 5)"></span></div>
                    <span class="review__user-time">5 місяців тому</span>
                </div>
                <div class="user-review">
                    <p class="user-review__text">
                        Чудова знахідка)) Горішки і сухофрукти постійно свіжі та великі і дужееее смачні. Значний вибір горішок і сухофруктів також є інші товари як соки, крупи, кава ... Дуже гарні подарункові комплекти з приємними сюрпризами - завжди цілі та цікаві - дуже гарно получається на подарунок - не однарозово ними користувався.

                        Дякую NutsCity за позитив в роботі та настрій який ви даруєте людям Ви завжди орієнтовані на клієнта!!!!!
                    </p>
                </div>
            </div>

            <div class="review-item hidden-review df">
                <div class="review__user-info dg">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAEALAAAAAABAAEAAAICTAEAOw=="
                         data-src="/img/index/review/user-photo5.png" alt="" class="lazy review__user-avatar">
                    <p class="review__user-name">Алёна Репях</p>
                    <div class="review-star"><span style="width: calc((100% * 5) / 5)"></span></div>
                    <span class="review__user-time">4 місяці тому</span>
                </div>
                <div class="user-review">
                    <p class="user-review__text">
                        Дуже дякуємо за смачні горішки😍😍😍😍😍 і подаруночок-смаколик😋😋😋, дуже приємно!!!! Молодці, якість товару та обслуговування на найвищому рівні👍🏻👍🏻👍🏻 замовляла вперше і тепер буду постійно😋😋😋😋
                    </p>
                </div>
            </div>

            <div class="review-item hidden-review df">
                <div class="review__user-info dg">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAEALAAAAAABAAEAAAICTAEAOw=="
                         data-src="/img/index/review/user-photo6.png" alt="" class="lazy review__user-avatar">
                    <p class="review__user-name">Ярослав Бойчук</p>
                    <div class="review-star"><span style="width: calc((100% * 5) / 5)"></span></div>
                    <span class="review__user-time">5 місяців тому</span>
                </div>
                <div class="user-review">
                    <p class="user-review__text">
                        Рекомендую всім купувати горішки саме тут!!! Сам вже більше року купую як горішки так і різні сушені ласощі і жодного разу не було чогось щоб мені не сподобалося! Завжди свіже, завжди смачно!!! І дуже люблю коли є якісь промо коди на знижки 😜 А ще був вражений подарунковою коробкою 😎 Це супер корисний подарунок і не шкодить здоров’ю як цукерки і дуууже смачно!!!
                    </p>
                </div>
            </div>


            <div class="more-reviews df" onclick="showReview()">
                <p>Більше відгуків</p>
            </div>
        </div>
    </div>
</section>

<section class="delivery indent" id="delivery">
    <div class="container">
        <h2 class="title">Доставка І оплата</h2>
        <div class="delivery-content df">
            <div class="delivery-item df">
                <div class="circle-icon delivery-icon df">
                    <lord-icon
                            src="https://cdn.lordicon.com//slkvcfos.json"
                            trigger="loop"
                            colors="primary:#92ff6c,secondary:#6f4027"
                            style="width:80%;height:80%">
                    </lord-icon>
                </div>
                <p class="text delivery-text">
                    Ви робите <br>
                    замовлення <br>
                    у нас на сайті
                </p>
            </div>

            <div class="delivery-item df">
                <div class="circle-icon delivery-icon df">
                    <lord-icon
                            src="https://cdn.lordicon.com//zpxybbhl.json"
                            trigger="loop"
                            colors="primary:#92ff6c,secondary:#6f4027"
                            style="width:80%;height:80%">
                    </lord-icon>
                </div>
                <p class="text delivery-text">
                    Ми телефонуємо <br>
                    та підтверджуємо <br>
                    замовлення
                </p>
            </div>

            <div class="delivery-item df">
                <div class="circle-icon delivery-icon df">
                    <lord-icon
                            src="https://cdn.lordicon.com//nlzvfogq.json"
                            trigger="loop"
                            colors="primary:#92ff6c,secondary:#6f4027"
                            style="width:80%;height:80%">
                    </lord-icon>
                </div>
                <p class="text delivery-text">
                    Відправляємо замовлення <br>
                    (наложеним платежем <br>
                    або за предоплатою)
                </p>
            </div>
        </div>
        <div class="more-delivery df">
            <a href="<?= \yii\helpers\Url::to(['/home/delivery']) ?>">Більш детальна інформація</a>
        </div>
    </div>
</section>

<section class="contacts" id="contacts">
    <div class="container">
        <h2 class="title title-contacts">Контакти</h2>
        <div class="contacts-content df">
            <div class="contacts-column">
                <p class="contacts-column__title">Графік работи:</p>
                <p class="contacts-text">Пн-Пт 10:00-20:00</p>
                <p class="contacts-text">Сб-Нд 10:00-15:00</p>
            </div>
            <div class="contacts-column">
                <p class="contacts-column__title">Телефони:</p>
                <a href="tel:<?= $this->context->information['phone1']?>" class="contacts-text _hover-orange"><?= $this->context->information['phone1']?></a>
                <a href="tel:<?= $this->context->information['phone2']?>" class="contacts-text _hover-orange"><?= $this->context->information['phone2']?></a>
            </div>
            <div class="contacts-column">
                <p class="contacts-column__title">Email:</p>
                <a href="mailto:<?= $this->context->information['email'] ?>" class="contacts-text _hover-orange"><?= $this->context->information['email'] ?></a>
                <div class="contacts-mesh">
                    <a href="<?= $this->context->information['instagram'] ?>"></a>
                    <a href="<?= $this->context->information['facebook'] ?>"></a>
                    <a href="<?= $this->context->information['viber'] ?>"></a>
                    <a href="<?= $this->context->information['telegram'] ?>"></a>
                </div>
            </div>
            <div class="contacts-column">
                <p class="contacts-column__title ">Адреса:</p>
                <a href="<?= $this->context->information['maps'] ?>" class="contacts-text _hover-orange" target="_blank"><?= $this->context->information['address'] ?></a>
            </div>
        </div>
    </div>
</section>