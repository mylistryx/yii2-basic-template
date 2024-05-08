<?php

namespace app\components\helpers;

use DateInterval;

class DateTimeHelper
{
    public static function asSeconds(DateInterval $interval): int
    {
        return $interval->days * 24 * 60 * 60 + $interval->h * 60 * 60 + $interval->m * 60 + $interval->s;
    }

    public static function asMinutes(DateInterval $interval): int
    {
        return $interval->days * 24 * 60 + $interval->h * 60 + $interval->m;
    }

    public static function asHours(DateInterval $interval): int
    {
        return $interval->days * 24 + $interval->h;
    }

    public static function asDays(DateInterval $interval): int
    {
        return $interval->days;
    }
}