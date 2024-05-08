<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    private string $tableName = 'identity';

    public function safeUp(): void
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'email' => $this->string(32)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull()->unique(),
            'access_token' => $this->string(32)->notNull()->unique(),
            'password_reset_token' => $this->string(32)->null()->unique()->defaultValue(null),
            'email_confirmation_token' => $this->string(32)->null()->unique()->defaultValue(null),
            'password_hash' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable($this->tableName);
    }
}
