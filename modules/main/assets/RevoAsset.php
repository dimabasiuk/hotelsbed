<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 30.05.16
 * Time: 22:27
 */

/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 29.03.16
 * Time: 23:11
 */
namespace app\modules\main\assets;
use yii\web\AssetBundle;

class RevoAsset extends AssetBundle
{

    public $sourcePath = '@webroot/components/revolution_slider';
    public $css = [
        'css/settings.css',
        'css/style.css'
    ];
    public $js = [
        'js/jquery.themepunch.tools.min.js',
        'js/jquery.themepunch.revolution.min.js'
    ];
}