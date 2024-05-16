<?php

namespace app\models;

use app\components\model\CoreActiveRecord;

/**
 *
 */
class Comment extends CoreActiveRecord
{
    public static function tableName(): string
    {
        return 'comment';
    }
}