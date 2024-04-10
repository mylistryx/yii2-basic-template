<?php

namespace app\forms;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public ?string $name = null;
    public ?string $email = null;
    public ?string $subject = null;
    public ?string $body = null;
    public ?string $verifyCode = null;


    public function rules(): array
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],
            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name'       => Yii::t('app', 'Name'),
            'email'      => Yii::t('app', 'Email'),
            'subject'    => Yii::t('app', 'Subject'),
            'body'       => Yii::t('app', 'Body'),
            'verifyCode' => Yii::t('app', 'Verification Code'),
        ];
    }

    public function contact(string $email): bool
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['app.senderEmail'] => Yii::$app->params['app.senderName']])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
