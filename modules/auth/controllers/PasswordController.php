<?php

namespace app\modules\news\controllers;

use app\components\controllers\WebController;
use yii\web\Response;

final class PasswordController extends WebController
{
    public function behaviors(): array
    {
        return [];
    }

    public function actionIndex(): Response
    {
    }
}