<?php

use yii\caching\ArrayCache;
use yii\caching\FileCache;

return [
    'components' => [
        'arrayCache' => [
            'class' => ArrayCache::class,
        ],
        'cache'        => [
            'class' => FileCache::class,
        ],
    ],
];