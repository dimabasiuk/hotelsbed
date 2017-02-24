<?php
namespace app\modules\user\models;

use app\models\User;
use app\models\UserToken;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ChangePasswordForm extends Model
{
    /**
     * @var
     */
    public $old_password;
    public $new_password;
    public $new_password_confirm;

    /**
     * @var \common\models\UserToken
     */


    /**
     * Creates a form model given a token.
     *
     * @param  string                          $token
     * @param  array                           $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['old_password', 'required'],
            ['old_password', 'string', 'min' => 8],
            ['new_password', 'required'],
            ['new_password', 'string', 'min' => 8],
            ['new_password_confirm', 'required', 'when' => function($model) {
                return !empty($model->new_password);
            }],
            ['new_password_confirm', 'compare', 'compareAttribute' => 'new_password', 'skipOnEmpty' => false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'old_password'=>'Old password',
            'new_password'=>'New password',
            'new_password_confirm' => 'New password confirm'
        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function setNewPassword()
    {
        $user = User::findIdentity(Yii::$app->user->id);

        if($user->validatePassword($this->old_password)){
            $user->setPassword($this->new_password);
            $user->save(false);
            return true;
        } else {
            return false;
        }
           }

    /**
     * @return array
     */

}
