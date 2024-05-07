<?php

namespace app\models;

use app\components\behaviors\DateTimeBehavior;
use DateTimeImmutable;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;

/**
 * {@inheritDoc}
 */
class Identity extends BaseIdentity
{
    public const string SCENARIO_REQUEST_SIGNUP = 'request-signup';
    public const string SCENARIO_RESEND_EMAIL_CONFIRMATION_TOKEN = 'resend-email-confirmation-token';
    public const string SCENARIO_CONFIRM_EMAIL = 'confirm-email';
    public const string SCENARIO_REQUEST_PASSWORD_RESET = 'request-password-reset';
    public const string SCENARIO_RESET_PASSWORD = 'reset-password';

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
            'DateTime'  => [
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
            [
                ['email_confirmation_token'],
                'required',
                'on' => [
                    self::SCENARIO_REQUEST_SIGNUP,
                    self::SCENARIO_RESEND_EMAIL_CONFIRMATION_TOKEN,
                ],
            ],
            [
                'email_confirmation_token',
                'compare',
                'value' => null,
                'on'    => [
                    self::SCENARIO_CONFIRM_EMAIL,
                ],
            ],
            [
                'password_reset_token',
                'required',
                'on' => [
                    self::SCENARIO_REQUEST_PASSWORD_RESET,
                ],
            ],
            [
                'password_reset_token',
                'compare',
                'value' => null,
                'on'    => [
                    self::SCENARIO_RESET_PASSWORD,
                ],
            ],
        ];
    }

    public function scenarios(): array
    {
        return array_merge(parent::scenarios(), [
            self::SCENARIO_REQUEST_SIGNUP,
            self::SCENARIO_RESEND_EMAIL_CONFIRMATION_TOKEN,
            self::SCENARIO_CONFIRM_EMAIL,
            self::SCENARIO_REQUEST_PASSWORD_RESET,
            self::SCENARIO_RESET_PASSWORD,
        ]);
    }

    public function attributeLabels(): array
    {
        return [
            'id'         => 'ID',
            'email'      => 'Email',
            'password'   => 'Password',
            'auth_key'   => 'Auth Key',
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
