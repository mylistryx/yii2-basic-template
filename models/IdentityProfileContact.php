<?php

namespace app\models;

use app\components\model\ActiveRecord;
use app\enums\IdentityProfileContactType;
use DateTimeImmutable;

/**
 * @property int $id
 * @property int $identity_profile_id
 * @property int $type
 * @property string $value
 * @property null|int $code
 * @property string $created_at
 * @property string $updated_at
 *
 * @property-read DateTimeImmutable $createdAt
 * @property-read DateTimeImmutable $updateddAt
 */
class IdentityProfileContact extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'identity_profile_contact';
    }

    public function rules(): array
    {
        return [];
    }

    public function setTypeValue(IdentityProfileContactType $value): void
    {
        $this->type = $value->value;
    }

    public function getTypeValue(): IdentityProfileContactType
    {
        return IdentityProfileContactType::from($this->type);
    }

    public function getTypeName(): string
    {
        return IdentityProfileContactType::getName($this->type);
    }
}