<?php

namespace app\components\migrations;

class Migration extends \yii\db\Migration
{
    public function generateFkName(
        string       $table,
        string       $refTable,
        array|string $column,
    ): string {
        $column = is_array($column) ? $column[0] : $column;

        return "FK_{$table}_{$column}__{$refTable}";
    }
}