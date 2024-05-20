<?php

namespace app\exceptions;

use app\components\model\CoreActiveRecord;
use app\components\model\Form;
use DomainException;
use Throwable;
use Yii;

class ValidationException extends DomainException
{
    public function __construct(Form|CoreActiveRecord $model, string $message = "Validation failed", int $code = 0, Throwable $previous = null)
    {
        $message = Yii::t('app', $message);
        parent::__construct($message, $code, $previous);
    }
}
