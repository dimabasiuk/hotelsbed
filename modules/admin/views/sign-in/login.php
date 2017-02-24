<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 05.10.16
 * Time: 16:23
 */
?>

<div class="login-box">
    <div class="login-logo">
        <a href="/"><b><?= Yii::$app->name?></b></a>
        <br>
        <h4><?= Yii::t('admin', 'Welcome to admin panel')?></h4>
    </div>
    <!-- /.login-logo -->
    <?php $form = ActiveForm::begin([
        'id' => 'login-admin-form',
        'options'=>[
            'class' => 'form'
        ]
    ]);
    ?>
    <div class="login-box-body">
        <p class="login-box-msg">Log in to start your session</p>

        <?php echo $form->field($model, 'identity',
            [
                'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-user"></i>']]
            ]) ?>

        <?php echo $form->field($model, 'password',
            [
                'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-lock"></i>']]
            ])->passwordInput() ?>

        <?php echo $form->field($model, 'rememberMe')->widget(\kartik\checkbox\CheckboxX::className(), [
            'autoLabel'=>true
        ])->label(false); ?>

                <!-- /.col -->
        <div class="col-xs-4">
            <?php echo Html::submitButton('<i class = "glyphicon glyphicon-check"></i>'.' '.Yii::t('admin','Login'), ['class' => 'btn btn-primary btn-block btn-flat btn-standart', 'name' => 'login-admin-button', 'id' =>'login-admin-button']) ?>
        </div>
        <div class="col-xs-4">
            <?php echo Html::a('<i class = "glyphicon glyphicon-ban-circle"></i>'.' '.Yii::t('admin', 'Cancel'), ['/'], ['class' => 'btn btn-danger btn-block btn-flat btn-standart']) ?>
        </div>
            <?php ActiveForm::end(); ?>
        <br>
        <br>

        </div>

                <!-- /.col -->
    </div>



        <!-- /.social-auth-links

        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>
-->
</div>
    <!-- /.login-box-body -->

