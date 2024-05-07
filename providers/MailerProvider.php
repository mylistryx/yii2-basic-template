<?php

namespace app\providers;

use Yii;
use yii\base\Component;

class MailerProvider implements ProviderInterface
{
    public function provide(): Component
    {
        return Yii::$app->mailer;
    }
}