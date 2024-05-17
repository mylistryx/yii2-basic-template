<?php

use app\components\migrations\Migration;
use app\enums\TablesEnum;
use app\models\Country;

class m240516_090705_create_table_country extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(): void
    {

        $this->createTable(TablesEnum::Country->value, [
            'id' => $this->primaryUuid(),
            'name' => $this->string(64)->notNull(),
            'name_en' => $this->string(64)->notNull(),
            'alpha2' => $this->string(2)->notNull(),
            'alpha3' => $this->string(3)->notNull(),
            'iso' => $this->string(3)->notNull()->unique(),
            'order' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        $this->importData();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(TablesEnum::Country->value);
    }

    private function importData(): void
    {
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'data/countries.json';
        $json = file_get_contents($file);
        $data = json_decode($json, true);
        foreach ($data as $value) {
            try {
                var_dump($value);
                $model = new Country($value);
                if (!$model->validate()) {
                    var_dump($model->errors);
                    die();
                }
                $model->saveOrPanic(false);
                echo $model->name . ' import success!' . PHP_EOL;
            } catch (Throwable $e) {
                var_dump($model->errors);
                var_dump($e->getMessage());
            }
        }
    }
}
