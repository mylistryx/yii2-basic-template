<?php

namespace app\forms\signup;

use app\models\Identity;
use Yii;
use app\components\Model;

class SignupRequestForm extends Model
{
    public ?string $email = null;


    public function rules(): array
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => Identity::class, 'targetAttribute' => 'email'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'email' => Yii::t('app', 'Email'),
        ];
    }
}
