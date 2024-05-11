<?php

namespace app\models;

use app\components\model\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int|string $id
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string $access_token
 * @property string $email_confirmation_token
 * @property string $password_reset_token
 * @property string $created_at
 * @property string $updated_at
 *
 * @property-read string $authKey
 */
abstract class BaseIdentity extends ActiveRecord implements IdentityInterface
{
    public static function findIdentity($id): ?static
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): ?static
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId(): int|string
    {
        return $this->id;
    }

    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }
}