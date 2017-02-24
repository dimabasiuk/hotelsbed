<?php

namespace app\modules\admin\controllers;

use app\modules\user\models\LoginForm;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class SignInController extends Controller
{
    public $layout = "base";
    /**
     * Renders the index view for the module
     * @return string
     */


    public function actionLogin()
    {
        {

            $model = new LoginForm();


            if ($model->load(\Yii::$app->request->post()) && $model->login()) {
                return $this->redirect('/admin/user/index');
            }

            return $this->render('login', [
                'model' => $model
            ]);

        }

    }
}
