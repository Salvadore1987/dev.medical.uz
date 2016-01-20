<?php

use yii\db\Migration;

class m160118_103612_create_user extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer(),
            'username' => $this->string(50)->notNull(),
            'password' => $this->string(255)->notNull(),
            'email' => $this->string(100)->notNull()->unique(),
            'auth_key' => $this->string(100),
            'access_token' => $this->string(255)
        ]);
        $this->createIndex('ix_user_email', 'user', 'email');
        $this->addForeignKey('fk_user_type', 'user', 'type_id', 'types', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
