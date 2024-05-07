<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    private string $tableName = 'identity';

    public function safeUp(): void
    {
        $this->createTable($this->tableName, [
            'id'                       => $this->primaryKey(),
            'email'                    => $this->string()->notNull()->unique(),
            'auth_key'                 => $this->string(32)->unique()->notNull(),
            'password_hash'            => $this->string()->defaultValue(null),
            'password_reset_token'     => $this->string()->unique()->defaultValue(null),
            'email_verification_token' => $this->string()->unique()->defaultValue(null),
            'access_token'             => $this->string()->unique()->notNull(),
            'created_at'               => $this->dateTime()->notNull(),
            'updated_at'               => $this->dateTime()->notNull(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable($this->tableName);
    }
}
