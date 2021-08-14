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
        'js/maskinput.min.js',
        'js/account.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}