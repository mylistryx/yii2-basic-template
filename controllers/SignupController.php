<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\forms\signup\ConfirmEmailForm;
use app\forms\signup\ResendEmailConfirmationTokenForm;
use app\forms\signup\SignupRequestForm;
use app\services\IdentitySignupService;
use Throwable;
use Yii;
use yii\web\Response;

final class SignupController extends WebController
{
    public function __construct(
        $id,
        $module,
        private readonly IdentitySignupService $signupService,
        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionRequest(): Response
    {
        $model = new SignupRequestForm();

        if ($model->load($this->post())) {
            try {
                $this->signupService->requestSignup($model);
                return $this->info('Follow email instructions')->goHome();
            } catch (Throwable $exception) {
                $this->error($exception->getMessage());
            }
        }

        return $this->render('request', [
            'model' => $model,
        ]);
    }

    public function actionResend(): Response
    {
        $model = new ResendEmailConfirmationTokenForm();

        if ($model->load($this->post())) {
            try {
                $this->signupService->resendConfirmationToken($model);
                return $this->info('Follow email instructions')->goHome();
            } catch (Throwable $exception) {
                $this->error($exception->getMessage());
            }
        }

        return $this->render('resend', [
            'model' => $model,
        ]);
    }

    public function actionConfirm(string $token): Response
    {
        $model = new ConfirmEmailForm($token);

        if ($model->load($this->post())) {
            try {
                $this->signupService->confirmEmail($model);
                return $this->goHome();
            } catch (Throwable $exception) {
                $this->error($exception->getMessage());
            }
        }
        return $this->render('confirm', [
            'model' => $model,
        ]);
    }
}
