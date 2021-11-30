<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SiteBlocks */

$this->title = 'Создать блок для приложения';
$this->params['breadcrumbs'][] = ['label' => 'Блоки приложения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-blocks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>