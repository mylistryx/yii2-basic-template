<?php

namespace app\exceptions;

use RuntimeException;
use Throwable;
use Yii;

class TimeoutException extends RuntimeException
{
    public function __construct(int $duration, int $code = 0, Throwable $previous = null)
    {
        $message = Yii::t('app', 'Timeout reached. Please retry after {:diff} seconds', [
            ':diff' => $duration,
        ]);
        parent::__construct($message, $code, $previous);
    }
}