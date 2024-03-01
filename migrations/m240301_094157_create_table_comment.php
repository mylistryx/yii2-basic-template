<?php

use yii\db\Migration;

/**
 * Class m240301_094157_create_table_comment
 */
class m240301_094157_create_table_comment extends Migration
{
    public string $tableName = '{{%comment}}';
    public string $tableIdentity = '{{%identity}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
          'id' => $this->primaryKey(),
          'parent_id' => $this->integer()->null(),
          'level' => $this->integer()->notNull()->defaultValue(0),
          'type_id' => $this->integer()->notNull(),
          'type_item_id' => $this->integer()->notNull(),
          'text' => $this->text(),
          'status' => $this->integer()->notNull()->defaultValue(0),
          'created_at' => $this->dateTime()->notNull(),
          'updated_at' => $this->dateTime()->notNull(),
          'created_by' => $this->integer()->notNull(),
          'updated_by' => $this->integer()->notNull(),
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
