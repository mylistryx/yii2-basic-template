<?php

namespace app\forms\signup;

use app\components\Model;
use app\models\Identity;

class ResendEmailConfirmationTokenForm extends Model
{
    public ?string $email = null;

    public function rules(): array
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            [['email'], 'exist', 'targetClass' => Identity::class, 'skipOnError' => true],
        ];
    }
}