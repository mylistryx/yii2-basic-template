<?php

namespace app\providers;

use Yii;
use yii\caching\ArrayCache;

class ArrayCacheProvider implements ProviderInterface
{
    public function provide(): ArrayCache
    {
        return Yii::$app->arrayCache;
    }
}