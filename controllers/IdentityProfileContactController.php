<?php

namespace app\controllers;

use app\components\controllers\WebController;
use yii\web\Response;

final class IdentityProfileContactController extends WebController
{
    public function actionCreate(): Response
    {
        return $this->render('create', [
            'model',
        ]);
    }

    public function actionUpdate(): Response
    {
        return $this->render('update', [
            'model',
        ]);
    }

    public function actionDelete(): Response
    {
    }
}