<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 05.10.16
 * Time: 12:51
 */

namespace app\modules\admin\assets;

use yii\web\AssetBundle;


class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/admin.css',
    ];
    public $js = [
        'js/admin.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'app\modules\admin\assets\AdminLteAsset',
        'app\assets\FontAwesomeAsset',
        'app\modules\admin\assets\MagnificAsset',

    ];
}


/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
