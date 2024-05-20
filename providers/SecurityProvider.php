<?php

namespace app\providers;

use Yii;
use yii\base\Security;

class SecurityProvider implements ProviderInterface
{
    public function provide(): Security
    {
        return Yii::$app->security;
    }
}