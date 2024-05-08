<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/vendor/yiisoft/yii2/Yii.php';

$config = array_merge_recursive(
    require dirname(__DIR__) . '/config/common.php',
    require dirname(__DIR__) . '/config/web.php',
);

(new yii\web\Application($config))->run();
