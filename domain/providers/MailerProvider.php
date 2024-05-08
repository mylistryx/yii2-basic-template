<?php

namespace app\domain\providers;

use Yii;
use yii\mail\MailerInterface;

class MailerProvider implements ProviderInterface
{
    public function provide(): MailerInterface
    {
        return Yii::$app->mailer;
    }
}