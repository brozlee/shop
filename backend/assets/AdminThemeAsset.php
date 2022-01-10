<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AdminThemeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'admin-theme/css/style.css',
        'vendors/typicons/typicons.css',
        'vendors/ti-icons/css/themify-icons.css',
    ];
    public $js = [
    	'admin-theme/js/demo.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
