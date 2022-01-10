<?php

namespace backend\modules\shop\models;

use common\components\SortBehavior;
use Yii;

/**
 * This is the model class for table "attributes_values".
 *
 * @property int $id
 * @property int $product_id
 * @property string $product_values
 */
class ProductValues extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_values';
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'attribut_id', 'value', 'sort'], 'required'],
            [['product_id', 'attribut_id', 'sort'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    public function getAttrName() {
        $attribut = Attributes::find()->where(['id' => $this->attribut_id])->one();
        return $attribut->name;
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
            'value' => 'Value',
        ];
    }
}
