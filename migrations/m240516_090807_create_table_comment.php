<?php

use app\components\migrations\Migration;
use app\enums\TablesEnum;

class m240516_090807_create_table_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(TablesEnum::Comment->value, [
            'id' => $this->primaryUuid(),
            'parent_id' => $this->uuid()->null(),
            'text' => $this->text()->notNull(),
            'reason' => $this->string()->null(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'created_by' => $this->uuid()->notNull(),
            'updated_by' => $this->uuid()->notNull(),
            'deleted_at' => $this->datetime()->null(),
            'deleted_by' => $this->uuid()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
    }
}
