<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Additem extends Migration
{
    public function up()
    {
        $this->forge->addField([
            //Essentials
            'id' => ['type' => 'INT','constraint' => 11,'auto_increment' => TRUE,],
            'uuid' => ['type' => 'VARCHAR','constraint' => 255,],
            'umkm' => ['type' => 'VARCHAR','constraint' => 255,'null' => TRUE,],
            'category' => ['type' => 'ENUM','constraint' => ['makanan', 'minuman', 'undefined'],'default' => 'undefined',],
            'name_item' => ['type' => 'VARCHAR','constraint' => 255, 'null' => TRUE],
            'img' => ['type' => 'VARCHAR','constraint' => 255,'null' => TRUE,],
            'stock' => ['type' => 'INT','constraint' => 11,'null' => TRUE,],
            'price' => ['type' => 'VARCHAR','constraint' => 255,'null' => TRUE,],
            'description' => ['type' => 'VARCHAR','constraint' => 255,'null' => TRUE,],
            // Timestamps			
            'created_at' => ['type' => 'DATETIME','null' => TRUE,],
            'updated_at' => ['type' => 'DATETIME','null' => TRUE,],
            'deleted_at' => ['type' => 'DATETIME','null' => TRUE,],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('items');
    }

    public function down()
    {
        //
        $this->forge->dropTable('items');
    }
}
