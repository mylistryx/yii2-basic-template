<?php

use app\components\migrations\Migration;
use app\enums\TablesEnum;

class m240516_090705_create_table_country extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(TablesEnum::Country->value, [
            'id' => $this->primaryUuid(),
            'name' => $this->string(64)->notNull(),
            'name_en' => $this->string(64)->notNull(),
            'alpha2' => $this->string(2)->notNull(),
            'alpha3' => $this->string(3)->notNull(),
            'iso' => $this->string(3)->notNull(),
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
        $this->dropTable(TablesEnum::Country->value);
    }
}
