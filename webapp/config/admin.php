<?php

$result = [
    'web' => [
        'basePath' => dirname(__DIR__),
        'name' => 'my-template.dev',
        'language' => 'ru',
        'defaultRoute' => 'mainpage/default/index',
        'components' => [
            'assetManager' => [
                'bundles' => [
                    'dmstr\web\AdminLteAsset' => [
                        'skin' => 'skin-black',
                    ],
                ],
            ],
            'session' => [
                'timeout' => 86400 * 30
            ],
            'view' => [
                'theme' => [
                    'pathMap' => [
                        '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                    ],
                ],
            ],
            'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => true,
                'rules' => [
                    '<module>/<action>' => '<module>/default/<action>',
                    '<module>/<controller>/<action>' => '<module>/<controller>/<action>',
                ]
            ],
            'user' => [
                'identityClass' => 'app\modules\users\models\UserIdentity',
                'enableAutoLogin' => true,
                'loginUrl' => ['/users/default/login'],
                'authTimeout' => 86400 * 30,
                'absoluteAuthTimeout' => 86400 * 30,
                'identityCookie' => [
                    'name' => 'my_template_admin_identity',
                    'httpOnly' => true,
                    'domain' => 'my.template.com',
                ],
            ],
        ],
        'params' => [
            'yiiEnd' => 'admin'
        ],
    ],
];
return $result;
