<?php

use yii\db\Migration;

class m160120_040913_lists_table extends Migration
{
    public function up()
    {
        $this->createTable('lists', [
            'id' => $this->primaryKey(),
            'doctor_id' => $this->integer(),
            'patient_id' => $this->integer(),
            'status' => $this->integer(),
            'date' => $this->date()
        ]);
        $this->addForeignKey('fk_list_user_d_id', 'lists', 'doctor_id', 'user', 'id');
        $this->addForeignKey('fk_list_user_p_id', 'lists', 'patient_id', 'user', 'id');
    }

    public function down()
    {
        $this->dropTable('lists');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
