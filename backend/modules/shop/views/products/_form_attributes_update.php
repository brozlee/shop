<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form" data-product="<?= $model->id ?>">

    <?php $form = ActiveForm::begin(); ?>

    <div class="ui-list">
        <?php foreach($attributes_model as $attribute) :?>
            <div class="input-group" data-id="<?=$attribute->id?>" data-position="<?=$attribute->sort ?>">
                <?= $form->field($attribute, "value[$attribute->id]")->textInput(['maxlength' => true, 'value' => $attribute->value])->label($attribute->attrName) ?>
                <?= $form->field($attribute, "sort[$attribute->id]")->hiddenInput(['maxlength' => true, 'value' => $attribute->sort, 'data-id' => $attribute->id])->label('') ?>
            </div>
        <?php endforeach ?>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
