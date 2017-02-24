<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <div class = "row">

        <div class = "col-md-12">
            <div class = "nav-tabs-custom">
                <ul class ="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#account" aria-controls="account" role="tab" data-toggle="tab">
                            <?php echo Yii::t('admin', 'Account Settings') ?></a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                            <?php echo Yii::t('admin', 'Profile Settings') ?></a></li>
                </ul>
                <?php $form = ActiveForm::begin(); ?>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="account">
                        <div class = "row">
                            <div class="col-md-8 col-md-offset-1 form-group">
                                <?php echo $form->field($model, 'username',
                                    [
                                        'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-user"></i>']]
                                    ])->textInput(['class' => 'form-control']) ?>

                                <?php echo $form->field($model, 'email',
                                    [
                                        'addon' =>['prepend'=> ['content'=>'<i class="fa fa-envelope" aria-hidden="true"></i>']]
                                    ])->textInput(['class' => 'form-control']) ?>

                                <?php echo $form->field($model,'password', [
                                    'addon' =>['prepend'=> ['content'=>'<i class="glyphicon glyphicon-lock"></i>']]
                                ])->textInput(['class' => 'form-control', 'id'=>'password-field']) ?>
                                <?= $form->field($model, 'status')->dropDownList([
                                    '2' => Yii::t('admin', 'Активно'),
                                    '1' => Yii::t('admin', 'Неактивно'),
                                ]) ?>
                                <div>
                                    <button type="button" class="btn btn-primary" id="generate-button">Генерировать пароль</button>
                                </div>
                                <?php echo $form->field($model, 'roles')->checkboxList($roles) ?>
                            </div>
                        </div>
                    </div>


                    <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-1 form-group">
                                <?php echo $form->field($model, 'picture')->widget(
                                    \trntv\filekit\widget\Upload::classname(),
                                    [
                                        'url' => ['avatar-upload'],

                                    ]
                                )?>

                                <?php echo $form->field($model, 'firstname', [
                                    'addon' => ['prepend' => ['content'=>'<i class="fa fa-user" aria-hidden="true"></i>']]
                                ])->textInput(['class' => 'form-control']) ?>

                                <?php echo $form->field($model, 'middlename', [
                                    'addon' => ['prepend' => ['content'=>'<i class="fa fa-user" aria-hidden="true"></i>']]
                                ])->textInput(['class' => 'form-control']) ?>

                                <?php echo $form->field($model, 'lastname',
                                    [
                                        'addon' => ['prepend' => ['content'=>'<i class="fa fa-user" aria-hidden="true"></i>']]
                                    ])->textInput(['class' => 'form-control']) ?>

                                <?php echo $form->field($model, 'country',
                                    [
                                        'addon' => ['prepend' => ['content'=>'<i class="fa fa-home" aria-hidden="true"></i>']]
                                    ])->textInput(['class'=>'form-control', 'id' => 'inputCountry']);?>

                                <?php echo $form->field($model, 'city',
                                    [
                                        'addon' => ['prepend' => ['content'=>'<i class="fa fa-home" aria-hidden="true"></i>']]
                                    ])->textInput(['class'=>'form-control', 'id' => 'inputCity']);?>

                                <?= $form->field($model, 'locale')->dropDownList(Yii::$app->params['availableLocales']); ?>


                                </div>

                            </div>
                        </div>
                    </div>

                    </div>
                    <div class="form-group update-button">
                        <?= Html::submitButton(Yii::t('admin', '<i class ="glyphicon glyphicon-edit"></i>'.' '.'Change'), ['class' => 'btn btn-success btn-standart']) ?>
                        <?= Html::a('<i class = "glyphicon glyphicon-ban-circle"></i>'.' '.Yii::t('admin', 'Cancel'), ['/admin/user/index'],  ['class' => 'btn btn-danger btn-standart'])?>
                    </div>
        </div>
        <?php ActiveForm::end(); ?>


    </div>
</div>

