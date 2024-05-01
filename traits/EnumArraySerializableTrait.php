<?php

namespace app\traits;

trait EnumArraySerializableTrait
{
    use EnumNamesTrait;
    use EnumValuesTrait;

    public static function array(): array
    {
        return array_combine(static::names(), static::values());
    }
}