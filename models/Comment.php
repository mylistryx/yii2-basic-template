<?php

namespace app\models;

use app\components\model\CoreActiveRecord;

/**
 * @property string $id [uuid]
 * @property string $parent_id [uuid]
 * @property string $text [text]
 * @property string $reason [varchar(255)]
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 * @property string $deleted_at [datetime]
 * @property string $created_by [uuid]
 * @property string $updated_by [uuid]
 * @property string $deleted_by [uuid]
 */
class Comment extends CoreActiveRecord
{
    public static function tableName(): string
    {
        return 'comment';
    }

    public function rules(): array
    {
        return [];
    }
}