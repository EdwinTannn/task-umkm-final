<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Adduser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            //Essentials
            'id' => ['type' => 'INT','constraint' => 11,'auto_increment' => TRUE,],
            'email' => ['type' => 'VARCHAR','constraint' => 255,'UNIQUE' => TRUE,],
            'role' => ['type' => 'ENUM','constraint' => ['admin', 'member', 'undefined'],'default' => 'undefined',],
            'umkm' => ['type' => 'VARCHAR','constraint' => 255, 'default' => 'undefined',],
            'is_active' => ['type' => 'INT','constraint' => 11, 'default' => 0],
            'password' => ['type' => 'VARCHAR','constraint' => 255,'null' => TRUE,],
            // Timestamps			
            'created_at' => ['type' => 'TIMESTAMP','null' => TRUE, 'default' => 'CURRENT_TIMESTAMP',],
            'updated_at' => ['type' => 'TIMESTAMP','null' => TRUE, 'default' => 'CURRENT_TIMESTAMP',],
            'deleted_at' => ['type' => 'TIMESTAMP','null' => TRUE, 'default' => 'CURRENT_TIMESTAMP',],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        //
        $this->forge->dropTable('users');
    }
}
