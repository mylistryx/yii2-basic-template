<?php

namespace app\models;

use app\enums\IdentityStatusEnum;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $identity_id
 * @property string $token
 * @property int $type
 * @property int $created_at
 * @property-read Identity $identity
 */
class IdentityToken extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%identity_token}}';
    }

    public function rules(): array
    {
        return [
            [['identity_id', 'token', 'type'], 'required'],
            ['identity_id', 'integer'],
            ['token', 'string'],
            ['token', 'unique'],
            ['type', 'integer'],
            ['type', 'in', 'range' => IdentityStatusEnum::values()],
            ['identity_id', 'exist', 'targetClass' => Identity::class, 'targetAttribute' => 'id'],
        ];
    }

    public function attributeLabels(): array
    {
        return [];
    }

    public function getIdentity(): ActiveQuery
    {
        return $this->hasOne(Identity::class, ['id' => 'identity_id']);
    }
}