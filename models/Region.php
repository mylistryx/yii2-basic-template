<?php

namespace app\models;

use app\components\model\CoreActiveRecord;

/**
 * @property string $id [uuid]
 * @property string $country_id [uuid]
 * @property string $name [varchar(64)]
 * @property string $name_en [varchar(64))
 * @property int $order [int]
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 */
class Region extends CoreActiveRecord
{
    public static function tableName(): string
    {
        return 'region';
    }

    public function rules(): array
    {
        return [];
    }
}