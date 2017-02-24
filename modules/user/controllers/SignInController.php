<?php

namespace app\modules\user\controllers;

use app\models\User;
use app\models\UserToken;
use app\modules\user\models\LoginForm;
use app\modules\user\models\SignupForm;
use app\modules\user\models\PasswordResetRequestForm;
use app\modules\user\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii;

/**
 * Default controller for the `user` module
 */
class SignInController extends Controller
{


    /**
     * @return array
     */
    public function actions()
    {
        return [
            'oauth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successOAuthCallback']
            ]
        ];
    }

    /**
     * @return array
     */



    public function actionLogin()
    {

        $model = new LoginForm();


        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        return $this->render('login', [
            'model' => $model
        ]);

    }
    /**
     * @return Response
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->redirect('/');
    }

    /**
     * @return string|Response
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(\Yii::$app->request->post())) {
            $user = $model->signup();

            if ($user) {
                if ($model->shouldBeActivated()) {

                    return $this->redirect(['/user/default/confirm', 'email'=>$model->email]);

                   /* Yii::$app->getSession()->setFlash('alert', [
                        'body' => Yii::t(
                            'frontend',
                            'Your account has been successfully created. Check your email for further instructions.'
                        ),
                        'options' => ['class'=>'alert-success']
                    ]);*/
                } else {
                    \Yii::$app->getUser()->login($user);

                }
                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model
        ]);
    }

    public function actionActivation($token)
    {
        $token = UserToken::find()
            ->byType(UserToken::TYPE_ACTIVATION)
            ->byToken($token)
            ->notExpired()
            ->one();

        if (!$token) {
            throw new BadRequestHttpException;
        }

        $user = $token->user;
        $user->updateAttributes([
            'status' => User::STATUS_ACTIVE
        ]);
        $token->delete();
        \Yii::$app->getUser()->login($user);

        \Yii::$app->getSession()->setFlash('alert', [
            'body' => 'Your account has been successfully activated.',
            'options' => ['class'=>'alert-success']
        ]);

        return $this->redirect('/user/default/confirmed');
    }

    /**
     * @return string|Response
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                \Yii::$app->getSession()->setFlash('alert', [
                    'body'=>\Yii::t('frontend', 'Check your email for further instructions.'),
                    'options'=>['class'=>'alert-success']
                ]);

                return $this->goHome();
            } else {
                \Yii::$app->getSession()->setFlash('alert', [
                    'body'=>\Yii::t('frontend', 'Sorry, we are unable to reset password for email provided.'),
                    'options'=>['class'=>'alert-danger']
                ]);
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * @param $token
     * @return string|Response
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            \Yii::$app->getSession()->setFlash('info', [
                'type' => 'info',
                'duration' => 10000,
                'icon' => 'fa fa-lock',
                'message' => 'New Password was saved',
                'title' => 'New Password Save',
                'positonY' => 'top',
                'positonX' => 'left'
            ]);
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * @param $client \yii\authclient\BaseClient
     * @return bool
     * @throws Exception
     */
    public function successOAuthCallback($client)
    {
        // use BaseClient::normalizeUserAttributeMap to provide consistency for user attribute`s names
        $attributes = $client->getUserAttributes();
       //var_dump($attributes);
       //die;

        if($client->getName()==='google') {

            $email= $attributes['emails'][0]['value'];
            $name = ArrayHelper::getValue($attributes, 'displayName');
            $client_user_id = $attributes['id'];
        }
        if($client->getName()==='facebook'){


            $email = $attributes['email'];
            $name = ArrayHelper::getValue($attributes, 'name');
            $client_user_id = $attributes['id'];

        }
        if($client->getName()==='linkedin'){

            $email = ArrayHelper::getValue($attributes,'email');
            $name = ArrayHelper::getValue($attributes, 'first_name')." ".ArrayHelper::getValue($attributes, 'last_name');
            $client_user_id = $attributes['id'];

        }


        $user = User::find()->where([
            'oauth_client_user_id'=>$client_user_id,

        ])
            ->one();

        if (!$user) {
            $user = new User();
            $user->scenario = 'oauth_create';
            //$user->username = ArrayHelper::getValue($attributes, 'name');
            $user->username = $name;
           // $user->email = $email;
            //$user->email = ArrayHelper::getValue($attributes, 'email');
            $user->status = User::STATUS_ACTIVE;
            $user->oauth_client = $client->getName();
            $user->oauth_client_user_id = ArrayHelper::getValue($attributes, 'id');
            $password = \Yii::$app->security->generateRandomString(8);
            $user->setPassword($password);
            if ($user->save()) {

                $profileData = [
                    'userPaymentPlan' =>[
                        'user_id' => $user->id,
                    ],
                    'userSocials' => [
                        'user_id' => $user->id,

                    ]
                ];
                /*if ($client->getName() === 'facebook') {
                    $profileData['firstname'] = ArrayHelper::getValue($attributes, 'first_name');
                    $profileData['lastname'] = ArrayHelper::getValue($attributes, 'last_name');
                }*/
                $user->afterSignup($profileData);
              /*  $sentSuccess = Yii::$app->commandBus->handle(new SendEmailCommand([
                    'view' => 'oauth_welcome',
                    'params' => ['user'=>$user, 'password'=>$password],
                    'subject' => Yii::t('frontend', '{app-name} | Your login information', ['app-name'=>Yii::$app->name]),
                    'to' => $user->email
                ]));
                if ($sentSuccess) {
                    Yii::$app->session->setFlash(
                        'alert',
                        [
                            'options'=>['class'=>'alert-success'],
                            'body'=>Yii::t('frontend', 'Welcome to {app-name}. Email with your login information was sent to your email.', [
                                'app-name'=>Yii::$app->name
                            ])
                        ]
                    );
                }*/

            } else {
                // We already have a user with this email. Do what you want in such case
                if ($user->email && User::find()->where(['email'=>$user->email])->count()) {
                    Yii::$app->session->setFlash(
                        'alert',
                        [
                            'options'=>['class'=>'alert-danger'],
                            'body'=>'We already have a user with email'.$user->email

                        ]
                    );
                } else {
                    Yii::$app->session->setFlash(
                        'alert',
                        [
                            'options'=>['class'=>'alert-danger'],
                            'body'=>'Error while oauth process.'
                        ]
                    );
                }

            };
        }

        if (Yii::$app->user->login($user, 3600 * 24 * 30)) {

            return $this->goBack();
        } else {
            throw new Exception('OAuth error');
        }
    }
}
