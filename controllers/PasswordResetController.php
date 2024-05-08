<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\domain\services\identity\PasswordResetService;
use app\forms\passwordReset\RequestPasswordResetForm;
use app\forms\passwordReset\ResetPasswordForm;
use Throwable;
use yii\web\Response;

final class  PasswordResetController extends WebController
{
    public function __construct(
        $id,
        $module,
        private readonly PasswordResetService $passwordResetService,
        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionRequest(): Response
    {
        $model = new RequestPasswordResetForm();

        if ($model->load($this->post())) {
            try {
                $this->passwordResetService->requestReset($model);
                return $this->success('Follow email instructions to reset your password.')->goHome();
            } catch (Throwable $exception) {
                $this->error($exception->getMessage());
            }
        }

        return $this->render('request', [
            'model' => $model,
        ]);
    }

    public function actionReset(string $token): Response
    {
        $model = new ResetPasswordForm($token);

        if ($model->load($this->post())) {
            try {
                $this->passwordResetService->resetPassword($model);
                return $this->success('Your password has been reset.')->goHome();
            } catch (Throwable $exception) {
                $this->error($exception->getMessage());
            }
        }

        return $this->render('reset', [
            'model' => $model,
        ]);
    }
}