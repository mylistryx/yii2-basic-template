<?php

namespace app\models;

use app\components\model\CoreActiveRecord;

/**
 * @property string $id [uuid]
 * @property string $name [varchar(64)]
 * @property string $name_en [varchar(64)]
 * @property string $alpha2 [varchar(2)]
 * @property string $alpha3 [varchar(3)]
 * @property string $iso [varchar(3)]
 * @property int $order [int]
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 */
class Country extends CoreActiveRecord
{
    public static function tableName(): string
    {
        return 'country';
    }

    public function rules(): array
    {
        return [
            [['name', 'name_en'], 'required'],
            [['name', 'name_en'], 'string', 'length' => [1, 64]],
            [['alpha2'], 'string', 'length' => 2],
            [['alpha3'], 'string', 'length' => 3],
            ['iso', 'integer'],
            ['order', 'default', 'value' => 1000],
        ];
    }
}