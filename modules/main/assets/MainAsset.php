<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\main\assets;

use yii\base\View;
use yii\jui\JuiAsset;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/updates.css',
        'css/custom.css',
        'css/responsive.css'
    ];
    public $js = [
        'js/waypoints.min.js',
        'js/theme-scripts.js',
        'js/scripts.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\modules\main\assets\NoConflictAsset',
        'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'app\modules\main\assets\FontAwesomeAsset',
        'app\modules\main\assets\AnimateJsAsset',
        'app\modules\main\assets\RevoAsset',
        'app\modules\main\assets\BxAsset',
        'app\modules\main\assets\StellarAsset'

    ];

}
