<?php

namespace app\forms\passwordReset;

use app\components\Model;

class RequestPasswordResetForm extends Model
{
    public ?string $email = null;

    public function rules(): array
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
        ];
    }
}