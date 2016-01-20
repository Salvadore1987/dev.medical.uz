<?php

use yii\db\Migration;

class m160118_103606_create_types extends Migration
{
    public function up()
    {
        $this->createTable('types', [
            'id' => $this->primaryKey(),
            'name' => "ENUM('Patient', 'Doctor') NOT NULL DEFAULT 'Patient'"
        ]);
        $this->insert('types', ['name' => 'Patient']);
        $this->insert('types', ['name' => 'Doctor']);
    }

    public function down()
    {
        $this->dropTable('types');
    }
}
