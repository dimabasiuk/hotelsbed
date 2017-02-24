<?php

namespace app\modules\main\controllers;

use app\modules\main\models\MainSearchForm;
use yii\helpers\VarDumper;
use yii\web\Controller;

/**
 * Default controller for the `main` module
 */
class SiteController extends Controller
{
    public function actions()
    {

        return [
           'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchForm = new MainSearchForm();

        if($searchForm->load(\Yii::$app->request->post())){
            $searchForm->send();
        }
       // VarDumper::dump('Test main');
        return $this->render('index', compact('searchForm'));
    }
}
