<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

class HelloController extends Controller
{
    public function actionIndex(string $message = 'Hello world'): int
    {
        $this->stdout($message . "\n");
        return ExitCode::OK;
    }
}
