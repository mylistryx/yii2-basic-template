<?php

namespace app\components\migrations;

use yii\db\ColumnSchemaBuilder;

class Migration extends \yii\db\Migration
{
    public function generateFkName(
        string $table,
        string $column,
        string $refTable,
        string $refColumn,
    ): string {
        return implode('_', [
            implode('_', ['FK_', $table, $column]),
            implode('_', [$refTable, $refColumn]),
        ]);
    }

    public function primaryUuid(): string
    {
        return implode(' ', [
            (string)$this->uuid(),
            'PRIMARY KEY',
        ]);
    }

    public function uuid(): ColumnSchemaBuilder
    {
        return $this->string(36);
    }

    public function test()
    {
//        $this->bigPrimaryKey()
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('VARCHAR(36) NOT NULL PRIMARY KEY', 36);
    }
}