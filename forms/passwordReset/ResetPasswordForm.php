<?php

namespace app\forms\passwordReset;

use app\components\model\Form;
use Yii;

class ResetPasswordForm extends Form
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