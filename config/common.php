<?php

use yii\caching\ArrayCache;
use yii\caching\FileCache;
use yii\db\Connection;
use yii\log\FileTarget;
use yii\symfonymailer\Mailer;
use yii\debug\Module as DebugModule;
use yii\gii\Module as GiiModule;

$config = [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'arrayCache' => [
            'class' => ArrayCache::class,
        ],
        'db' => [
            'class' => Connection::class,
            'dsn' => 'mysql:host=127.0.0.1;dbname=yii2basic',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            'enableSchemaCache' => YII_ENV_DEV === false,
            'schemaCacheDuration' => YII_ENV_DEV ? 60 : 3600 * 24,
            'schemaCache' => 'cache',
        ],
        'cache' => [
            'class' => FileCache::class,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error'],
                    'logFile' => '@runtime/logs/error.log',
                ],
                [
                    'class' => FileTarget::class,
                    'levels' => ['warning'],
                    'logFile' => '@runtime/logs/warning.log',
                ],
                [
                    'class' => FileTarget::class,
                    'levels' => ['info'],
                    'logFile' => '@runtime/logs/info.log',
                ],
            ],
        ],
        'mailer' => [
            'class' => Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => YII_ENV_DEV,
        ],
    ],
    'params' => require __DIR__ . '/params.php',
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => GiiModule::class,
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => DebugModule::class,
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;