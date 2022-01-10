<?php

use yii\db\Migration;

/**
 * Class m211217_114452_add_product_table
 */
class m211217_114452_add_product_table extends Migration
{
    public $table = '{{%products}}';

    public function safeUp() {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'vendor_code' => $this->string(),
            'description' => $this->text(),
            'short_description' => $this->string(),
            'price' => $this->integer(),
            'thumb' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'content' => $this->text(),
            'category_id' => $this->integer(),
            'slug' => $this->string(),
            'date_create' => $this->dateTime(),
            'date_update' => $this->dateTime(),
            'sort' => $this->integer(),
            'active' => $this->integer()
        ]);

        foreach (['category_id', 'price', 'name'] as $column) {
            $this->createIndex($column, $this->table, $column);
        }
    }

    public function safeDown() {
        $this->dropTable($this->table);
    }
}
