<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin','Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class = "glyphicon glyphicon-plus"></i>'.' '.Yii::t('admin', 'Create User'), ['create'], ['class' => 'btn btn-success btn-standart']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'auth_key',
            //'access_token',
            //'password_hash',
            // 'oauth_client',
            // 'oauth_client_user_id',
            'email:email',
            [
                'attribute' =>'status',
                'format' => 'html',
                'value' => function($model) {

                    switch($model->status){
                        case $model->status === \app\models\User::STATUS_ACTIVE:
                            return '<p class ="bg-success text-muted text-center">ACTIVE</p>';
                        break;
                        case $model->status === \app\models\User::STATUS_NOT_ACTIVE:
                            return '<p class ="bg-warning text-muted text-center">NOT ACTIVE</p>';
                            break;
                        case $model->status === \app\models\User::STATUS_DELETED:
                            return '<p class ="bg-danger text-muted text-center">DELETED</p>';
                            break;
                    }

                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    $created = new \DateTime();
                    $created = $created -> setTimestamp($model->created_at);
                    return $created -> format('Y-m-d H:i:s');
                }],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    $created = new \DateTime();
                    $created = $created -> setTimestamp($model->created_at);
                    return $created -> format('Y-m-d H:i:s');
                }],
            [
                'attribute' => 'logged_at',
                'label' => 'last login',
                'value' => function ($model) {
                    $created = new \DateTime();
                    $created = $created -> setTimestamp($model->created_at);
                    return $created -> format('Y-m-d H:i:s');
                }],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
