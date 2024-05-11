<?php

namespace app\forms\auth;

use app\components\model\Form;
use Yii;

class LoginForm extends Form
{
    public ?string $email = null;
    public ?string $password = null;
    public bool $rememberMe = true;


    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],
            ['rememberMe', 'boolean'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'rememberMe' => Yii::t('app', 'Remember me'),
        ];
    }
}
