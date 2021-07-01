<?php
$this->registerCssFile('@web/css/goods/goods.css');

$images = \yii\helpers\FileHelper::findFiles("img/product/{$product->url}");
$total_review = count($product->reviews);

?>

<div class="container">
    <div class="bread-crumbs df">
        <a href="<?= \yii\helpers\Url::home() ?>" class="home"></a>
        <div class="bread-crumbs__separator"> ></div>
        <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $product->category->id]) ?>" class="bread-crumbs__text"><?= $product->category->name ?></a>
        <div class="bread-crumbs__separator"> ></div>
        <p class="bread-crumbs__text"><?= $product->title ?></p>
    </div>

    <div class="goods-cart dg">
        <div class="goods-photos">
            <div class="swiper-container gallery-main">
                <div class="arrow prev-slide"></div>
                <div class="arrow next-slide"></div>
                <div class="swiper-wrapper">
                    <?php foreach ($images as $image) : ?>
                    <div class="swiper-slide gallery-main_slide">
                        <?= \yii\helpers\Html::img("@web/$image", ["alt" => $product->title]) ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="swiper-container gallery-thumbs">
                <div class="arrow prev-slide"></div>
                <div class="arrow next-slide"></div>
                <div class="swiper-wrapper">
                    <?php for ($i = 0; $i < count($images); $i++) : ?>
                        <div class="swiper-slide gallery-thumbs_slide highlight <?= ($i == 0) ? "highlight" : ''?>">
                            <?= \yii\helpers\Html::img("@web/$images[$i]", ["alt" => $product->title]) ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <div class="goods-info">
            <h2 class="goods-name"><?= $product->title ?></h2>
            <div class="form-price" data-id="<?= $product->id ?>">
                <div class="goods-filters df">
                    <div class="goods-star">
                        <div class="product-cart__rating">
                            <span class="star-fill" style="width: calc((<?= $product->rating ?> * 100 / 5) * 1%)"></span>
                        </div>
                        <p class="review-number">
                            <?= count($product->reviews) ?>
                            <?php if ($total_review == 1 || $total_review == 21 || $total_review == 31) {?>
                                відкук
                            <?php }elseif ($total_review == 2 || $total_review == 3 || $total_review == 4 || $total_review >= 22 && $total_review <= 24) {?>
                                відгуки
                            <?php }elseif ($total_review == 0 || $total_review >= 5 && $total_review <= 20 || $total_review >= 25 && $total_review <= 30) {?>
                                відгуків
                            <?php } else{?>
                                відкуки
                            <?php } ?>
                        </p>
                    </div>
                    <div class="goods-select product-cart__count">
                        <div class="__select" data-state="">
                            <?php
                            $options = json_decode($product->option);
                            ?>
                            <div class="__select__title" data-default="Option 0"><?= key($price) ?>: <?= current($price)->quantity ?></div>
                            <div class="__select__content">
                                <?php foreach (current($options) as $key => $option) : ?>
                                    <input id="singleSelect<?= $key ?>" class="__select__input" type="radio"
                                           name="volume"
                                           value="<?= $option->quantity ?>" <? if ($key === 0) echo "checked" ?> />
                                    <label for="singleSelect<?= $key ?>"
                                           class="__select__label"><?= key($options) . ": " . $option->quantity ?></label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <p class="goods-price"><?= current($price)->price ?> ₴</p>
                </div>
                <div class="goods-filters df">
                    <div class="goods-counter">
                        <label for="count">Кількість:</label>
                        <input type="number" class="count" id="count" placeholder="1" value="1">
                        <span class="btn-counter _plus" onclick="increaseNumber(count); ajaxPriceProduct(this);"></span>
                        <span class="btn-counter _minus" onclick="reduceNumber(count); ajaxPriceProduct(this);"></span>
                    </div>
                    <a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $product->id, 'volume' => current($options)[0], 'qty' => 1])?>" onclick="addToCart(this)" data-id="<?= $product->id ?>" class="btn btn-orange btn-goods add-to-cart">
                        <p>Купити</p>
                    </a>
                </div>
            </div>

