<?php

return [
    'yiiDebug' => true,
    'yiiEnv'   => 'test',
    'web'      => [
        'bootstrap'  => ['debug'],
        'components' => [
            'db' => [
                'dsn'               => 'mysql:host=localhost;dbname=matches',
                'username'          => 'root',
                'password'          => 'WoD3joo7',
                'charset'           => 'utf8',
                'enableSchemaCache' => false,
            ],
        ],
        'modules'    => [
            'gii'   => ['class' => \yii\gii\Module::class],
            'debug' => ['class' => \yii\debug\Module::class]
        ],
    ],
    'console'  => [
        'components' => [
            'db' => [
                'class'             => '\yii\db\Connection',
                'dsn'               => 'mysql:host=localhost;dbname=matches',
                'username'          => 'root',
                'password'          => 'WoD3joo7',
                'charset'           => 'utf8',
                'enableSchemaCache' => false,
            ],
        ],
    ]
];
