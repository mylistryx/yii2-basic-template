<?php

namespace app\queries;

use yii\db\ActiveQuery;

/**
 * @see Identity
 */
class IdentityQuery extends ActiveQuery
{
    public function active(): static
    {
        return $this->andWhere(['email_confirmation_token' => null]);
    }

    public function unconfirmed(): static
    {
        return $this->andWhere(['!=', 'email_confirmation_token', null]);
    }
}