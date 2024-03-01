<?php

namespace app\modules\comments\enums;

enum CommentVoteRateEnum: int
{
    case Like = 1;
    case Dislike = -1;
}