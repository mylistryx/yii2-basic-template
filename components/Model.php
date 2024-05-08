<?php

namespace app\components;

use app\exceptions\ValidationException;

class Model extends \yii\base\Model
{
    public function validateOrPanic(): void
    {
        if (!$this->validate()) {
            throw new ValidationException($this);
        }
    }
}