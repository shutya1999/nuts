<?php
$this->registerCssFile('@web/css/catalog/catalog.css');

use yii\widgets\ActiveForm;
use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>


<div class="catalog indent">
    <div class="container">
        <div class="catalog-wrap dg">
            <div class="filters">
                <div class="filters-category">
                    <p class="filter-title">КАТЕГОРІЇ ТОВАРУ</p>
                    <div class="filters-content _desktop">
                        <?php foreach ($categories as $category) : ?>
                            <div class="filter-item filter-category">
                                <input type="checkbox" class="filter-checkbox" id="<?= $category->url ?>"
                                       name="<?= $category->url ?>" <?= ($_GET["id"] == $category->id) ? "checked" : '' ?>
                                       value="<?= $category->url ?>">
                                <label for="<?= $category->url ?>"><?= $category->name ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="filters-additional">
                    <p class="filter-title">Фільтри вибору</p>
                    <div class="filters-content">
                        <div class="filter-item">
                            <input type="checkbox" class="filter-checkbox" id="delicious" name="delicious" value="yes">
                            <label for="delicious">смачні</label>
                        </div>
                        <div class="filter-item">
                            <input type="checkbox" class="filter-checkbox" id="mid_delicious" name="mid_delicious"
                                   value="yes">
                            <label for="mid_delicious">середньосмачні</label>
                        </div>
                        <div class="filter-item">
                            <input type="checkbox" class="filter-checkbox" id="very_delicious" name="very_delicious"
                                   value="yes">
                            <label for="very_delicious">Дуже смачні</label>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->registerJsFile('@web/js/general.js'); ?>

            <?php $form = ActiveForm::begin([
                'options' => [
                    'id' => "form-filter",
                    'class' => 'hidden-form',
                    'data' => ['pjax' => true]
                ],
            ]) ?>

            <?php ActiveForm::end() ?>
            <form action="" class="hidden-form" style="display: none;">
                <?php foreach ($categories as $category) : ?>
                    <input type="checkbox" data-id="filter_cat" class="_cat" name="<?= $category->url ?>" <?= ($_GET["id"] == $category->id) ? "checked" : '' ?>>
                <?php endforeach; ?>
                <input type="hidden" name="low_price" data-id="low_price">
                <input type="hidden" name="top_price" data-id="top_price">
                <input type="hidden" name="type_sort" data-id="type_sort">
            </form>

            <div class="catalog-content">
                <?php $form = ActiveForm::begin([
                    'method' => "get",
                    'options' => [
                        'id' => "form-sorting",
                        'class' => 'sorting df',
                        'data' => ['pjax' => true]
                    ],
                ]); ?>
                <div class="price-range df">
                    <p>Ціна:</p>
                    <?= $form->field($model, 'lower_price', [
                        'template' => "{input}"
                    ])->textInput(["type" => "number", 'class' => 'form-fields form-fields__price send-form', 'placeholder' => "60"]) ?>
                    <span class="price-range__line"></span>
                    <?= $form->field($model, 'top_price', [
                        'template' => "{input}"
                    ])->textInput(["type" => "number", 'class' => 'form-fields form-fields__price send-form', 'placeholder' => "1000"]) ?>
                </div>
                <div class="filter-mob">
                    <div class="filter-mob-tab _main">
                        <p>фільтри</p>
                    </div>
                    <div class="filter-mob-content">
                        <div class="filter-mob-tab">
                            <p>Категорії</p>
                            <div class="filter-mob-tab__list">
                                <?php foreach ($categories as $category) : ?>
                                    <div class="filter-item">
                                        <input type="checkbox" class="filter-checkbox" id="<?= $category->url ?>"
                                               name="<?= $category->url ?>" <?= ($_GET["id"] == $category->id) ? "checked" : '' ?>>
                                        <label for="<?= $category->url ?>"><?= $category->name ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="filter-mob-tab">
                            <p>фільтри вибору</p>
                            <div class="filter-mob-tab__list">
                                <div class="filter-item">
                                    <input type="checkbox" class="filter-checkbox" id="delicious" name="delicious"
                                           value="yes">
                                    <label for="delicious">смачні</label>
                                </div>
                                <div class="filter-item">
                                    <input type="checkbox" class="filter-checkbox" id="mid_delicious"
                                           name="mid_delicious" value="yes">
                                    <label for="mid_delicious">середньосмачні</label>
                                </div>
                                <div class="filter-item">
                                    <input type="checkbox" class="filter-checkbox" id="very_delicious"
                                           name="very_delicious" value="yes">
                                    <label for="very_delicious">Дуже смачні</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sorting-select">
                    <div class="__select" data-state="">
                        <div class="__select__title" data-default="Option 0">Популярні</div>
                        <div class="__select__content">
                            <?= \yii\helpers\Html::activeRadioList($model, 'sort', [
                                'popular' => "Популярні",
                                'price-up' => "За зростанням ціни",
                                'price-down' => "За спаданням ціни",
                            ],[
                                'tag' => false,
                                'item' => function ($index, $label, $name, $checked, $value) {
//                                    if ($index === 0){
//                                        $checked = true;
//                                    }
                                    $id = 'contactsData_pers-' . $index;
                                    return
                                        Html::radio($name, $checked, ['value' => $value, 'id' => $id, 'class' => '__select__input send-form']) .
                                        Html::label($label, $id, ['class' => '__select__label']);
                                },
                            ])?>
                        </div>
                    </div>
                </div>
                <button>Send</button>
                 <?php ActiveForm::end(); ?>

                <div class="catalog-goods dg">
                    <?php foreach ($products as $product) : ?>
                        <div class="product-cart">
                            <div class="product-cart__photo">
                                <?= \yii\helpers\Html::img("@web/img/product/{$product->img}", ["alt" => $product->title]) ?>
                            </div>
                            <h3 class="product-cart__name"><?= $product->title ?></h3>
                            <div class="product-cart__info dg">
                                <div class="product-cart__rating">
                                    <span class="star-fill"
                                          style="width: calc((<?= $product->rating ?> * 100 / 5) * 1%)"></span>
                                </div>
                                <div class="product-cart__price">
                                    <p>
                                        <?= $product->price ?>₴
                                        <?php if ($product->old_price) : ?>
                                            <span class="old-price"><?= $product->old_price ?>₴</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <form class="product-cart__count">
                                    <div class="__select" data-state="">
                                        <?php
                                        $options = json_decode($product->option);
                                        reset($options);
                                        ?>
                                        <?php if (key($options) === "grams") { ?>
                                            <div class="__select__title" data-default="Option 0">Грам: 200</div>
                                        <?php } elseif (key($options) === "liter") { ?>
                                            <div class="__select__title" data-default="Option 0">Літр: 1</div>
                                        <?php } elseif (key($options) === "amount") { ?>
                                            <div class="__select__title" data-default="Option 0">Штук: 1</div>
                                        <?php } elseif (key($options) === "kilogram") { ?>
                                            <div class="__select__title" data-default="Option 0">Кілограм: 1</div>
                                        <?php } ?>
                                        <div class="__select__content">
                                            <?php foreach (current($options) as $key => $option) : ?>
                                                <input id="singleSelect<?= $key ?>" class="__select__input" type="radio"
                                                       name="singleSelect"
                                                       value="<?= $option ?>" <? if ($key === 0) echo "checked" ?> />
                                                <label for="singleSelect<?= $key ?>"
                                                       class="__select__label"><?= $option ?></label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </form>
                                <div class="btn btn-orange product-cart__buy">
                                    <p>Купити</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>




<!--                --><?//= \yii\widgets\LinkPager::widget([
//                    'pagination' => $pages,
//                    'pageCssClass' => 'pagin-page',
//                    'prevPageCssClass' => 'pagin-arrow pagin-prev',
//                    'nextPageCssClass' => 'pagin-arrow pagin-next',
//                    'nextPageLabel' => '',
//                    'prevPageLabel' => '',
//                ]) ?>
<!--                                <div class="pagination df">-->
<!--                                    <a href="" class="pagin-arrow pagin-prev"></a>-->
<!--                                    <div class="pagin-page__wrap df">-->
<!--                                        <a href="" class="pagin-page"><span>1</span></a>-->
<!--                                        <a href="" class="pagin-page current"><span>2</span></a>-->
<!--                                        <a href="" class="pagin-page"><span>3</span></a>-->
<!--                                    </div>-->
<!--                                    <a href="" class="pagin-arrow pagin-next"></a>-->
<!--                                </div>-->
            </div>
        </div>
    </div>
</div>