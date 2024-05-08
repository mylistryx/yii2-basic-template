<?php

namespace app\domain\exceptions;

use app\components\ActiveRecord;
use RuntimeException;
use Throwable;

class ModelSaveException extends RuntimeException
{
    public function __construct(ActiveRecord $model, $message = "Model save error", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}