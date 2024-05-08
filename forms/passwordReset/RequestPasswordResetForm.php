<?php

namespace app\forms\passwordReset;

use app\components\Model;
use app\models\Identity;

class RequestPasswordResetForm extends Model
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