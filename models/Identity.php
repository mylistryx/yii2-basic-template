<?php

namespace app\models;

use app\components\model\CoreActiveRecord;
use app\queries\IdentityQuery;
use DateTimeImmutable;
use Yii;
use yii\base\Exception;
use yii\web\IdentityInterface;

/**
 * {@inheritDoc}
 * @property string $id [uuid]
 * @property string $email [varchar(32))
 * @property string $auth_key [varchar(32)]
 * @property string $access_token [varchar(32)]
 * @property string $email_confirmation_token [varchar(32)]
 * @property string $password_reset_token [varchar(32)]
 * @property string $password_hash [varchar(60)]
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 *
 * @property-read DateTimeImmutable $updatedAt
 * @property-read DateTimeImmutable $createdAt
 * @property-read string $authKey
 *
 * @property-write string $password
 */
class Identity extends CoreActiveRecord implements IdentityInterface
{
    /**
     * @throws Exception
     */
    public function rules(): array
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            ['auth_key', 'default', 'value' => Yii::$app->security->generateRandomString()],
            ['access_token', 'default', 'value' => Yii::$app->security->generateRandomString()],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'uuid' => 'Uuid',
            'email' => 'Email',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function tableName(): string
    {
        return 'identity';
    }

    public static function findIdentity($id): ?static
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): ?static
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUuid($uuid): ?static
    {
        return static::findOne(['uuid' => $uuid]);
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
    public function generateToken(string $attribute): void
    {
        $this->$attribute = Yii::$app->security->generateRandomString();
    }

    public function resetToken(string $attribute): void
    {
        $this->$attribute = null;
    }

    public function isActive(): bool
    {
        return $this->email_confirmation_token === null;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->stringToDateTime($this->created_at);
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->stringToDateTime($this->updated_at);
    }

    /**
     * @throws Exception
     */
    public function setPassword(string $password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public static function find(): IdentityQuery
    {
        return new IdentityQuery(get_called_class());
    }
}
