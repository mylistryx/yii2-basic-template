<?php

use app\components\migrations\Migration;
use app\enums\TablesEnum;

class m240516_090710_create_table_region extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(TablesEnum::Region->value, [
            'id' => $this->primaryUuid(),
            'country_id' => $this->uuid()->notNull(),
            'name' => $this->string(64)->notNull(),
            'name_en' => $this->string(64)->notNull(),
            'order' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
    }
}
