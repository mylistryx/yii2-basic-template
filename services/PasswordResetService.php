<?php

namespace app\services;

use app\forms\passwordReset\RequestPasswordResetForm;
use app\forms\passwordReset\ResetPasswordForm;
use app\models\Identity;
use app\providers\MailerProvider;
use app\providers\SecurityProvider;
use app\providers\UrlManagerProvider;
use app\repositories\IdentityRepository;
use RuntimeException;
use Yii;
use yii\base\Exception;
use yii\base\Security;
use yii\mail\MailerInterface;
use yii\web\UrlManager;

readonly class PasswordResetService
{
    private MailerInterface $mailer;
    private Security $security;
    private UrlManager $urlManager;

    public function __construct(
        private IdentityRepository $identityRepository,
        SecurityProvider           $securityProvider,
        MailerProvider             $mailerProvider,
        UrlManagerProvider         $urlManagerProvider,
    ) {
        $this->mailer = $mailerProvider->provide();
        $this->security = $securityProvider->provide();
        $this->urlManager = $urlManagerProvider->provide();
    }

    /**
     * @throws Exception
     */
    public function requestReset(RequestPasswordResetForm $form): void
    {
        $form->validateOrPanic();
        $identity = $this->identityRepository->findByEmail($form->email);
        $identity->generateToken('password_reset_token');
        $identity->saveOrPanic();

        $this->sendMail($identity);
    }

    private function sendMail(Identity $identity): void
    {
        $mailer = $this->mailer->compose([
            'html' => 'passwordResetToken-html',
            'text' => 'passwordResetToken-text',
        ], [
            'resetLink' => $this->urlManager->createAbsoluteUrl(['password-reset/reset', 'token' => $identity->password_reset_token]),
        ])
            ->setTo($identity->email)
            ->setFrom([Yii::$app->params['app.senderEmail'] => Yii::$app->name . ' robot'])
            ->setSubject('Password reset on ' . Yii::$app->name);

        if (!$mailer->send()) {
            throw new RuntimeException('Error sending password reset token');
        }
    }

    /**
     * @throws Exception
     */
    public function resetPassword(ResetPasswordForm $form): void
    {
        $form->validateOrPanic();
        $identity = $this->identityRepository->findByPasswordResetToken($form->token);
        $identity->password_hash = $this->security->generatePasswordHash($form->password);
        $identity->resetToken('email_confirmation_token');
        $identity->resetToken('password_reset_token');
        $identity->saveOrPanic();
    }
}