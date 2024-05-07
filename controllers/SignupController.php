<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\exceptions\ValidationException;
use app\forms\signup\SignupRequestForm;
use app\services\IdentitySignupService;
use Throwable;
use Yii;
use yii\web\Response;

final class SignupController extends WebController
{
    public function __construct($id, $module, private readonly IdentitySignupService $identityService, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actionRequest(): Response
    {
        $model = new SignupRequestForm([
            'scenario' => SignupRequestForm::SCENARIO_REQUEST_SIGNUP,
        ]);

        if ($model->load(Yii::$app->request->post())) {
            try {
                if (!$model->validate()) {
                    throw new ValidationException();
                }

                $this->identityService->requestSignup($model);

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
        $model = new SignupRequestForm([
            'scenario' => SignupRequestForm::SCENARIO_RESEND_EMAIL_CONFIRMATION_TOKEN,
        ]);

        if ($model->load(Yii::$app->request->post())) {
            try {
                if (!$model->validate()) {
                    throw new ValidationException();
                }

                $this->identityService->resendConfirmationToken($model);

                return $this->info('Follow email instructions')->goHome();
            } catch (Throwable $exception) {
                $this->error($exception->getMessage());
            }
        }

        return $this->render('resend', [
            'model' => $model,
        ]);
    }
}
