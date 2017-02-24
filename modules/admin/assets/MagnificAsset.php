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
namespace app\modules\admin\assets;
use yii\web\AssetBundle;

class MagnificAsset extends AssetBundle
{
    public $sourcePath = '@bower/magnific-popup';
    public $css = [
        'dist/magnific-popup.css'
    ];
    public $js = [
        'dist/jquery.magnific-popup.min.js',
    ];
}