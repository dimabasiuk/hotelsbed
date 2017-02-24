<?php

return [
    'class'=>'yii\db\Connection',
    'dsn' => env('DB_DSN_SERVER'),
    'username' => env('DB_USERNAME_SERVER'),
    'password' => env('DB_PASSWORD_SERVER'),
    'tablePrefix' => env('DB_TABLE_PREFIX_SERVER'),
    'charset' => 'utf8',
    'enableSchemaCache' => YII_ENV_PROD,
];