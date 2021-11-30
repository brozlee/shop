<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Products */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">
    <?php if(Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success" role="alert">
       <?= Yii::$app->session->getFlash('success') ?>
    </div>
    <?php endif ?>
    <?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger" role="alert">
           <?=Yii::$app->session->getFlash('error')?>
        </div>
    <?php endif ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'short_description',
            'price',
            'thumb',
            'meta_title',
            'meta_description',
            'content:ntext',
            'category_id',
            'slug',
            'sort',
        ],
    ]) ?>

    <h3>Свойства товара</h3>
    <div style="display: flex">
        <?= Html::a('Редактировать', ['edit-attributes', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        <ul>
            <?php if(!empty($model->attributesValuesList())): ?>
                <?php foreach($model->attributesValuesList() as $key => $value): ?>
                    <li><span style="font-size: 18px;color: darkblue;margin-right: 20px"><?=$key?>:</span><span><?=$value?></span></li>
                <?php endforeach; ?>
            <?php endif ?>
        </ul>

    </div>

</div>
