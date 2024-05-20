<?php

namespace app\providers;

use Yii;
use yii\db\Connection;

class DbProvider implements ProviderInterface
{
    public function provide(): Connection
    {
        return Yii::$app->db;
    }
}