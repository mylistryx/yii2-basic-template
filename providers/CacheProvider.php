<?php

namespace app\providers;

use Yii;
use yii\caching\FileCache;

class CacheProvider implements ProviderInterface
{
    public function provide(): FileCache
    {
        return Yii::$app->cache;
    }
}