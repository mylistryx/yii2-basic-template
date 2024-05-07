<?php

namespace app\forms\passwordReset;

use app\models\Identity;
use yii\base\Model;

class RequestPasswordResetForm extends Model
{
    public ?string $email = null;

    public function rules(): array
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            [['email'], 'exist', 'targetClass' => Identity::class, 'targetAttribute' => ['email'], 'skipOnError' => true],
        ];
    }
}