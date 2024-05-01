<?php

use yii\db\Migration;

/**
 * Class m240501_183116_init
 */
class m240501_183116_init extends Migration
{
    private string $tableName = '{{%identity}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id'                   => $this->primaryKey(),
            'username'             => $this->string()->notNull()->unique(),
            'email'                => $this->string()->notNull()->unique(),
            'auth_key'             => $this->string(32)->notNull(),
            'password_hash'        => $this->string()->notNull(),
            'password_reset_token' => $this->string()->null()->unique(),
            'access_token'         => $this->string()->notNull()->unique(),
            'status'               => $this->integer()->notNull()->defaultValue(0),
            'created_at'           => $this->dateTime()->notNull(),
            'updated_at'           => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable($this->tableName);
    }
}
