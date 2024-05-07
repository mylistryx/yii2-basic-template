<?php

namespace app\enums;

use app\traits\EnumArraySerializableTrait;

enum IdentityStatusEnum: int
{
    use EnumArraySerializableTrait;

    case Unconfirmed = 0;
    case Active = 1;
}