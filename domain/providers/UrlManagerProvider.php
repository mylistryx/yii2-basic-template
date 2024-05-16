<?php

namespace app\domain\providers;

use Yii;
use yii\web\UrlManager;

class UrlManagerProvider implements ProviderInterface
{
    public function provide(): UrlManager
    {
        return Yii::$app->urlManager;
    }
}
