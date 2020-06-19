<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require_once(dirname(__FILE__) . '/../components/la/LAEnvironment.php');

putenv('YII_ENV=' . trim(file_get_contents(dirname(__FILE__) . '/../config/mode.php')));
putenv('YII_END=front');

$env = new \app\components\LAEnvironment([
    dirname(__DIR__) . '/config'
        ]);
$env->setup();
$application = new yii\web\Application($env->web);
$application->run();
