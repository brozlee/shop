<?php

namespace common\widgets;

use common\models\SiteBlocks;
use yii\base\Widget;
use common\models\Templates;
use yii\helpers\Html;
use Yii;


class RenderTemplateWidget extends Widget

{
    public $id_position;


    public function run()
    {
        $blocks = SiteBlocks::find(['position_id' => $this->id_position])->all();

        foreach ($blocks as $block) {
            echo \Yii::$app->view->renderFile('@common/templates/' . $block->template->name . '.php');
        }

    }



}