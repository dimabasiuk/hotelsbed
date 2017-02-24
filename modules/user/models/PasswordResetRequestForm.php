<?php
namespace app\modules\user\models;

use cheatsheet\Time;
use common\commands\SendEmailCommand;
use app\models\UserToken;
use Yii;
use app\models\User;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    /**
     * @var user email
     */
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => 'app\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            $token = UserToken::create($user->id, UserToken::TYPE_PASSWORD_RESET, 3600*24);

            if ($user->save()) {
                $message = Yii::$app->mailer->compose('passwordResetToken', [
                    'user' => $user,
                    'token' => $token->token,

                ]);

                $message->setFrom(Yii::$app->params['adminEmail'])
                    ->setTo($this->email)
                    ->setSubject('Password reset for: '.Yii::$app->name)
                    ->send();

                return true;

            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'email'=>'E-mail'
        ];
    }
}
