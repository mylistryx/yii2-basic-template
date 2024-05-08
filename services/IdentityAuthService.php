<?php

namespace app\services;

use app\components\user\WebUser;
use app\domain\providers\IdentityProvider;
use app\domain\providers\SecurityProvider;
use app\forms\auth\LoginForm;
use app\models\Identity;
use app\repositories\IdentityRepository;
use DomainException;
use Yii;
use yii\base\Security;

readonly class IdentityAuthService
{
    private Security $security;
    private WebUser $webUser;

    public function __construct(
        private IdentityRepository $identityRepository,
        IdentityProvider           $identityProvider,
        SecurityProvider           $securityProvider,
    ) {
        $this->security = $securityProvider->provide();
        $this->webUser = $identityProvider->provide();
    }

    public function login(LoginForm $form): Identity
    {
        $form->validateOrPanic();
        $identity = $this->identityRepository->findByEmail($form->email);

        if (!$identity->isActive()) {
            throw new DomainException('Identity email is not confirmed');
        }

        $this->validatePassword($identity, $form);
        $this->webUser->login($identity, $form->rememberMe ? Yii::$app->params['identity.rememberMeDuration'] : 0);

        if (YII_DEBUG) {
            Yii::info("Identity with id $identity->id logged in");
        }

        return $identity;
    }

    public function logout(bool $destroySession = true): void
    {
        if (YII_DEBUG) {
            $identity = $this->webUser->identity;
            Yii::info("Identity with id $identity->id logged out");
        }

        $this->webUser->logout($destroySession);
    }

    private function validatePassword(Identity $identity, LoginForm $form): void
    {
        if (!$this->security->validatePassword($form->password, $identity->password_hash)) {
            $form->addError('password', 'Incorrect password');
            throw new DomainException('Validation failed');
        }
    }
}