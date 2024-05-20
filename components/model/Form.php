<?php

namespace app\components\model;

use app\exceptions\ValidationException;
use yii\base\Model;

abstract class Form extends Model
{
    public function validateOrPanic(): void
    {
        if (!$this->validate()) {
            throw new ValidationException($this);
        }
    }
}