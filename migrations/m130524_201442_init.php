<?php

use app\enums\TablesEnum;
use app\components\migrations\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(TablesEnum::Identity->name, [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string()->notNull()->unique(),
            'access_token' => $this->string()->notNull()->unique(),
            'password_reset_token' => $this->string()->null()->unique(),
            'email_confirmation_token' => $this->string()->null()->unique(),
            'password_hash' => $this->string()->null(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable(TablesEnum::Identity->name);
    }
}
