<?php

namespace app\forms\auth;

use app\components\model\Form;
use app\repositories\IdentityRepository;
use Yii;

class LoginForm extends Form
{
    public ?string $email = null;
    public ?string $password = null;
    public bool $rememberMe = true;

    public function __construct(
        private readonly IdentityRepository $identityRepository,
        array                               $config = [],
    ) {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],
            ['password', 'validatePassword'],
            ['rememberMe', 'boolean'],
        ];
    }

    public function validatePassword($attribute): void
    {
        if ($this->hasErrors()) {
            return;
        }

        $identity = $this->identityRepository->findByEmail($this->email);
        if (!$identity || !$identity->validatePassword($this->password)) {
            $this->addError($attribute, 'Incorrect email or password.');
        }
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
