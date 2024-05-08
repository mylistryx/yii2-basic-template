<?php

namespace app\components\behaviors;

use DateTimeImmutable;
use yii\base\Behavior;

/**
 * @property-read DateTimeImmutable $createdAt
 * @property-read DateTimeImmutable $updatedAt
 */
class DateTimeBehavior extends Behavior
{
    public string $format = 'Y-m-d H:i:s';
    public array $attributes = [
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ];

    public function getCreatedAt(): DateTimeImmutable
    {
        $value = $this->owner->created_at;
        return DateTimeImmutable::createFromFormat($this->format, $value);
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        $value = $this->owner->updated_at;
        return DateTimeImmutable::createFromFormat($this->format, $value);
    }
}