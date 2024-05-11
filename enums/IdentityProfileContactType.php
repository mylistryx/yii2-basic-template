<?php

namespace app\enums;

use app\traits\EnumJsonSerializableTrait;
use InvalidArgumentException;
use Yii;

enum IdentityProfileContactType: int
{
    use EnumJsonSerializableTrait;

    case Phone = 10;
    case Email = 20;
    case Telegram = 30;
    case VK = 40;

    public static function getName(int $value): string
    {
        return match ($value) {
            self::Phone->value => Yii::t('app', 'Phone'),
            self::Email->value => Yii::t('app', 'Email'),
            self::Telegram->value => Yii::t('app', 'Telegram'),
            self::VK->value => Yii::t('app', 'VK'),
            default => throw new InvalidArgumentException('Unknown value'),
        };
    }
}
