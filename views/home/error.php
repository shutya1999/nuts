
<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
//$this->registerCssFile('@web/css/catalog/catalog.css');

//?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/general.css">
</head>
<body class="err404">
<div class="container">
    <a href="<?= \yii\helpers\Url::to('/') ?>" class="err404__logo">
        <?= Html::img('/img/logo.png') ?>
    </a>
    <div class="err404__content dg">
        <div class="err404__left">
            <?= Html::img('/img/404.svg') ?>
            <p class="err404__text">
                <span>Nooooooooooooooooooooo!!!!!!</span> <br>
                Сорі! В нас немає такої сторінки,
                повертайся на головну
            </p>
        </div>
        <div class="err404__right">
            <?= Html::img('/img/404-r.png') ?>
            <a href="/" class="btn btn-404">На головну</a>
        </div>
    </div>
</div>

</body>
</html>