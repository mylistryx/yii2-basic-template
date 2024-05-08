<?php

namespace app\domain\providers;

use app\components\user\WebUser;
use Yii;

class IdentityProvider implements ProviderInterface
{
    public function provide(): WebUser
    {
        return Yii::$app->user;
    }
}