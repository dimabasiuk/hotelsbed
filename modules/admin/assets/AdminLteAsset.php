<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 05.10.16
 * Time: 12:51
 */

namespace app\modules\admin\assets;

use yii\web\AssetBundle;


class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@bower/admin-lte';


    public $css = [
        'dist/css/AdminLTE.min.css',
        'dist/css/skins/_all-skins.min.css'

    ];
    public $js = [
        'dist/js/app.min.js'
    ];

}



/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
