<?php

namespace app\enums;

use app\traits\EnumToArrayTrait;

enum IdentityTokenTypeEnum: int
{
    use EnumToArrayTrait;

    case Confirmation = 10;
    case Recovery = 2;
    case PasswordReset = 20;
    case Access = 100;
}