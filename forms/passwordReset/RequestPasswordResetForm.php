<?php

namespace app\forms\passwordReset;

use app\components\model\Form;
use app\models\Identity;

class RequestPasswordResetForm extends Form
{
    public ?string $email = null;

    public function rules(): array
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            [['email'], 'exist', 'targetClass' => Identity::class, 'targetAttribute' => ['email' => 'email']],
        ];
    }
}