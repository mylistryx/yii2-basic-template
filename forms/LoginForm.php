<?php

namespace app\forms;

use app\models\Identity;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read Identity|null $identity
 */
class LoginForm extends Model
{
    public ?string $username = null;
    public ?string $password = null;
    public bool $rememberMe = true;

    private $_identity = false;

    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword(string $attribute, ?array $params = null): void
    {
        if (!$this->hasErrors()) {
            $identity = $this->getIdentity();

            if (!$identity || !$identity->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getIdentity(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    public function getIdentity(): ?Identity
    {
        if ($this->_identity === false) {
            $this->_identity = Identity::findByUsername($this->username);
        }

        return $this->_identity;
    }
}
