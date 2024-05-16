<?php

use yii\console\controllers\MigrateController;

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\console',
    'controllerMap' => [
        'migrate' => [
            'class' => MigrateController::class,
            'templateFile' => '@app/components/migrations/views/migration.php',
        ],
    ],
];

return $config;
