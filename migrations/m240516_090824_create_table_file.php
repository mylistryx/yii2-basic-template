<?php

use app\components\migrations\Migration;
use app\enums\TablesEnum;

class m240516_090824_create_table_file extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(TablesEnum::File->value, [
            'id' => $this->primaryUuid(),
            'name' => $this->string()->notNull(),
            'size' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'created_by' => $this->uuid()->notNull(),
            'updated_by' => $this->uuid()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(TablesEnum::File->value);
    }
}
