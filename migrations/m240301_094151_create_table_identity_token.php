<?php

use yii\db\Migration;

/**
 * Class m240301_094151_create_table_identity_token
 */
class m240301_094151_create_table_identity_token extends Migration
{
    public string $tableName = '{{%identity_token}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
          'id' => $this->primaryKey(),
          'email' => $this->integer()->null(),
          'created_at' => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey(
          'FK_Comment_ParentId__Comment_Id',
          $this->tableName,
          ['parent_id'],
          $this->tableName,
          ['id'],
          'CASCADE',
          'CASCADE'
        );

        $this->addForeignKey(
          'FK_Comment_CreatedBy__Identity_Id',
          $this->tableName,
          ['created_by'],
          $this->tableIdentity,
          ['id'],
          'CASCADE',
          'CASCADE'
        );

        $this->addForeignKey(
          'FK_Comment_UpdatedBy__Identity_Id',
          $this->tableName,
          ['updated_by'],
          $this->tableIdentity,
          ['id'],
          'CASCADE',
          'CASCADE'
        );

        $this->createIndex('IDX_Comment__TypeId_TypeItemId', $this->tableName, ['type_id', 'type_item_id']);
        $this->createIndex('IDX_Comment__Status', $this->tableName, ['status']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
