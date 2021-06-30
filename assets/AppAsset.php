<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://unpkg.com/swiper/swiper-bundle.min.css',
//        'css/index/index.css',
    ];
    public $js = [
        'https://cdn.lordicon.com//libs/frhvbuzj/lord-icon-2.0.2.js',
        'https://unpkg.com/swiper/swiper-bundle.min.js',
        'js/general.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
