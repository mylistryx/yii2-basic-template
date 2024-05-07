<?php

namespace app\providers;

use Yii;
use yii\base\Component;

class SecurityProvider implements ProviderInterface
{
    public function provide(): Component
    {
        return Yii::$app->security;
    }
}