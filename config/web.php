<?php

use app\models\Identity;
use yii\caching\FileCache;
use yii\debug\Module as DebugModule;
use yii\gii\Module as GiiModule;
use yii\log\FileTarget;
use yii\symfonymailer\Mailer;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id'         => 'basic',
    'basePath'   => dirname(__DIR__),
    'bootstrap'  => ['log'],
    'aliases'    => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request'      => [
            'cookieValidationKey' => 'CHANGE ME',
        ],
        'cache'        => [
            'class' => FileCache::class,
        ],
        'user'         => [
            'identityClass'   => Identity::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer'       => [
            'class'            => Mailer::class,
            'viewPath'         => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db'           => $db,
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
            ],
        ],
    ],
    'params'     => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => GiiModule::class,
    ];
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class'      => DebugModule::class,
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
