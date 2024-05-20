<?php

namespace app\providers;

use Yii;
use yii\mail\MailerInterface;

class MailerProvider implements ProviderInterface
{
    public function provide(): MailerInterface
    {
        return Yii::$app->mailer;
    }
}