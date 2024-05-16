<?php

use app\components\migrations\Migration;
use app\enums\TablesEnum;

class m240516_090830_create_table_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(TablesEnum::View->value, [
            'id' => $this->primaryUuid(),
            'created_at' => $this->dateTime()->notNull(),
            'created_by' => $this->uuid()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(TablesEnum::View->value);
    }
}
