<?php
namespace app\modules\user\models;


use app\models\Settings;
use app\models\User;
use app\models\UserToken;
use frontend\modules\user\Module;
use yii\base\Exception;
use yii\base\Model;
use Yii;
use yii\helpers\Url;

/**
 * Signup form
 */
class SignupForm extends Model
{
    /**
     * @var
     */
    public $username;
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */

    public $password;

    public $password_confirm;
    /**
     * @var
     */
    public $facebook;

    public $twitter;

    public $linkedin;
    /**
     * @var
     */


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique',
                'targetClass'=>'\app\models\User',
                'message' =>'This username has already been taken.'
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass'=> '\app\models\User',
                'message' => 'This email address has already been taken.'
            ],
            ['password', 'required'],
            ['password', 'string', 'min' => 8],
            ['password_confirm', 'required', 'when' => function($model) {
                return !empty($model->password);
            }],
            ['password_confirm', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false],



        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username'=>'Username',
            'email'=>'Email',
            'password'=> 'Password',
            'password_confirm'=> 'Confirm Password',
            'facebook'=>'Facebook',
            'twitter'=>'Twitter',
            'linkedin' => 'Linkedin'
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $shouldBeActivated = $this->shouldBeActivated();

            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = $shouldBeActivated ? User::STATUS_NOT_ACTIVE : User::STATUS_ACTIVE;
            $user->setPassword($this->password);
            if(!$user->save()) {
                throw new Exception("User couldn't be  saved");
            };
            $user->afterSignup([
                'userPaymentPlan' =>[
                    'user_id' => $user->id,
                ],
                'userSocials' => [
                    'user_id' => $user->id,
                    'facebook' => $this->facebook,
                    'twitter' => $this->twitter,
                    'linkedin' => $this->linkedin,
                    ]
            ]);
            if ($shouldBeActivated) {
                $token = UserToken::create(
                    $user->id,
                    UserToken::TYPE_ACTIVATION,
                    3600*24
                );

                $message = Yii::$app->mailer->compose('activation', [
                    'token' => $token,

                ]);
                $message->setFrom(Settings::getAdminEmail())
                    ->setTo($user->email)
                    ->setSubject('Activation email')
                    ->send();

            }
            return $user;
        }

        return null;
    }

    /**
     * @return bool
     */
    public function shouldBeActivated()
    {
        /** @var Module $userModule */

       if(Yii::$app->params['shouldBeActivated']) {

           return true;
       } else {
           return false;
       }
    }
}
