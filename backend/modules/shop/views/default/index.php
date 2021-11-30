
<?php

use yii\helpers\Html;


?>


<div class="shop-default-index">
    <h1>Интернет Магазин</h1>

    <?= Html::a('Продукты', ['/shop/products/index'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Категории', ['/shop/product-category/index'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Категории атрибутов', ['/shop/attributes-category/index'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('Атрибуты', ['/shop/attributes/index'], ['class' => 'btn btn-info']) ?>


</div>
