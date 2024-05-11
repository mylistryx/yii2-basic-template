<?php

use yii\console\controllers\MigrateController;
use yii\faker\FixtureController;

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\console',
    'controllerMap' => [
        'fixture' => [
            'class' => FixtureController::class,
        ],
        'migrate' => [
            'class' => MigrateController::class,
            'templateFile' => '@app/components/migrations/views/migration.php',
        ],
    ],
];

return $config;
