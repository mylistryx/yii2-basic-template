<?php

namespace app\modules\comments\enums;

enum CommentStatusEnum: int
{
    case Pending = 0;
    case Approved = 1;
    case Rejected = -1;
}