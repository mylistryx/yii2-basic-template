<?php

namespace app\models;

use app\components\behaviors\DateTimeBehavior;
use DateTimeImmutable;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;

/**
 * {@inheritDoc}
 *
 * @property-read DateTimeImmutable $createdAt
 * @property-read DateTimeImmutable $updatedAt
 */
class Identity extends BaseIdentity
{
    public static function tableName(): string
    {
        return 'identity';
    }

    public function behaviors(): array
    {
        return [
            'TimeStamp' => [
                'class' => TimestampBehavior::class,
                'value' => (new DateTimeImmutable())->format('Y-m-d H:i:s'),
            ],
            'DateTime' => [
                'class' => DateTimeBehavior::class,
            ],
        ];
    }

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
            'email' => 'Email',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
}
