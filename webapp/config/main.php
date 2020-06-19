<?php

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
setlocale(LC_ALL, 'ru_RU.UTF-8');
setlocale(LC_NUMERIC, 'ru_RU.UTF-8');
date_default_timezone_set('Europe/Moscow');

$app = dirname(__DIR__);
$vendorPath = $app . '/vendor';
$result = [
    'yiiPath'  => $vendorPath . '/yiisoft/yii2/Yii.php',
    'yiiDebug' => true,
    'aliases'  => array(
        'vendor'  => $vendorPath,
        'root'    => $app,
        'web'     => $app . '/web',
        'media'   => $app . '/web/media',
        'tests'   => $app . '/tests',
        'console' => $app . '/console',
    ),
    'web'      => array(
        'basePath'       => dirname(__DIR__),
        'name'           => 'my.template.com',
        'id'             => 'my.template.com',
        'language'       => 'ru',
        'sourceLanguage' => 'ru',
        'bootstrap'      => ['log'],
        'timeZone'       => 'Europe/Moscow',
        'defaultRoute'   => 'mainpage/default/index',
        'modules'        => [
            'bets'        => [
                'class' => 'app\modules\bets\Module',
            ],
            'config'      => [
                'class' => 'app\modules\config\Module',
            ],
            'mainpage'    => [
                'class' => 'app\modules\mainpage\Module',
            ],
            'matches'     => [
                'class' => 'app\modules\matches\Module',
            ],
            'sport_types' => [
                'class' => 'app\modules\sport_types\Module',
            ],
            'teams'       => [
                'class' => 'app\modules\teams\Module',
            ],
            'tournaments' => [
                'class' => 'app\modules\tournaments\Module',
            ],
            'users'       => [
                'class' => 'app\modules\users\Module',
            ]
        ],
        'components'     => [
            'request'      => [
                'enableCsrfValidation' => true,
                'cookieValidationKey'  => 'sdfepioDzxqwf3246dfgkljdsa'
            ],
            'cache'        => [
                'class' => 'yii\caching\FileCache'
            ],
            'urlManager'   => [
                'enablePrettyUrl' => true,
                'showScriptName'  => false,
            ],
            'errorHandler' => [
                'errorAction' => 'mainpage/default/error',
            ],
            'mailer'       => [
                'class' => 'yii\swiftmailer\Mailer',
            ],
            'log'          => [
                'traceLevel' => 3,
                'targets'    => [
                    [
                        'class'  => 'yii\log\FileTarget',
                        'levels' => ['error', 'warning'],
                    ],
                ],
            ],
            'formatter'    => [
                'defaultTimeZone' => 'Europe/Moscow',
                'timeZone'        => 'Europe/Moscow',
            ],
            'db'           => [
                'class'   => 'yii\db\Connection',
                'charset' => 'utf8',
            ],
        ],
        'params'         => [
        ],
    ),
    'console'  => [
        'id'                  => 'basic-console',
        'basePath'            => dirname(__DIR__),
        'bootstrap'           => ['log'],
        'controllerNamespace' => 'app\console\controllers',
        'components'          => [
            'log' => [
                'targets' => [
                    [
                        'class'  => 'yii\log\FileTarget',
                        'levels' => ['error', 'warning'],
                    ],
                ],
            ],
        ],
    ],
];
return $result;
