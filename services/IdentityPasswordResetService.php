<?php

namespace app\services;

use app\forms\passwordReset\RequestPasswordResetForm;
use app\forms\passwordReset\ResetPasswordForm;
use app\models\Identity;
use app\repositories\IdentityRepository;
use yii\base\Exception;

class IdentityPasswordResetService
{
    public function __construct(private readonly IdentityRepository $identityRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function requestReset(RequestPasswordResetForm $form): bool
    {
        $model = $this->identityRepository->findByEmail($form->email);
        $model->scenario = Identity::SCENARIO_REQUEST_PASSWORD_RESET;
        $model->generateToken('password_reset_token');
        return $model->save();
    }

    public function resetPassword(ResetPasswordForm $form): bool
    {

    }
}
