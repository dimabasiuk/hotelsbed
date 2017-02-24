<?php
use yii\helpers\Html;
?>
<h1>Password reset form</h1>
<div class="box box_spacious box_small">
    <?php $form = \yii\widgets\ActiveForm::begin([
        'id' => 'login-form',
        'options'=>[
            'class' => 'form'
        ]
    ]);
    ?>

    <?= $form->field($model, 'password')->label(false)->passwordInput(['placeholder'=>'Password']) ?>

    <?= Html::submitButton('Password Reset', ['class' => 'btn btn_img btn_img-login', 'name' => 'signup-button']) ?>

    <?php \yii\widgets\ActiveForm::end(); ?>

</div>