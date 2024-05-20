<?php

namespace app\services;

use app\forms\signup\ConfirmEmailForm;
use app\forms\signup\ResendEmailConfirmationTokenForm;
use app\forms\signup\SignupRequestForm;
use app\models\Identity;
use app\providers\MailerProvider;
use app\providers\SecurityProvider;
use app\providers\UrlManagerProvider;
use app\repositories\IdentityRepository;
use DomainException;
use Yii;
use yii\base\Exception;
use yii\base\Security;
use yii\mail\MailerInterface;
use yii\web\UrlManager;

readonly class SignupService
{
    private Security $security;
    private MailerInterface $mailer;
    private UrlManager $urlManager;

    public function __construct(
        private IdentityRepository $identityRepository,
        SecurityProvider           $securityProvider,
        MailerProvider             $mailerProvider,
        UrlManagerProvider         $urlManagerProvider,
    ) {
        $this->security = $securityProvider->provide();
        $this->mailer = $mailerProvider->provide();
        $this->urlManager = $urlManagerProvider->provide();
    }

    /**
     * @param SignupRequestForm $form
     * @return Identity
     * @throws Exception
     */
    public function requestSignup(SignupRequestForm $form): Identity
    {
        $form->validateOrPanic();
        $identity = new Identity([
            'email' => $form->email,
        ]);
        $identity->generateToken('email_confirmation_token');
        $identity->saveOrPanic();
        $this->sendConfirmationEmailOrPanic($identity);

        return $identity;
    }

    private function sendConfirmationEmailOrPanic(Identity $identity): void
    {
        $mailer = $this->mailer->compose([
            'html' => 'emailVerify-html',
            'text' => 'emailVerify-text',
        ], [
            'verifyLink' => $this->urlManager->createAbsoluteUrl(['signup/confirm', 'token' => $identity->email_confirmation_token]),
        ])
            ->setTo($identity->email)
            ->setFrom([Yii::$app->params['app.senderEmail'] => Yii::$app->name . ' robot'])
            ->setSubject('Signup request at ' . Yii::$app->name);

        if (!$mailer->send()) {
            throw new DomainException('Error sending confirmation email');
        }
    }

    /**
     * @throws Exception
     */
    public function resendConfirmationToken(ResendEmailConfirmationTokenForm $form): Identity
    {
        $form->validateOrPanic();
        $identity = $this->identityRepository->findByEmail($form->email);
        $identity->checkTimeout('identity.emailConfirmationTimeout', $identity->updatedAt);
        $identity->generateToken('email_confirmation_token');
        $identity->saveOrPanic();

        $this->sendConfirmationEmailOrPanic($identity);

        return $identity;
    }

    /**
     * @throws Exception
     */
    public function confirmEmail(ConfirmEmailForm $form): Identity
    {
        $form->validateOrPanic();
        $identity = $this->identityRepository->findByEmailConfirmationToken($form->token, true);
        $identity->resetToken('email_confirmation_token');
        $identity->resetToken('password_reset_token');
        $identity->password_hash = $this->security->generatePasswordHash($form->password);
        $identity->saveOrPanic();


        return $identity;
    }
}