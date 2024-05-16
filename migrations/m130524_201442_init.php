<?php

use app\enums\TablesEnum;
use app\components\migrations\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(TablesEnum::Identity->name, [
            'id' => $this->uuid()->notNull(),
            'email' => $this->string(32)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull()->unique(),
            'access_token' => $this->string(32)->notNull()->unique(),
            'password_reset_token' => $this->string(32)->null()->unique(),
            'email_confirmation_token' => $this->string(32)->null()->unique(),
            'password_hash' => $this->string(60)->null(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        $this->addPrimaryKey('PK', TablesEnum::Identity->name, 'id');
    }

    public function safeDown(): void
    {
        $this->dropTable(TablesEnum::Identity->name);
    }
}
