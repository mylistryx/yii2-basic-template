<?php

namespace app\models;

use app\components\model\CoreActiveRecord;

/**
 * @property string $id [uuid]
 * @property string $name [varchar(255)]
 * @property int $size [int]
 * @property string $type [varchar(255)]
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 * @property string $created_by [uuid]
 * @property string $updated_by [uuid]
 */
class File extends CoreActiveRecord
{
    public static function tableName(): string
    {
        return 'file';
    }

    public function rules(): array
    {
        return [];
    }

    public function attributeLabels(): array
    {
        return [];
    }
}