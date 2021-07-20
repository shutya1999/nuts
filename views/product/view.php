<?php
$this->registerCssFile('@web/css/goods/goods.css');

$images = \yii\helpers\FileHelper::findFiles("img/product/{$product->url}");
$total_review = count($product->reviews);

//debug($total_review);

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
                            <div class="__select__title" data-default="Option 0" onclick="showSelect(this);"><?= key($price) ?>: <?= current($price)->quantity ?></div>
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
                    <?php if ($product->sale) : ?>
                        <p class="goods-price">
                            <span class="old-price"><?= $product->price ?>₴</span>
                            <?= $product->new_price ?>₴
                        </p>
                    <?php else: ?>
                        <p class="goods-price"><?= $product->price ?>₴</p>
                    <?endif;?>
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

            <div class="text-goods">
                <?= $product->content_lil ?>
                <strong class="_brown" style="margin-top: 30px;">
                    При замовленні від 1500 грн. - доставка за наш рахунок! <br>
                    Спеціальні ціни для оптових покупців.
                </strong>
            </div>
        </div>
    </div>
    <div class="additional-information indent">
        <div class="additional-information__nav df">
            <div class="title active" data-additional="additional-reviews" >Відгуки</div>
            <div class="title" data-additional="additional-description" >Опис товару</div>
            <span class="indication"></span>
        </div>
        <div class="additional-information__wrap df">
<!--            --><?php //debug($review) ?>
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
                                        <p class="additional-user__name bold"><?= \yii\helpers\Html::encode($review->name) ?></p>
                                        <div class="product-cart__rating">
                                           <span class="star-fill" style="width: calc((<?= $review->rating ?> * 100 / 5) * 1%)"></span>
                                        </div>
                                        <div class="additional-user__time bold"><?= $review->created_at ?></div>
                                    </div>
                                    <p class="text-goods">
                                        <?= \yii\helpers\Html::encode($review->text) ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        </div>
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
                                        <div class="additional-user__time bold">*/<?//= $product->reviews[$i]->created_at ?><!--</div>-->
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
                    <?php if (Yii::$app->session->hasFlash('success')) : ?>
                        <p class="success-review"><?= Yii::$app->session->getFlash("success"); ?></p>
                    <? else :?>
                        <?php if (Yii::$app->session->hasFlash('error')):?>
                            <p class="error-review"><?= Yii::$app->session->getFlash("error"); ?></p>
                        <?php endif; ?>

                        <?php $formReview = \yii\widgets\ActiveForm::begin([
                            'options' => [
                                'id' => "form-review",
                                'class' => 'form df',
                            ],
                        ]) ?>
                        <?= $formReview->field($model, 'name', ['template' => "{input}\n {error}\n {hint}"])->textInput(['class' => 'form-fields', 'placeholder' => 'Введіть ваше ім’я*'])?>
                        <?= $formReview->field($model, 'phone', ['template' => "{input}\n {error}\n {hint}"])->textInput(['class' => 'form-fields', 'placeholder' => '+38 (___) ___ __ __*'])?>
                        <?= $formReview->field($model, 'text', ['template' => "{input}\n {error}\n {hint}"])->textarea(['class' => 'form-fields _textarea', 'placeholder' => 'Напишіть ваш відгук*', 'rows' => 4, "maxlength" => '300']) ?>

                        <div class="user-rating dg">
                            <p>Рейтинг*:</p>
                            <div class="rating-area df">
                                <input type="radio" id="star-5" name="Reviews[rating]" value="5" checked>
                                <label for="star-5" title="Оценка «5»"></label>
                                <input type="radio" id="star-4" name="Reviews[rating]" value="4">
                                <label for="star-4" title="Оценка «4»"></label>
                                <input type="radio" id="star-3" name="Reviews[rating]" value="3">
                                <label for="star-3" title="Оценка «3»"></label>
                                <input type="radio" id="star-2" name="Reviews[rating]" value="2">
                                <label for="star-2" title="Оценка «2»"></label>
                                <input type="radio" id="star-1" name="Reviews[rating]" value="1">
                                <label for="star-1" title="Оценка «1»"></label>
                            </div>
                        </div>
                        <button class="btn-form btn-green">Відправити</button>
                        <?php \yii\widgets\ActiveForm::end(); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="additional-js additional-description">
                <div class="text-goods">
                    <?= $product->content_big ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<style>-->
<!--    body{background: red;}-->
<!--</style>-->