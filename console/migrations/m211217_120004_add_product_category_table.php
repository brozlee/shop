<?php

use yii\db\Migration;

/**
 * Class m211217_120004_add_product_category_table
 */
class m211217_120004_add_product_category_table extends Migration
{
    public $table = '{{%products_category}}';

    public function safeUp() {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->text(),
            'short_description' => $this->string(),
            'atribute_group_id' => $this->integer(),
            'thumb' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'slug' => $this->string(),
            'date_create' => $this->dateTime(),
            'date_update' => $this->dateTime(),
            'sort' => $this->integer(),
            'active' => $this->integer()
        ]);

        foreach (['name', 'date_create', 'date_update'] as $column) {
            $this->createIndex($column, $this->table, $column);
        }
    }

    public function safeDown() {
        $this->dropTable($this->table);
    }
}
