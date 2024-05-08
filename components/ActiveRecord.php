<?php

namespace app\components;

use app\domain\exceptions\ModelSaveException;
use app\domain\exceptions\TimeoutException;
use app\domain\exceptions\ValidationException;
use DateTimeImmutable;
use Yii;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public function saveOrPanic($runValidation = true, $attributeNames = null): static
    {
        if (!parent::save($runValidation, $attributeNames)) {
            if (!$this->hasErrors()) {
                throw new ValidationException($this);
            }

            throw new ModelSaveException($this);
        }

        return $this;
    }

    public function checkTimeout(string $paramValue, DateTimeImmutable $attributeValue): static
    {
        $timeout = Yii::$app->params[$paramValue];

        $now = strtotime('now');
        $lastUpdate = strtotime($attributeValue->format('Y-m-d H:i:s'));
        $diff = $now - $lastUpdate;

        if ($diff < $timeout) {
            throw new TimeoutException($timeout - $diff);
        }

        return $this;
    }
}