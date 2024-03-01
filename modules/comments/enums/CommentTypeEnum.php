<?php

namespace app\modules\comments\enums;

enum CommentTypeEnum: int
{
    case User = 1;
    case News = 2;
    case Blog = 3;
}