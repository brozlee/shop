<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;

use Yii;

/**
 * This is the model class for table "product_category".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $short_description
 * @property int $atribute_group_id
 * @property string $thumb
 * @property string $meta_title
 * @property string $meta_description
 * @property string $slug
 * @property int $sort
 */
class ProductCategory extends \yii\db\ActiveRecord
{

    private $_attributes;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'short_description', 'atribute_group_id', 'thumb', 'meta_title', 'meta_description', 'sort'], 'required'],
            [['description'], 'string'],
            [['atribute_group_id', 'sort'], 'integer'],
            [['name', 'thumb', 'meta_title', 'slug'], 'string', 'max' => 155],
            [['short_description', 'meta_description'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'slugAttribute' => 'slug',
            ],
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
            'description' => 'Description',
            'short_description' => 'Short Description',
            'atribute_group_id' => 'Atribute Group ID',
            'thumb' => 'Thumb',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'slug' => 'Slug',
            'sort' => 'Sort',
        ];
    }

    public function getAttributesItems()
    {
        return $this->hasOne(AttributesCategory::className(), ['id' => 'atribute_group_id']);
    }


    public function getAttributesGroupList() {
        $groupList = array();
        $attr_group = AttributesCategory::find()->all();
        if($attr_group){
            foreach ($attr_group as $group) {
                $groupList[$group->id] = $group->name;
            }
        }

        return $groupList;
    }
}
