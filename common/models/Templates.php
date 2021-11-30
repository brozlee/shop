<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "templates".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $access
 */
class Templates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'templates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'access'], 'required'],
            [['description'], 'string'],
            [['access'], 'integer'],
            [['name'], 'string', 'max' => 150],
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
            'access' => 'Access',
        ];
    }
}
