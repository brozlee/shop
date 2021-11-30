<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attributes_category".
 *
 * @property int $id
 * @property string $name
 */
class AttributesCategory extends \yii\db\ActiveRecord
{

    private $_attributes;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attributes_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => 'Name',
        ];
    }

    public function getAttributesItems()
    {
        return $this->hasMany(Attributes::className(), ['group_id' => 'id']);
    }



}
