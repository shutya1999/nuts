<?php $this->registerCssFile('@web/css/index/index.css'); ?>

<main class="banner">
    <div class="container">
        <div class="swiper-container banner-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="/img/index/banner.png" alt="Banner 1">
                </div>
                <div class="swiper-slide">
                    <img src="/img/index/banner.png" alt="Banner 1">
                </div>
                <div class="swiper-slide">
                    <img src="/img/index/banner.png" alt="Banner 1">
                </div>
                <div class="swiper-slide">
                    <img src="/img/index/banner.png" alt="Banner 1">
                </div>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</main>

<div class="index-category indent">
    <div class="container">
        <div class="index-category__content dg">
            <?php for ($i = 0; $i < count($categories); $i++) : ?>
                <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $categories[$i]['id']]) ?>"
                   class="index-category__item df" data-aos="zoom-in" data-aos-delay="<?= $i * 100 ?>" data-aos-once="true">
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
                            <div class="swiper-slide product-cart" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>" data-aos-once="true">
                                <a href="<?= \yii\helpers\Url::to(['product/view', 'url' => $offers[$i]->url]) ?>"
                                   class="product-cart__photo">
                                    <?= \yii\helpers\Html::img("@web/img/product/{$offers[$i]->img}", ["alt" => $offers[$i]->title]) ?>
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
                                        <p class="goods-price">
                                            <?= $offers[$i]->price ?>₴
                                            <?php if ($offers[$i]->old_price) : ?>
                                                <span class="old-price"><?= $offers[$i]->old_price ?>₴</span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="product-cart__count">
                                        <div class="__select" data-state="">
                                            <?php $options = json_decode($offers[$i]->option); ?>
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
                    Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться.
                    Lorem Ipsum используют потому, что тот обеспечивает более или менее <br><br>

                    Cтандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах,
                    которое не получается при простой дубликации. <br><br>

                    Получается при простой дубликации.
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
                            Instagram. <a href="">Ознайомитись→</a>
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

<section class="instagram indent">
    <div class="container">
        <h2 class="title">Ми в <span class="_brown">INSTAGRAM</span></h2>
        <div class="instagram-content df">
            <div class="instagram-photo dg">
                <div class="instagram-photo--item" style="background-image: url('/img/index/insta/photo1.jpg')"></div>
                <div class="instagram-photo--item" style="background-image: url('/img/index/insta/photo2.jpg')"></div>
                <div class="instagram-photo--item" style="background-image: url('/img/index/insta/photo3.jpg')"></div>
                <div class="instagram-photo--item" style="background-image: url('/img/index/insta/photo4.jpg')"></div>
                <div class="instagram-photo--item" style="background-image: url('/img/index/insta/photo5.jpg')"></div>
                <div class="instagram-photo--item" style="background-image: url('/img/index/insta/photo6.jpg')"></div>
                <div class="instagram-photo--item" style="background-image: url('/img/index/insta/photo7.jpg')"></div>
                <div class="instagram-photo--item" style="background-image: url('/img/index/insta/photo8.jpg')"></div>
                <div class="instagram-photo--item" style="background-image: url('/img/index/insta/photo9.jpg')"></div>
            </div>
            <div class="instagram-info">
                <p class="text instagram-text">
                    Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться.
                    Lorem Ipsum используют потому, что тот обеспечивает более или менее. <br><br>

                    Cтандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах,
                    которое не получается при простой дубликации.<br><br>

                    Получается при простой дубликации.
                </p>
                <p class="instagram-info__title">
                    Набір горіхів "Горішковий MIX"
                </p>
                <a href="" class="btn btn-orange btn-instagram">
                    <p>Підписатись в Instagram</p>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="review indent" id="review">
    <div class="container">
        <h2 class="title">GooGle відгуки</h2>
        <div class="review-top df">
            <div class="review__company-info">
                <p class="review__company-name">NUTS CITY</p>
                <p class="review__company-address">Орлика, 1, Солонка, Львівська область</p>
                <div class="review__company-rating df">
                    <p>5,0</p>
                    <div class="review-star"><span style="width: calc((100% * 4) / 5)"></span></div>
                </div>
            </div>
            <a href="" class="btn btn-green review-top__link">
                <p>Подивитись в GoogleВідгуках</p>
            </a>
        </div>
        <div class="review-content">
            <div class="review-item df">
                <div class="review__user-info dg">
                    <img src="/img/index/review/user-photo1.png" alt="" class="review__user-avatar">
                    <p class="review__user-name">Вячеслав Трембач</p>
                    <div class="review-star"><span style="width: calc((100% * 4) / 5)"></span></div>
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
                        <img src="/img/index/review/user-review-photo1.png" alt="">
                        <img src="/img/index/review/user-review-photo2.png" alt="">
                    </div>
                </div>
            </div>

            <div class="review-item df">
                <div class="review__user-info dg">
                    <img src="/img/index/review/user-photo2.png" alt="" class="review__user-avatar">
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
                        <img src="/img/index/review/user-review-photo2.png" alt="">
                    </div>
                </div>
            </div>

            <div class="review-item df">
                <div class="review__user-info dg">
                    <img src="/img/index/review/user-photo3.png" alt="" class="review__user-avatar">
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
            <div class="more-reviews df">
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
            <a href="">Більш детальна інформація</a>
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
                <a href="tel:+380 68 123 73 21" class="contacts-text _hover-orange"> +380 68 123 73 21</a>
                <a href="tel:+380 68 123 73 21" class="contacts-text _hover-orange"> +380 68 123 73 21</a>
            </div>
            <div class="contacts-column">
                <p class="contacts-column__title">Email:</p>
                <a href="mailto:nutscity@ukr.net" class="contacts-text _hover-orange">nutscity@ukr.net</a>
                <div class="contacts-mesh">
                    <a href=""></a>
                    <a href=""></a>
                    <a href=""></a>
                    <a href=""></a>
                </div>
            </div>
            <div class="contacts-column">
                <p class="contacts-column__title">Адреса:</p>
                <p class="contacts-text">вул. Орлика, 1, с. Солонка, <br> 81131</p>
            </div>
        </div>
    </div>
</section>
