<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AttributesCategory */

$this->title = 'Create Attributes Category';
$this->params['breadcrumbs'][] = ['label' => 'Attributes Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attributes-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
