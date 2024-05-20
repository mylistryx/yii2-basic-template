<?php

namespace app\exceptions;

use app\components\model\CoreActiveRecord;
use DomainException;
use Throwable;

class EntityNotFoundException extends DomainException
{
    public function __construct(string|CoreActiveRecord $model, string $message = "Entity not found", int $code = 0, Throwable $previous = null)
    {
        if (YII_ENV_DEV) {
            if (is_string($model)) {
                $message .= ' : ' . $model;
            }
        }
        parent::__construct($message, $code, $previous);
    }
}
