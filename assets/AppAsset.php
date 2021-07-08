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
        'css/swiper.min.css',
        'https://unpkg.com/aos@2.3.1/dist/aos.css'
    ];
    public $js = [
        //'https://cdn.lordicon.com//libs/frhvbuzj/lord-icon-2.0.2.js',
        'js/swiper-bundle.min.js',
        'https://unpkg.com/aos@2.3.1/dist/aos.js',
        'js/general.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
