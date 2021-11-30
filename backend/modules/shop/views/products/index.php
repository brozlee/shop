<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchProducts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($model){
                    return $model->name . ' ' .$model->vendor_code ;
                }
            ],
            'description:ntext',
            'price',
            //'thumb',
            //'meta_title',
            //'meta_description',
            //'content:ntext',
            [
              'attribute' => 'category_id',
              'format' => 'raw',
                'value' => function($model){
                 return $model->category->name;
                }
            ],
            'slug',
            [
            'attribute' => 'active',
            'format' => 'raw',
            'value' => function($model){
                return $model->statusName;
            }
        ],
            //'sort',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
