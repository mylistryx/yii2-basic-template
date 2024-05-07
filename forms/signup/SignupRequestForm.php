<?php

namespace app\forms\signup;

use app\models\Identity;
use Yii;
use yii\base\Model;

class SignupRequestForm extends Model
{
    public const string SCENARIO_REQUEST_SIGNUP = 'request-signup';
    public const string SCENARIO_RESEND_EMAIL_CONFIRMATION_TOKEN = 'resend-email-confirmation-token';

    public ?string $email = null;

    public function scenarios(): array
    {
        return array_merge(parent::scenarios(), [
            self::SCENARIO_REQUEST_SIGNUP,
            self::SCENARIO_RESEND_EMAIL_CONFIRMATION_TOKEN,
        ]);
    }

    public function rules(): array
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            [
                ['email'],
                'unique',
                'targetClass'     => Identity::class,
                'targetAttribute' => 'email',
                'skipOnError'     => true,
                'on'              => [self::SCENARIO_REQUEST_SIGNUP],
            ],
            [
                ['email'],
                'unique',
                'targetClass'     => Identity::class,
                'targetAttribute' => 'exists',
                'skipOnError'     => true,
                'on'              => [self::SCENARIO_RESEND_EMAIL_CONFIRMATION_TOKEN],
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'email' => Yii::t('app', 'Email'),
        ];
    }
}
