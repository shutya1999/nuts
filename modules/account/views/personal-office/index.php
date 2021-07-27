<?//= Yii::$app->getSecurity()->generatePasswordHash("user") ?>
<!--<p class="error-review">--><?//= Yii::$app->session->getFlash("error"); ?><!--</p>-->


<?php use app\widgets\Alert; ?>

<?php //if (Yii::$app->session->hasFlash('success')) : ?>
<!--    <p>--><?//= Yii::$app->session->getFlash('success') ?><!--</p>-->
<?php //endif; ?>
<!---->
<?php //if (Yii::$app->session->hasFlash('error')) : ?>
<!--    <p>--><?//= Yii::$app->session->getFlash('error') ?><!--</p>-->
<?php //endif; ?>


<?= Alert::widget() ?>

<div class="container">
    <p class="title title-personal-office">Особистий кабінет</p>
    <div class="personal-office__nav">
        <a href="<?= \yii\helpers\Url::to('/account/personal-office') ?>" class="active">аккаунт</a>
        <a href="<?= \yii\helpers\Url::to('/account/personal-office/my-orders') ?>">Мої замовлення</a>
    </div>
    <?php $form = \yii\widgets\ActiveForm::begin([
            'options' => [
            'class' => 'personal-office__content _acc',
            'id' => 'form-acc',
        ],
    ]); ?>
        <div class="personal-office__item">
            <p class="item__title">Контактні данні</p>
            <div class="fields-wrap">
                <?= $form->field($model, 'name')->textInput(['placeholder' => 'Ваше ім’я*', 'class' => 'form-fields']) ?>
                <?= $form->field($model, 'surname')->textInput(['placeholder' => 'Ваше прізвище*', 'class' => 'form-fields']) ?>
                <?= $form->field($model, 'phone')->textInput(['placeholder' => '38(___) ___ __ __*', 'class' => 'form-fields']) ?>
                <?= $form->field($model, 'username')->textInput(['placeholder' => 'Введіть ваш email*', 'class' => 'form-fields']) ?>
            </div>
        </div>
<!--        <div class="personal-office__item _pass">-->
<!--            <p class="item__title">Пароль</p>-->
<!--            <div class="fields-wrap">-->
<!--                --><?//= $form->field($model, 'currentPassword', ['template' => "{input} \n {error}"])->textInput(['placeholder' => 'Поточний пароль*', 'class' => 'form-fields']) ?>
<!--                --><?//= $form->field($model, 'changePass', ['template' => "{input} \n {label}"])->checkbox(['class' => 'filter-checkbox'], false) ?>
<!--                --><?//= $form->field($model, 'newPassword', ['template' => "{input} \n {error}"])->hiddenInput(['placeholder' => 'Новий пароль*', 'class' => 'form-fields']) ?>
<!---->
<!--                <div class="form-group field-userinfo-newpassword">-->
<!--                    <input type="hidden" id="repeatPass" class="form-fields" name="repeat_pass" placeholder="Підтвердити новий пароль*">-->
<!--                    <div class="help-block"></div>-->
<!--                </div>-->
<!--                --><?//= $form->field($model, 'password', ['template' => "{input} \n {error}"])->hiddenInput() ?>
<!--            </div>-->
<!--        </div>-->
        <div class="mo-item _delivery">
            <p class="mo-item__title">Доставка</p>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox type-delivery__radio" id="delivery1" name="UserInfo[delivery_type]" data-delivery="novaposhta" value="Нова Пошта" <?= ($deliveryType['type'] == 'Нова Пошта' || $deliveryType['type'] == '') ? 'checked' : '' ?>>
                <label for="delivery1">Нова Пошта</label>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox type-delivery__radio" id="delivery2" name="UserInfo[delivery_type]" data-delivery="ukrposhta" value="Укрпошта" <?= ($deliveryType['type'] == 'Укрпошта') ? 'checked' : '' ?>>
                <label for="delivery2">Укрпошта</label>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox type-delivery__radio" id="delivery3" name="UserInfo[delivery_type]" data-delivery="courier" value="Кур’єрська доставка" <?= ($deliveryType['type'] == 'Кур’єрська доставка') ? 'checked' : '' ?>>
                <label for="delivery3">Кур’єрська доставка</label>
            </div>
            <div class="mo-item__wrap _radio">
                <input type="radio" class="filter-checkbox type-delivery__radio" id="delivery4" name="UserInfo[delivery_type]" data-delivery="" value="Самовивіз" <?= ($deliveryType['type'] == 'Самовивіз') ? 'checked' : '' ?>>
                <label for="delivery4">Самовивіз (с.Солонка, вул.Орлика 1)</label>
            </div>
            <div class="mo-line"></div>
            <div class="mo-item__wrap type-delivery__block_wrap">
                <?= $deliveryType['HTML'] ?>
<!--                <div class="type-delivery__block novaposhta-wrap active" data-delivery="Нова Пошта">-->
<!--                    <div class="search-city">-->
<!--                        <input type="text" class="form-fields city-name" name="UserInfo[city]" data-ref="" placeholder="Введіть місто*" autocomplete="no">-->
<!--                        <ul class="delivery-list city-list hide"></ul>-->
<!--                    </div>-->
<!--                    <div class="search-department">-->
<!--                        <input type="text" class="form-fields department-input" name="UserInfo[department_np]" placeholder="Введіть номер відділення*" autocomplete="no">-->
<!--                        <ul class="delivery-list department-list hide"></ul>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>
        <button class="btn-form btn-brown">Зберегти зміни</button>
    <?php \yii\widgets\ActiveForm::end() ?>

</div>
