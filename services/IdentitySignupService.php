<?php

namespace app\services;

use app\exceptions\ValidationException;
use app\forms\signup\ConfirmEmailForm;
use app\forms\signup\SignupRequestForm;
use app\models\Identity;
use app\providers\MailerProvider;
use app\providers\SecurityProvider;
use app\repositories\IdentityRepository;
use DomainException;
use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\base\Security;
use yii\mail\MailerInterface;

class IdentitySignupService
{
    private Component|Security $security;
    private Component|MailerInterface $mailer;

    public function __construct(
        private readonly IdentityRepository $identityRepository,
        SecurityProvider $securityProvider,
        MailerProvider $mailerProvider,
    ) {
        $this->security = $securityProvider->provide();
        $this->mailer = $mailerProvider->provide();
    }

    /**
     * @param SignupRequestForm $form
     * @return Identity
     * @throws Exception
     */
    public function requestSignup(SignupRequestForm $form): Identity
    {
        $model = new Identity([
            'email' => $form->email,
        ]);
        $model->scenario = Identity::SCENARIO_REQUEST_SIGNUP;
        $model->generateToken('email_confirmation_token');

        if (!$model->save()) {
            throw new ValidationException('Error create identity');
        }

        $success = $this->mailer->compose([
            'html' => 'signup-html',
            'text' => 'signup-text',
        ], [
            'identity' => $model,
        ])
            ->setTo($model->email)
            ->setFrom(Yii::$app->params['supportEmail'])
            ->setSubject('Signup request as ' . Yii::$app->name)
            ->send();

        if (!$success) {
            throw new DomainException('Error sending confirmation email');
        }

        return $model;
    }

    /**
     * @param SignupRequestForm $form
     * @return Identity
     * @throws Exception
     */
    public function resendConfirmationToken(SignupRequestForm $form): Identity
    {
        $model = $this->identityRepository->findByEmail($form->email);
        $model->scenario = Identity::SCENARIO_RESEND_EMAIL_CONFIRMATION_TOKEN;
        $model->generateToken('email_confirmation_token');

        $diff = Yii::$app->params['identity.emailConfirmationTimeout'] - $model->updatedAt->diff(new \DateTimeImmutable())->s;
        if ($diff > 0) {
            throw new DomainException("Please retry after {$diff} seconds");
        }

        if (!$model->save()) {
            throw new DomainException('Error create identity');
        }

        $success = $this->mailer->compose([
            'html' => 'signup-html',
            'text' => 'signup-text',
        ], [
            'identity' => $model,
        ])
            ->setTo($model->email)
            ->setFrom(Yii::$app->params['supportEmail'])
            ->setSubject('Signup request as ' . Yii::$app->name)
            ->send();

        if (!$success) {
            throw new DomainException('Error sending confirmation email');
        }

        return $model;
    }

    public function confirmEmail(ConfirmEmailForm $form): Identity
    {
        $identity = $this->identityRepository->findByEmailConfirmationToken($form->token);
        $identity->scenario = Identity::SCENARIO_CONFIRM_EMAIL;
        $identity->resetToken('email_confirmation_token');
        $identity->password = $form->password;
        if (!$identity->save()) {
            throw new DomainException('Error save new password');
        }

        return $identity;
    }


}