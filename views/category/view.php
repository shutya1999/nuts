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
                            <input type="checkbox" class="filter-checkbox" id="mid_delicious" name="mid_delicious" value="yes">
                            <label for="mid_delicious">середньосмачні</label>
                        </div>
                        <div class="filter-item">
                            <input type="checkbox" class="filter-checkbox" id="very_delicious" name="very_delicious" value="yes">
                            <label for="very_delicious">Дуже смачні</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="catalog-content">
                <div class="sorting df">
                    <div class="price-range df">
                        <p>Ціна:</p>
                        <input type="number" class="form-fields form-fields__price _lower" placeholder="60" >
                        <span class="price-range__line"></span>
                        <input type="number" class="form-fields form-fields__price _top" placeholder="1000">
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
                                        <input type="checkbox" class="filter-checkbox" id="delicious" name="delicious" value="yes">
                                        <label for="delicious">смачні</label>
                                    </div>
                                    <div class="filter-item">
                                        <input type="checkbox" class="filter-checkbox" id="mid_delicious" name="mid_delicious" value="yes">
                                        <label for="mid_delicious">середньосмачні</label>
                                    </div>
                                    <div class="filter-item">
                                        <input type="checkbox" class="filter-checkbox" id="very_delicious" name="very_delicious" value="yes">
                                        <label for="very_delicious">Дуже смачні</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="sorting-select">
                        <div class="__select" data-state="">
                            <div class="__select__title" data-default="Option 0">Популярні</div>
                            <div class="__select__content">
                                <input id="popular" class="__select__input" type="radio" name="sorting-select" value="popular"  checked />
                                <label for="popular" class="__select__label">Популярні</label>
                                <input id="price_up" class="__select__input" type="radio" name="sorting-select" value="price-up" />
                                <label for="price_up" class="__select__label">За зростанням ціни</label>
                                <input id="price_down" class="__select__input" type="radio" name="sorting-select" value="price-down" />
                                <label for="price_down" class="__select__label">За спаданням ціни</label>
                            </div>
                        </div>
                    </form>
                </div>
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'id' => "form-filter",
                        'class' => 'hidden-form',
                    ],
                ]) ?>
                <?php $data = [];
                foreach ($categories as $category) {
                    $data[] = $category -> url;
                }?>
                <?= $form->field($model, 'category', ['template' => "{input}",])->checkboxList(array_flip($data))?>
                <?= $form->field($model, 'sort', ['template' => "{input}",])->hiddenInput(['value' => 'popular']) ?>
                <?= $form->field($model, 'lower_price', ['template' => "{input}",])->hiddenInput() ?>
                <?= $form->field($model, 'top_price', ['template' => "{input}",])->hiddenInput() ?>

                <button class="my-btn">Send</button>
                <?php ActiveForm::end() ?>

                <div class="catalog-goods dg" id="reload-container">
                    <?php foreach ($products as $product) : ?>
                        <div class="product-cart">
                            <a href="<?= \yii\helpers\Url::to(['product/view', 'url' => $product->url]) ?>"
                               class="product-cart__photo">
                                <?= \yii\helpers\Html::img("@web/img/product/{$product->img}", ["alt" => $product->title]) ?>
                            </a>
                            <h3 class="product-cart__name">
                                <a href="<?= \yii\helpers\Url::to(['product/view', 'url' => $product->url]) ?>"><?= $product->title ?></a>
                            </h3>
                            <div class="product-cart__info dg form-price" data-id="<?= $product->id ?>">
                                <div class="product-cart__rating">
                                            <span class="star-fill"
                                                  style="width: calc((<?= $product->rating ?> * 100 / 5) * 1%)"></span>
                                </div>
                                <div class="product-cart__price">
                                    <p class="goods-price">
                                        <?= $product->price ?>₴
                                        <?php if ($product->old_price) : ?>
                                            <span class="old-price"><?= $product->old_price ?>₴</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div class="product-cart__count">
                                    <div class="__select" data-state="">
                                        <?php $options = json_decode($product->option); ?>
                                        <div class="__select__title" data-default="Option 0">
                                            <?= key($options) ?>: <?= current($options)[0]->quantity ?>
                                        </div>
                                        <div class="__select__content">
                                            <?php foreach (current($options) as $key => $option) : ?>
                                                <input id="singleSelect<?= $key ?>_<?= $product->id ?>"
                                                       class="__select__input" type="radio"
                                                       name="volume_<?= $product->id ?>"
                                                       value="<?= $option->quantity ?>" <? if ($key === 0) echo "checked" ?> />
                                                <label for="singleSelect<?= $key ?>_<?= $product->id ?>"
                                                       class="__select__label"><?= key($options) . ": " . $option->quantity ?></label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $product->id, 'volume' => current($options)[0], 'qty' => 1]) ?>"
                                   data-id="<?= $product->id ?>" onclick="addToCart(this)" class="btn btn-orange product-cart__buy add-to-cart">
                                    <p>Купити</p>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
var form = $('#form-filter');
form.on('beforeSubmit', function(){
    var data = form.serialize();
    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: data,
        success: function(res){
            reloadCatalog(res)
            // form[0].reset();
        },
        error: function(){
            alert('Error!');
        }
    });
    return false;
});
JS;

$this->registerJs($js);

?>
