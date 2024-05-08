<?php

namespace app\domain\providers;

use Yii;
use yii\caching\FileCache;

class CacheProvider implements ProviderInterface
{
    public function provide(): FileCache
    {
        return Yii::$app->cache;
    }
}