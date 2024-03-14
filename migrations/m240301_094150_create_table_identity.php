<?php

use yii\db\Migration;

/**
 * Class m240301_094150_create_table_identity
 */
class m240301_094150_create_table_identity extends Migration
{
    public string $tableName = '{{%identity}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id'            => $this->primaryKey(),
            'email'         => $this->integer()->notNull()->unique(),
            'username'      => $this->string()->notNull()->unique(),
            'auth_key'      => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'status'        => $this->integer()->notNull()->defaultValue(0),
            'created_at'    => $this->dateTime()->notNull(),
            'updated_at'    => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
