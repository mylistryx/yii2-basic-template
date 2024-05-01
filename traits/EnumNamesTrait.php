<?php

namespace app\traits;

trait EnumNamesTrait
{
    public static function names(): array
    {
        return array_map(fn($enum) => $enum->name, static::cases());
    }
}