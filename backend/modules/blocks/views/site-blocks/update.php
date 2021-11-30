<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SiteBlocks */

$this->title = 'Update Site Blocks: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Site Blocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="site-blocks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>