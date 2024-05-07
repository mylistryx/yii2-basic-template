<?php

namespace app\models;

use app\components\ActiveRecord;
use app\enums\IdentityStatusEnum;
use DateTimeImmutable;
use Yii;
use yii\base\Exception;
use yii\base\InvalidArgumentException;
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
 * @property-read DateTimeImmutable $createdAt
 * @property-read DateTimeImmutable $updatedAt
 * @property-read string $authKey
 *
 * @property-write string $password
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

    /**
     * @throws Exception
     */
    public function setPassword(string $password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
}