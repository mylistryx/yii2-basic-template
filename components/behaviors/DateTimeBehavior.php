<?php

namespace app\components\behaviors;

use DateTimeImmutable;
use yii\base\Behavior;

class DateTimeBehavior extends Behavior
{
    public string $format = 'Y-m-d H:i:s';
    public array $attributes = [
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ];

    public function __get($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            $value = $this->owner->{$this->attributes[$name]};
            return (new DateTimeImmutable())->createFromFormat($this->format, $value);
        }
        parent::__get($name);
    }
}