<?php

namespace app\forms\signup;

use app\models\Identity;
use Yii;
use yii\base\Model;

class ConfirmEmailForm extends Model
{
    public ?string $password = null;
    public ?string $passwordConfirmation = null;

    public function __construct(public readonly string $token, array $config = [])
    {
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

    public function attributeLabels(): array
    {
        return [
            'password'             => Yii::t('app', 'Password'),
            'passwordConfirmation' => Yii::t('app', 'Confirm password'),
        ];
    }
}