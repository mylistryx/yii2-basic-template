<?php

namespace app\domain\exceptions;

use app\components\ActiveRecord;
use app\components\Model;
use DomainException;
use Throwable;
use Yii;

class ValidationException extends DomainException
{
    public function __construct(Model|ActiveRecord $model, string $message = "Validation failed", int $code = 0, Throwable $previous = null)
    {
        $message = Yii::t('app', $message);
        parent::__construct($message, $code, $previous);
    }
}
