<?php
namespace app\modules\admin\models;

use app\models\User;
use app\models\UserProfile;
use yii\base\Exception;
use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Create user form
 */
class UserForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $status;
    public $roles;
    public $firstname;
    public $lastname;
    public $middlename;
    public $picture;
    public $country;
    public $city;
    public $locale;

    public $isNewRecord;
    private $model;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::className(), 'filter' => function ($query) {
                if (!$this->getModel()->isNewRecord) {
                    $query->andWhere(['not', ['id'=>$this->getModel()->id]]);
                }
            }],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass'=> User::className(), 'filter' => function ($query) {
                if (!$this->getModel()->isNewRecord) {
                    $query->andWhere(['not', ['id'=>$this->getModel()->id]]);
                }
            }],

            ['password', 'required', 'on' => 'create'],
            ['password', 'string', 'min' => 6],

            [['status', 'city', 'country'], 'integer'],
            [['firstname', 'lastname', 'middlename','locale'], 'string'],
            [['roles'], 'each',
                'rule' => ['in', 'range' => ArrayHelper::getColumn(
                    Yii::$app->authManager->getRoles(),
                    'name'
                )]
            ],
            ['picture', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'password' => Yii::t('app', 'Password'),
            'roles' => Yii::t('app', 'Roles'),
            'firstname' => Yii::t('app', 'First Name'),
            'lastname' => Yii::t('app', 'Last Name'),
            'middlename' => Yii::t('app', 'Middle Name'),
            'picture' => Yii::t('app', 'Avatar'),
            'country' => Yii::t('app', 'Country'),
            'city' => Yii::t('app', 'City'),
            'locale' => Yii::t('app', 'Language'),


        ];
    }

    /**
     * @param User $model
     * @return mixed
     */
    public function setModel($model)
    {
        $this->username = $model->username;
        $this->email = $model->email;
        $this->status = $model->status;
        $this->model = $model;
        $this->roles = ArrayHelper::getColumn(
            Yii::$app->authManager->getRolesByUser($model->getId()),
            'name'
        );

        $profile = $model->userProfile;

        $this->firstname = $profile->firstname;
        $this->lastname = $profile->lastname;
        $this->middlename = $profile->middlename;
        $this->picture = $profile->picture;
        $this->city = $profile->city;
        $this->country = $profile->country;
        $this->locale = $profile->locale;


        return $this->model;
    }

    /**
     * @return User
     */
    public function getModel()
    {
        if (!$this->model) {
            $this->model = new User();

        }
        return $this->model;
    }

    /**
     * Signs user up.
     * @return User|null the saved model or null if saving fails
     * @throws Exception
     */
    public function save()
    {
        if ($this->validate()) {
            $model = $this->getModel();
            $this->isNewRecord = $model->getIsNewRecord();
            $model->username = $this->username;
            $model->email = $this->email;
            $model->status = $this->status;
            $model->password = $this->password;

            if (!$model->save()) {
                throw new Exception('Model not saved');
            }
            if ($this->isNewRecord) {
                $model->afterSignup();
            } else {
                $profile = $model->userProfile;
                $profile->picture = $this->picture;
                $profile->firstname = $this->firstname;
                $profile->middlename = $this->middlename;
                $profile->lastname = $this->lastname;
                $profile->country = $this->country;
                $profile->city = $this ->city;
                $profile->locale = $this->locale;
                if(!$profile->save()){
                    throw new Exception('Profile not saved');
                }
            }
            $auth = Yii::$app->authManager;
            $auth->revokeAll($model->getId());

            if ($this->roles && is_array($this->roles)) {
                foreach ($this->roles as $role) {
                    $auth->assign($auth->getRole($role), $model->getId());
                }
            }

            return !$model->hasErrors();
        }
        return null;
    }

    public function getArtistId() {
        return $this->artistId;
    }
}