<!--            --><?php //\yii\widgets\ActiveForm::end() ?>

            <p class="text-goods">
                Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться.
                Lorem Ipsum используют потому, что тот обеспечивает более или менее. <br><br>

                Cтандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах,
                которое не получается при простой дубликации.<br><br>

                Получается при простой дубликации.
            </p>
            <p class="text-goods bold _brown" style="margin-top: 30px;">
                При замовленні від 1500 грн. - доставка за наш рахунок! <br>
                Спеціальні ціни для оптових покупців.
            </p>
        </div>
    </div>
    <div class="additional-information indent">
        <div class="additional-information__nav df">
            <div class="title active" data-additional="additional-reviews" >Відгуки</div>
            <div class="title" data-additional="additional-description" >Опис товару</div>
            <span class="indication"></span>
        </div>
        <div class="additional-information__wrap df">
            <div class="additional-js additional-reviews dg show">
                <div class="additional-reviews__wrap">
                    <div class="additional-reviews__top df">
                        <p class="text-goods review-count">
                            <?= count($product->reviews) ?>
                            <?php if ($total_review == 1 || $total_review == 21 || $total_review == 31) {?>
                                відкук
                            <?php }elseif ($total_review == 2 || $total_review == 3 || $total_review == 4 || $total_review >= 22 && $total_review <= 24) {?>
                                відгуки
                            <?php }elseif ($total_review == 0 || $total_review >= 5 && $total_review <= 20 || $total_review >= 25 && $total_review <= 30) {?>
                                відгуків
                            <?php } else{?>
                                відкуки
                            <?php } ?>
                        </p>
                        <div class="review-total-rating df">
                            <p class="text-goods">Загальний рейтинг:</p>
                            <div class="product-cart__rating">
                                <span class="star-fill" style="width: calc((<?= $product->rating ?> * 100 / 5) * 1%)"></span>
                            </div>
                        </div>
                    </div>
                    <?php if($total_review <= 5 && $total_review >= 1) { ?>
                        <div class="additional-review__content">
                            <?php foreach ($product->reviews as $review) : ?>
                                <div class="additional-user-review">
                                    <div class="additional-user-review__top df">
                                        <p class="additional-user__name bold"><?= $review->name ?></p>
                                        <div class="product-cart__rating">
                                            <span class="star-fill" style="width: calc((<?= $review->rating ?> * 100 / 5) * 1%)"></span>
                                        </div>
                                        <div class="additional-user__time bold"><?= $review->date ?></div>
                                    </div>
                                    <p class="text-goods">
                                        <?= $review->text ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        </div>
<!--                        <div class="more-reviews df">-->
<!--                            <p>Більше відгуків</p>-->
<!--                        </div>-->
                    <?php }elseif ($total_review < 1) { ?>
                        <div class="additional-review__content">
                            <p class="bold">Нажаль відгуків поки немає</p>
                        </div>
                    <?php }else { ?>
                        <div class="additional-review__content">
                            <?php for ($i = 0; $i < $total_review; $i++) : ?>
                                <div class="additional-user-review <?= ($i < 5 ) ? 'show' : 'hidden' ?>">
                                    <div class="additional-user-review__top df">
                                        <p class="additional-user__name bold"><?= $product->reviews[$i]->name ?></p>
                                        <div class="product-cart__rating">
                                            <span class="star-fill" style="width: calc((<?= $product->reviews[$i]->rating ?> * 100 / 5) * 1%)"></span>
                                        </div>
                                        <div class="additional-user__time bold"><?= $product->reviews[$i]->date ?></div>
                                    </div>
                                    <p class="text-goods">
                                        <?= $product->reviews[$i]->text ?>
                                    </p>
                                </div>
                            <?php endfor; ?>
                        </div>
                        <div class="more-reviews df">
                            <p>Більше відгуків</p>
                        </div>
                    <?php } ?>
                </div>
                <div class="additional-reviews__form">
                    <form action="" class="form df" method="POST">
                        <input class="form-fields" type="text" name="user_name" placeholder="Введіть ваше ім’я">
                        <input class="form-fields" type="text" name="user_phone" placeholder="+38 (___) ___ __ __">
                        <textarea class="form-fields _textarea" name="user_message" rows="4"
                                  placeholder="Напишіть ваш відгук*"></textarea>
                        <div class="user-rating dg">
                            <p>Рейтинг*:</p>
                            <div class="rating-area df">
                                <input type="radio" id="star-5" name="rating" value="5">
                                <label for="star-5" title="Оценка «5»"></label>
                                <input type="radio" id="star-4" name="rating" value="4">
                                <label for="star-4" title="Оценка «4»"></label>
                                <input type="radio" id="star-3" name="rating" value="3">
                                <label for="star-3" title="Оценка «3»"></label>
                                <input type="radio" id="star-2" name="rating" value="2">
                                <label for="star-2" title="Оценка «2»"></label>
                                <input type="radio" id="star-1" name="rating" value="1">
                                <label for="star-1" title="Оценка «1»"></label>
                            </div>
                        </div>
                        <button class="btn-form btn-green">Відправити</button>
                    </form>
                </div>
            </div>
            <div class="additional-js additional-description">
                <p class="text-goods">
                    Великі фісташки Каліфорнія користуються особливою популярністю серед гурманів.
                    Вони виділяються неповторним смаком і приємним ароматом. До того ж ці представники
                    класу горіхових дуже корисні. Вони містять у собі велику кількість корисних речовин,
                    нормалізують роботу деяких органів і поліпшують самопочуття людини. <br><br>

                    Купити фісташки в Україні зовсім недорого можна в нашому інтернет-магазині.
                    Ми стежимо за якістю свого товару і за його свіжістю. Ви будете здивовані смаковими
                    якостями цього корисного і дуже незвичайного горішка. Чистити його легко –
                    досить потягнути частини шкаралупи в різні боки. <br><br>

                    <span class="bold">Фісташки – користь для здоров’я</span> <br><br>

                    У складі фісташок містяться практично всі необхідні організму вітаміни.
                    Завдяки цьому лікарі радять вживати ядра горіхів для підвищення імунітету,
                    а також захисту від вірусних та інфекційних захворювань. Включення фісташок
                    у свій повсякденний раціон допомагає організму боротися з бронхітами, ангіною,
                    астмою і запаленням легенів. <br><br>

                    Сирі фісташки здатні принести багато користі для нормалізації роботи ендокринної системи.
                    Лікарі радять включати ці ядра в раціон для профілактики гестаційного цукрового діабету.
                    Вживання декількох плодів цього горіха в день допомагає знизити рівень цукру в крові,
                    а також зменшити кількість холестерину. <br><br>

                    Фісташки дуже корисні для людей, які страждають від зайвої ваги. До їх складу входить
                    велика кількість ферментів, які допомагають розщеплювати компоненти продуктів харчування
                    і засвоювати більшу частину корисних речовин. Регулярне вживання горіхів допомагає боротися
                    з виразкою, гастритом, дуоденітом, а також усувати симптоми харчових отруєнь.
                    Крім того, плоди запобігають утворенню і ріст ракових клітин в органах шлунково-кишкового
                    тракту. <br><br>

                    Горіхи багаті на зеаксантин і лютеїн, які цілюще впливають на здоров’я очей.
                    Ці антиоксиданти знижують інтенсивність розвитку вікової дегенерації жовтої плями,
                    а також захищають органи зору від захворювань на катаракту і глаукому. <br><br>

                    Солоні фісташки – справжній делікатес. Саме сіль дозволяє в повній мірі розкритися
                    смаку горішка. Але таким ласощами не варто зловживати – як відомо, сіль затримує вологу
                    в організмі, що може викликати проблеми зі здоров’ям. Але іноді себе побалувати можна. <br><br>

                    <span class="bold">Фісташки – шкода для організму</span> <br><br>

                    Надмірне вживання фісташок може завдати шкоди здоров’ю. Лікарі дозволяють їсти фісташки,
                    але лише в строго обмеженому дозуванні. Тому що згодом сіль відкладається в нирках,
                    що може привести до утворення каменів і погіршення відтоку сечі. <br><br>

                    Ядра цих горіхів не рекомендується вживати людям, які проходять процедури
                    із застосуванням ортодонтичного апарату, необхідного для коригування зубощелепних аномалій. <br><br>

                    <span class="bold">Фісташки – калорійність і харчова цінність</span> <br><br>

                    Як і всі інші представники сімейства горіхових, плоди фісташок відносяться до
                    висококалорійних продуктів. У 100 г їх ядер міститься 556 ккал. Це пов’язано з
                    високим вмістом в плодах жирних речовин – на 100 г фісташок припадає близько 50 г жирів.
                    Майже половина з них – це мононенасичені жири, які допомагають організму засвоювати корисні
                    компоненти, а також виводити шлаки і токсини. <br><br>

                    У складі плодів міститься велика кількість білків, які потрібні для будови м’язової маси.
                    У 100 г плодів міститься близько 20 г цих білків. Вуглеводів в складі ядер набагато менше –
                    близько 7 г на 100 г продукту. <br><br>

                    <span class="bold">Фісташки Каліфорнія на Nuts City – довіряйте кращим!</span> <br><br>

                    Хороша якість фісташок – це запорука високих смакових якостей і користі продукту
                    для організму людини. Наш інтернет-магазин пропонує своїм клієнтам купити фісташки
                    кращих сортів дешево і зі швидкою доставкою. <br><br>

                    У нас ви зможете замовити ядра горіхів кур’єрською доставкою на будь-яку адресу в Києві.
                    При бажанні ви можете оформити замовлення з доставкою у будь-яку інший місто в Україні.
                    Оплатити отримані фісташки в шкаралупі ви можете на банківську карту або розрахуватися
                    готівкою в руки кур’єру. <br><br>

                    Наші фісташки – найдешевші на ринку. Ми намагаємося утримувати вартість продукції,
                    тому ціна фісташок у нас завжди на 10-20% нижче середньоринкової по Україні.
                    Саме тому ціна за кг фісташок в інтернет-магазині Nuts Box приємно
                    здивує кожного нашого клієнта. <br><br>
                </p>
            </div>
        </div>
    </div>
</div>

<?php
//$js = <<<JS
//var form = $('#form-price');
//form.on('beforeSubmit', function(){
//    var data = form.serialize();
//    $.ajax({
//        url: form.attr('action'),
//        type: 'POST',
//        data: data,
//        success: function(res){
//            // reloadCatalog(res)
//            // console.log(res);
//            priceProduct(res);
//            // form[0].reset();
//        },
//        error: function(){
//            alert('Error!');
//        }
//    });
//    return false;
//});
//JS;
//$this->registerJs($js);
//?>
