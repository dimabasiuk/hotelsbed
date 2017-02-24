<?php

use yii\db\Migration;
use app\models\User;

class m170211_135004_users extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(32),
            'auth_key' => $this->string(32)->notNull(),
            'access_token' => $this->string(40)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'oauth_client' => $this->string(),
            'oauth_client_user_id' => $this->string(),
            'email' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(User::STATUS_ACTIVE),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'logged_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('{{%user_profile}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'firstname' => $this->string(),
            'middlename' => $this->string(),
            'lastname' => $this->string(),
            'avatar_path' => $this->string(),
            'avatar_base_url' => $this->string(),
            'country' => $this->integer(),
            'city' => $this->integer(),
            'tel' => $this->string(18),
            'locale' => $this->string(32)->notNull(),
            'gender' => $this->smallInteger(1)
        ], $tableOptions);

        $this->createTable('{{%user_token}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'token' => $this->string(40)->notNull(),
            'expire_at' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->createIndex('idx_user', '{{%user_profile}}', 'user_id');
        $this->addForeignKey('fk_user', '{{%user_profile}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');

        $this->createIndex('idx_user_token', '{{%user_token}}', 'user_id');
        $this->addForeignKey('fk_user_token', '{{%user_token}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('fk_user', '{{%user_profile}}');
        $this->dropForeignKey('fk_user_token', '{{%user_token}}');
        $this->dropIndex('idx_user', '{{%user_profile}}');
        $this->dropIndex('idx_user_token', '{{%user_token}}');
        $this->dropTable('{{%user_profile}}');
        $this->dropTable('{{%user_token}}');
        $this->dropTable('{{%user}}');
    }
}
