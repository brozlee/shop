<?php

namespace backend\modules\shop\models;

use yii\behaviors\SluggableBehavior;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $short_description
 * @property int $price
 * @property string $thumb
 * @property string $meta_title
 * @property string $meta_description
 * @property string $content
 * @property int $category_id
 * @property string $slug
 * @property int $sort
 */
class Products extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_UNACTIVE = 2;

    //private $_category;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    static $statuses =
        [
            self::STATUS_ACTIVE => 'Активный',
            self::STATUS_UNACTIVE => 'Не активный',
        ];

    public function getStatusName() {
        return self::$statuses[$this->active];
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'short_description', 'price', 'meta_title', 'meta_description', 'content', 'category_id', 'sort'], 'required'],
            [['description', 'content', 'vendor_code'], 'string'],
            [['price', 'category_id', 'sort'], 'integer'],
            [['name', 'thumb', 'meta_title', 'slug'], 'string', 'max' => 155],
            [['short_description'], 'string', 'max' => 200],
            [['meta_description'], 'string', 'max' => 255],
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
            'name' => 'Наименование',
            'vendor_code' => 'Артикул',
            'description' => 'Описание',
            'short_description' => 'Краткое описание',
            'price' => 'Цена',
            'thumb' => 'Изображение товара',
            'meta_title' => 'Meta Заголовок',
            'meta_description' => 'Meta Описание',
            'content' => 'Контент',
            'category_id' => 'Категория',
            'slug' => 'Slug',
            'sort' => 'сортировка',
        ];
    }

    public function getCategory() {

        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);

    }

    public function deleteData() {
        $error = '';
        $success = '';
        if(isset($this->thumb) && $this->thumb != '') {
            unlink('uploads/products/img/'. $this->thumb);
            $success .= 'Выполнено <br>';
        }else {
            $error .= 'Ошибка <br>';
        }

        if(!empty($this->attr)) {
            foreach ($this->attr as $attr) {
                if($attr->delete()) {
                    $success .= 'Выполнено <br>';
                }else {
                    $error .= 'Ошибка <br>';
                }
            }
        }
        if($error == '') {

            return true;
        }else {
            var_dump($error);
        }



    }

    public function getAttr() {

        return $this->hasMany(ProductValues::className(), ['product_id' => 'id'])->orderBy(['sort' => SORT_ASC]);;

    }

    public function getCategoryList() {
        $categoryList = array();
        $categories = ProductCategory::find()->all();
        if($categories){
            foreach ($categories as $category) {
                $categoryList[$category->id] = $category->name;
            }
        }

        return $categoryList;
    }


    public function attributesList() {
        return $this->category->attributesItems->attributesItems;
    }

    public function attributesValuesList() {
        $list = array();
        if ($this->attr) {
            foreach ($this->attr as $value) {
               $attribut = Attributes::find()->where(['id' => $value->attribut_id])->one();

               $list[$attribut->name] = $value->value;
            }
        }
        return $list;
    }


}
