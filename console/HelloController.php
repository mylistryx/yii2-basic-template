<?php

namespace app\console;

use yii\console\Controller;
use yii\console\ExitCode;

class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex(string $message = 'hello world'): int
    {
        echo $message . PHP_EOL;

        return ExitCode::OK;
    }
}
