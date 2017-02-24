<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 03.10.16
 * Time: 17:19
 */

?>
<h1>Log in</h1>
<div class="box box_spacious box_small">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options'=>[
            'class' => 'form'
        ]
    ]);
    ?>
        <?= $form->field($model, 'identity')->label(false)->textInput(['autofocus' => true, 'placeholder'=>'Username']) ?>

        <?= $form->field($model, 'password')->label(false)->passwordInput(['placeholder'=>'Password']) ?>

        <?= Html::submitButton('Login', ['class' => 'btn btn_img btn_img-login', 'name' => 'signup-button']) ?>

    <?php ActiveForm::end(); ?>
    <div class="box-social">
        <p>Log in with</p>
        <div class="btnset btnset_social">

            <?= Html::a('facebook', ['/user/sign-in/oauth', 'authclient'=>'facebook'], ['class'=>'btn btn_social btn_social-facebook'])?>
            <?= Html::a('youtube', ['/user/sign-in/oauth', 'authclient'=>'google'], ['class'=>'btn btn_social btn_social-youtube'])?>
            <?= Html::a('twitter', ['/user/sign-in/oauth', 'authclient'=>'twitter'], ['class'=>'btn btn_social btn_social-twitter'])?>
            <?= Html::a('linkedin', ['/user/sign-in/oauth', 'authclient'=>'linkedin'], ['class'=>'btn btn_social btn_social-linkedin'])?>

        </div>
    </div>
</div>
<p class="p-log-links">
    <a href="#popup-register" class="js-getPopup">Register</a>
    <a href="#popup-password" class="js-getPopup">Forgot password?</a>
</p>


