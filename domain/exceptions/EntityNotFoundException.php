<?php

namespace app\domain\exceptions;

use app\components\ActiveRecord;
use DomainException;
use Throwable;

class EntityNotFoundException extends DomainException
{
    public function __construct(string|ActiveRecord $model, string $message = "Entity not found", int $code = 0, Throwable $previous = null)
    {
        if (YII_DEBUG) {
            if (is_string($model)) {
                $message .= ' : ' . $model;
            }
        }
        parent::__construct($message, $code, $previous);
    }
}
