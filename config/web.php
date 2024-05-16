<?php

use app\components\user\WebUser;
use app\models\Identity;

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'assetManager' => [
            'basePath' => dirname(__DIR__) . '/web/assets',
            'appendTimestamp' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'JbVbnHfCmDfMnL12l7jh9vSl6lwOwTt-',
        ],
        'user' => [
            'class' => WebUser::class,
            'identityClass' => Identity::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '' => 'site/index',
                'about' => 'site/about',
                'contact' => 'site/contact',

                'login' => 'auth/index',
                'logout' => 'auth/logout',

                'request-signup' => 'signup/request',
                'resend-confirmation_token' => 'signup/resend',
                'confirm-email' => 'signup/confirm',

                'request-password-reset' => 'password-reset/request',
                'reset-password' => 'password-reset/reset',
            ],
        ],
    ],
];


return $config;
