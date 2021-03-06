<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchSiteBlocks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="site-blocks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'position_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'style') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
