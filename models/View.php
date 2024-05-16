<?php

namespace app\models;

use app\components\model\CoreActiveRecord;

class View extends CoreActiveRecord
{
    public static function tableName(): string
    {
        return 'view';
    }
}