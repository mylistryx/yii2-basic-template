<?php

use app\components\migrations\Migration;
use app\enums\TablesEnum;

class m130524_201442_create_identity_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(TablesEnum::Identity->value, [
            'id' => $this->primaryUuid(),
            'email' => $this->string(32)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull()->unique(),
            'access_token' => $this->string(32)->notNull()->unique(),
            'password_reset_token' => $this->string(32)->null()->unique(),
            'email_confirmation_token' => $this->string(32)->null()->unique(),
            'password_hash' => $this->string(60)->null(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable(TablesEnum::Identity->value);
    }
}
