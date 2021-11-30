<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attributes".
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property int $group_id
 * @property int $sort
 */
class Attributes extends \yii\db\ActiveRecord
{

    const INT_TYPE = 1;
    const STRING_TYPE = 2;
    const CHECKBOX_TYPE = 3;


    public function typeNamesList() {
        return array(
            'INT_TYPE' => 'number',
            'STRING_TYPE' => 'text',
            'CHECKBOX_TYPE' => 'checkbox'
        );

    }

    public function typVal() {
        return array(
            '1' => 'INT_TYPE',
            '2' => 'STRING_TYPE',
            '3' => 'CHECKBOX_TYPE'
        );

    }

    public function typValSelectList() {
        return array(
            '1' => 'Числовой',
            '2' => 'Строка',
            '3' => 'Чекбокс'
        );

    }



    public function getGroup() {
        return $this->hasOne(AttributesCategory::className(), ['id' => 'group_id']);
    }

    public function getGroupList() {
        $groupList = array();
        $attributes_categories = AttributesCategory::find()->all();
        if($attributes_categories){
            foreach ($attributes_categories as $attr) {
                $groupList[$attr->id] = $attr->name;
            }
        }

        return $groupList;
    }



    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'group_id', 'sort'], 'required'],
            [['type', 'group_id', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 155],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'type' => 'Тип значения',
            'group_id' => 'Категория значений',
            'sort' => 'Сортировка',
        ];
    }
}
