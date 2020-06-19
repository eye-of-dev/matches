<?php

$result = [
    'web' => array(
        'modules' => array(),
        'components' => [
            'errorHandler' => [
                'errorAction' => 'mainpage/default/error',
            ],
            'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'suffix' => '',
                'rules' => [
                    '/' => 'mainpage/default/index',
                    '<module>/<action>' => '<module>/default/<action>',
                    '<module>/<controller>/<action>' => '<module>/<controller>/<action>',
                ]
            ],
            'user' => [
                'loginUrl' => ['/users/default/login'],
                'identityClass' => 'app\modules\users\models\UserIdentity',
                'enableSession' => false,
                'identityCookie' => [
                    'name' => 'my_template_site_identity',
                    'httpOnly' => true,
                    'domain' => 'my.template.com',
                ],
            ],
        ],
        'params' => [
            'yiiEnd' => 'front',
            'host' => 'my.template.com'
        ],
    ),
];
return $result;
