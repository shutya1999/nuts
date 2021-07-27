<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 25.07.2021
 * Time: 13:50
 */

namespace app\assets;


use yii\web\AssetBundle;

class AccountAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/index/index.css',
    ];
    public $js = [
//        'js/swiper-bundle.min.js',
//        'https://unpkg.com/aos@2.3.1/dist/aos.js',
//        'js/lazyload.min.js',
//        'js/general.js',
        'js/account.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}