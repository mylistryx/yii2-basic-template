<?php

namespace app\forms\signup;

use app\components\model\Form;
use app\models\Identity;
use Yii;

class SignupRequestForm extends Form
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
