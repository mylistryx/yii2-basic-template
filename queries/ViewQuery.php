<?php

namespace app\queries;

use app\models\Identity;
use app\models\View;
use DateTimeImmutable;
use yii\db\ActiveQuery;

/**
 * @see View
 */
class ViewQuery extends ActiveQuery
{
    public function dateFrom(DateTimeImmutable $date, string $format = 'Y-m-d H:i:s'): self
    {
        return $this->andWhere(['>=', 'created_at', $date->format($format)]);
    }

    public function dateTo(DateTimeImmutable $date, string $format = 'Y-m-d H:i:s'): self
    {
        return $this->andWhere(['<=', 'created_at', $date->format($format)]);
    }

    public function between(DateTimeImmutable $start, DateTimeImmutable $end, string $format = 'Y-m-d H:i:s'): self
    {
        return $this->andWhere(['between', 'created_at', $start->format($format), $end->format($format)]);
    }

    public function byIdentity(Identity $identity): self
    {
        return $this->andWhere(['created_by' => $identity->id]);
    }
}