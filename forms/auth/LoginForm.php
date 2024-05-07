<?php

namespace app\forms\auth;

use app\models\Identity;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read Identity|null $user
 *
 */
class LoginForm extends Model
{
    public ?string $username = null;
    public ?string $password = null;
    public bool $rememberMe = true;

    private null|Identity|false $_user = false;

    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'username'   => Yii::t('app', 'Username'),
            'password'   => Yii::t('app', 'Password'),
            'rememberMe' => Yii::t('app', 'Remember me'),
        ];
    }

    public function validatePassword(string $attribute, ?array $params = null): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? Yii::$app->params['identity.rememberMeDuration'] : 0);
        }
        return false;
    }

    public function getUser(): ?Identity
    {
        if ($this->_user === false) {
            $this->_user = Identity::findByUsername($this->username);
        }

        return $this->_user;
    }
}
