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

class NoConflictAsset extends AssetBundle
{
    public $basePath = "@webroot";

    public $js = [
        'js/jquery.noconflict.js'
    ];
}