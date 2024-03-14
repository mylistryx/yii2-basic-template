<?php

use yii\db\Migration;

/**
 * Class m240301_094151_create_table_identity_token
 */
class m240301_094151_create_table_identity_token extends Migration
{
    public string $tableName = '{{%identity_token}}';
    public string $tableIdentity = '{{%identity}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id'          => $this->primaryKey(),
            'identity_id' => $this->integer()->notNull(),
            'token'       => $this->string()->unique(),
            'type'        => $this->integer()->notNull(),
            'created_at'  => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey(
            'FK_IdentityToken_IdentityId__Identity_Id',
            $this->tableName,
            ['identity_id'],
            $this->tableIdentity,
            ['id'],
            'CASCADE',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('FK_IdentityToken_IdentityId__Identity_Id', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
