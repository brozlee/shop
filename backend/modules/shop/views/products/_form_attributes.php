<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if($attributes_list): ?>
    <?php foreach($attributes_list as $attribute) :?>
            <?= $form->field($attributes_model, "value[$attribute->id]")->textInput(['maxlength' => true])->label($attribute->name) ?>
    <?php endforeach ?>
    <?php elseif(!$attributes_list && !$model->category->atribute_group_id): ?>
        <p class="alert-danger">К данному товару не привязана группа свойств. </p>
        <?= Html::a('Выбрать группу свойств в категории', ['product-category/update', 'id' => $model->category_id], ['class' => 'btn btn-success']) ?>
    <?php elseif(empty($model->category->getAttributesGroupList)): ?>
        <p class="alert-danger">В категории атрибутов не привязаны свойства. </p>
        <?= Html::a('Добавить', ['attributes/create'], ['class' => 'btn btn-success']) ?>
    <?php endif?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
