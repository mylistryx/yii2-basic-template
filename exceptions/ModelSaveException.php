<?php

namespace app\exceptions;

use app\components\model\CoreActiveRecord;
use RuntimeException;
use Throwable;

class ModelSaveException extends RuntimeException
{
    public function __construct(CoreActiveRecord $model, $message = "Model save error", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}