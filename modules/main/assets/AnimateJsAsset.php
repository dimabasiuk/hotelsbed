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

class AnimateJsAsset extends AssetBundle
{
    public $sourcePath = '@bower/animate.css';
    public $css = [
        'animate.min.css',
    ];
}