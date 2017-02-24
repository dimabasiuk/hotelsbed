<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 09.02.17
 * Time: 13:14
  * */
$db_local = require(__DIR__ . '/db-local.php');
$db_server = require(__DIR__ . '/db-server.php');
$urlManager = require(__DIR__ . '/urlManager.php');
$params = require(__DIR__ . '/params.php');



$config = [
    'id' => 'basic',
    'name' => 'yii2_base_template',
    'layout' => "@app/modules/main/views/layouts/main.php",
    //'layout' => "@app/modules/main/views/layouts/main.twig",
    'basePath' => realpath (__DIR__ . '/../'),
    'sourceLanguage'=>'en',
    'language'=>'en',
    'defaultRoute' => '',
    'modules' => [
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'main' => [
            'class' => 'app\modules\main\Module',
        ]
    ],
    'components' => [

        'request' => [
            'cookieValidationKey' => env('APP_COOKIE_VALIDATION_KEY'),
            'baseUrl' => ''
        ],
        'user' => [
            'class'=>'yii\web\User',
            'identityClass' => 'app\models\User',
            'loginUrl'=>['/user/sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => 'app\behaviors\LoginTimestampBehavior'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'errorHandler' => [
            'errorAction' => '/main/site/error',
        ],
        'db' => $db_local,
        //uncomment when use on hosting
        //'db' => $db_server,

        'urlManager' => $urlManager,
        'i18n' => [
            'translations' => [

                '*'=> [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceMessageTable'=>'{{%source_message}}',
                    'messageTable'=>'{{%message}}',
                    // 'on missingTranslation' => ['\backend\modules\i18n\Module', 'missingTranslation']
                ],

            ],
        ],
        'fileStorage' => [
            'class' => '\trntv\filekit\Storage',
            'baseUrl' => '@web/uploads',
            'filesystem' => [
                'class' => 'app\components\filesystem\LocalFlysystemBuilder',
                'path' => '@webroot/uploads'
            ],
            'as log' => [
                'class' => 'app\behaviors\FileStorageLogBehavior',
                'component' => 'fileStorage'
            ]
        ],
        'glide' => [
            'class' => 'trntv\glide\components\Glide',
            'sourcePath' => '@web/uploads',
            'cachePath' => '@runtime/glide',
            'signKey' => env('GLIDE_SIGN_KEY')
        ],



    ],
    'params' => $params,
];

if (YII_DEBUG) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.1', '172.17.42.1', '172.17.0.1'],
    ];
}

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.1', '172.17.42.1', '172.17.0.1', '*'],
    ];
}

return $config;

