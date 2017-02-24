<?php

return [
    'class'=>'yii\db\Connection',
    'dsn' => env('DB_DSN_LOCAL'),
    'username' => env('DB_USERNAME_LOCAL'),
    'password' => env('DB_PASSWORD_LOCAL'),
    'tablePrefix' => env('DB_TABLE_PREFIX_LOCAL'),
    'charset' => 'utf8',
    'enableSchemaCache' => YII_ENV_PROD,
];