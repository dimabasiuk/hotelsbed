<?php
namespace app\modules\admin\components\widgets;

use \app\modules\user\models\SignupForm;
use yii\widgets\ActiveForm;
use yii\web\Response;
use Yii;



/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 01.04.16
 * Time: 22:37
 */


class MainMenu extends \yii\base\Widget
{

    public function run()
    {

        return $this->render('main-menu');


    }
}