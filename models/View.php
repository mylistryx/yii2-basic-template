<?php

namespace app\models;

use app\components\model\CoreActiveRecord;

/**
 * @property string $id [uuid]
 * @property string $created_at [datetime]
 * @property string $created_by [datetime]
 */
class View extends CoreActiveRecord
{
    public static function tableName(): string
    {
        return 'view';
    }

    public function rules(): array
    {
        return [];
    }
}