<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "site_blocks".
 *
 * @property int $id
 * @property int $type_id
 * @property int $position_id
 * @property string $title
 * @property string $style
 * @property string $description
 * @property int $sort
 */
class SiteBlocks extends \yii\db\ActiveRecord
{
    //private $_template;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site_blocks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'position_id', 'title', 'style', 'description', 'sort'], 'required'],
            [['type_id', 'position_id', 'sort'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['style'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type ID',
            'position_id' => 'Position ID',
            'title' => 'Title',
            'style' => 'Style',
            'description' => 'Description',
            'sort' => 'Sort',
        ];
    }


    public function getTemplate()
    {
        return $this->hasOne(Templates::className(), ['id' => 'template_id']);
    }
}
