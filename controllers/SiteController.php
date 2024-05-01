<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\forms\ContactForm;
use Yii;
use yii\captcha\CaptchaAction;
use yii\web\ErrorAction;
use yii\web\Response;

final class SiteController extends WebController
{
    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error'   => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class'           => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex(): Response
    {
        return $this->render('index');
    }

    public function actionContact(): Response
    {
        $model = new ContactForm();
        if ($model->load($this->post()) && $model->contact(Yii::$app->params['app.adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout(): Response
    {
        return $this->render('about');
    }
}
