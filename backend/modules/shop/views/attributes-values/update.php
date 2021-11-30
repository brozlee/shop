<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AttributesValues */

$this->title = 'Update Attributes Values: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Attributes Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="attributes-values-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
