<?php

namespace app\models;

use app\components\model\ActiveRecord;
use DateTimeImmutable;

/**
 * @property int $id
 * @property int $identity_id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $birthday
 * @property string $created_at
 * @property string $updated_at
 *
 * @property-read string $fullName
 * @property-read DateTimeImmutable $birthdayDate
 * @property-read DateTimeImmutable $createdAt
 * @property-read DateTimeImmutable $updatedAt
 * @property-read Identity $identity
 */
class IdentityProfile extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'identity_profile';
    }
}