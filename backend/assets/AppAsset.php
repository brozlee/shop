<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'js/js.ui/jquery-ui.min.css',
        'js/js.ui/jquery-ui.structure.min.css',
        'js/js.ui/jquery-ui.theme.min.css'
    ];
    public $js = [
    	'js/js.ui/jquery-ui.min.js',
    	'js/custom.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
