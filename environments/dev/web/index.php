<?php

use yii\web\Application;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/vendor/yiisoft/yii2/Yii.php';
require dirname(__DIR__) . '/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require dirname(__DIR__) . '/config/main.php',
    require dirname(__DIR__) . '/config/main-local.php',
    require dirname(__DIR__) . '/config/web.php',
    require dirname(__DIR__) . '/config/web-local.php'
);

(new Application($config))->run();
