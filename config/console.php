<?php

//$params = require(__DIR__ . '/params.php');
$db_local = require(__DIR__ . '/db-local.php');
$db_server = require(__DIR__ . '/db-server.php');

$config = [
    'id' => 'console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\console\controllers',
    'controllerMap' => [
        'message' => [
            'class' => 'app\console\controllers\ExtendedMessageController'
        ],
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@app/migrations/db',
            'migrationTable' => '{{%system_db_migration}}'
        ],
        'rbac-migrate' => [
            'class' => 'app\console\controllers\RbacMigrateController',
            'migrationPath' => '@app/migrations/rbac/',
            'migrationTable' => '{{%system_rbac_migration}}',
            'templateFile' => '@app/rbac/views/migration.php'
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'db'=>[
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'except'=>['yii\web\HttpException:*', 'yii\i18n\I18N\*'],
                    'prefix'=>function () {
                        $url = !Yii::$app->request->isConsoleRequest ? Yii::$app->request->getUrl() : null;
                        return sprintf('[%s][%s]', Yii::$app->id, $url);
                    },
                    'logVars'=>[],
                    'logTable'=>'{{%system_log}}'
                ]
            ],
        ],
        'db' => $db_local,
        //'db' => $db_server
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
  //  'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];



return $config;
