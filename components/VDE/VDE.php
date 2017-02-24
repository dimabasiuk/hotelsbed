<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 01.08.16
 * Time: 12:43
 */

namespace app\components\VDE;

use yii\helpers\VarDumper;

/**
 * Class VDE
 * VarDumper extenion for my own use
 */

class VDE extends VarDumper
{
    public static function dd($var, int $depth = 10, bool $end = true)
    {
        parent::dump($var, $depth, true);
        if($end)
          \Yii::$app->end();
    }
}