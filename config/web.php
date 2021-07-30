<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'home/index',
    'language' => 'uk',
    'name' => 'Nuts City',
    'layout' => 'nuts-city',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'account' => [
            'class' => 'app\modules\account\Module',
            'layout' => 'account',
            'defaultRoute' => 'personal-office/index'
        ],
        'liqpay' => [
            'class' => 'pistol88\liqpay\Module',
            'public_key' => 'sandbox_i98817360234',
            'private_key' => 'sandbox_I4P5WasDoE8llz75Ctv7Cwyq7j36yEollT8QBCxd',
            'currency' => 'UAH',
            'pay_way' => null,
            'version' => 3,
            'sandbox' => false,
            'language' => 'ru',
            'result_url' => '/page/thanks',
            'paymentName' => 'Оплата заказа',
//            'orderModel' => 'pistol88\order\models\Order', //Модель заказа. Эта модель должна имплементировать интерфейс pistol88\liqpay\interfaces\Order. В момент списания денег будет вызываться $model->setPaymentStatus('yes').
            'orderModel' => 'models\Order', //Модель заказа. Эта модель должна имплементировать интерфейс pistol88\liqpay\interfaces\Order. В момент списания денег будет вызываться $model->setPaymentStatus('yes').

        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'DVAqyQJjX3Zy0IWWoygO-byexXQqqLiw',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/account/auth/login',
        ],
        'errorHandler' => [
            'errorAction' => 'home/myerror',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.ukr.net',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'nutscitySMTP@ukr.net',
                'password' => 'VsTJOwcRhpsYbjUi',
                'port' => '2525', // Port 25 is a very common port too
                'encryption' => 'ssl', // It is often used, check your provider or mail server specs
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'category/<id:\d+>' => 'category/view',
                'product/<url:>' => 'product/view'
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
