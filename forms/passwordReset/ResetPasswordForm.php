<?php

namespace app\forms\passwordReset;

use Yii;
use app\components\Model;

class ResetPasswordForm extends Model
{
    public ?string $password = null;
    public ?string $passwordConfirmation = null;

    public function __construct(
        public readonly string $token,
                               $config = [],
    ) {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['password', 'passwordConfirmation'], 'required'],
            [
                ['password', 'passwordConfirmation'],
                'string',
                'length' => [
                    Yii::$app->params['identity.minPasswordLength'],
                    Yii::$app->params['identity.maxPasswordLength'],
                ],
            ],
            ['passwordConfirmation', 'compare', 'compareAttribute' => 'password'],
        ];
    }
}