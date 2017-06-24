<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'business-card',
    'name' => 'My Company',
    'language' => 'en-US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'storage'],
    'modules' => [
        'uploadimage' => 'dkhlystov\uploadimage\Module',
        'cms' => 'cms\Module',
        'page' => 'cms\page\frontend\Module',
        'contact' => 'cms\contact\frontend\Module',
        'news' => 'cms\news\frontend\Module',
        'feedback' => 'cms\feedback\frontend\Module',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'cms\user\common\components\User',
            'identityClass' => 'cms\user\common\models\User',
            'loginUrl' => ['/user/login/index'],
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['pattern' => 'cms', 'route' => '/cms/default/index'],
                ['pattern' => 'cms/login', 'route' => '/cms/user/login/index'],
                ['pattern' => 'cms/logout', 'route' => '/cms/user/logout/index'],
                ['pattern' => 'contacts', 'route' => '/contact/contact/index', 'suffix' => '.html'],
                ['pattern' => 'news', 'route' => '/news/news/index'],
                ['pattern' => 'news/<alias:[\w\-]+>', 'route' => '/news/news/view', 'suffix' => '.html'],
                ['pattern' => 'feedback', 'route' => '/feedback/feedback/index'],
                ['pattern' => '<alias:[\w\-]+>', 'route' => '/page/page/index', 'suffix' => '.html'],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'assetManager' => [
            'forceCopy' => YII_DEBUG,
        ],
        'storage' => [
            'class' => 'dkhlystov\storage\components\FileStorage',
        ],
        'view' => [
            'class' => 'cms\seo\frontend\components\View',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
