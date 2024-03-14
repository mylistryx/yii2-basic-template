<?php

namespace app\enums;

use app\traits\EnumToArrayTrait;

enum IdentityStatusEnum: int
{
    use EnumToArrayTrait;

    case Inactive = 0;
    case Active = 1;
    case Banned = -1;


}