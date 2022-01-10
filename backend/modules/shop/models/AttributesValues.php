<?php

namespace backend\modules\shop\models;

use Yii;

/**
 * This is the model class for table "attributes_values".
 *
 * @property int $id
 * @property int $product_id
 * @property string $product_values
 */
class AttributesValues extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attributes_values';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'product_values'], 'required'],
            [['product_id'], 'integer'],
            [['product_values'], 'string', 'max' => 255],
        ];
    }


    public function getAttrValuesList(){
        $data = unserialize($this->product_values);
        $value_list = array();
        foreach ($data as $key => $value){
            $attribut = Attributes::find()->where(['id' => $key])->one();
            $value_list[$attribut->name] = $attribut->name;
        }
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'product_values' => 'Product Values',
        ];
    }
}
