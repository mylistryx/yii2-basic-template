<?php

use app\components\migrations\Migration;

class m240508_212859_create_identity_profile_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%identity_profile_contact}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%identity_profile_contact}}');
    }
}
