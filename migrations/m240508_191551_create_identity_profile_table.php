<?php

use app\enums\TablesEnum;
use app\components\migrations\Migration;

class m240508_191551_create_identity_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(TablesEnum::IdentityProfile->name, [
            'id' => $this->primaryKey(),
            'identity_id' => $this->integer()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'patronymic' => $this->string()->notNull(),
            'birthday' => $this->date()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey(
            $this->generateFkName(TablesEnum::IdentityProfile->name, TablesEnum::Identity->name, 'id'),
            TablesEnum::IdentityProfile->name,
            'identity_id',
            TablesEnum::Identity->name,
            'id',
            'CASCADE',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(TablesEnum::IdentityProfile->name);
    }
}
