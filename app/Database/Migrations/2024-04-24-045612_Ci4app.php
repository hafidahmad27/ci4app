<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ci4app extends Migration
{
    public function up()
    {
        /**
         * 1. Table Categories
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'category_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('categories');

        /**
         * 2. Table Items
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'item_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'price' => [
                'type'       => 'INT',
                'constraint' => '9',
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'category_id' => [
                'type'       => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('category_id', 'categories', 'id');
        $this->forge->createTable('items');

        /**
         * 3. Table Users
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
            'password' => [
                'type'       => 'CHAR',
                'constraint' => '60',
            ],
            'level' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'is_active' => [
                'type'       => 'BOOLEAN',
                'default'    => '1',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
        $this->forge->dropTable('items');
        $this->forge->dropTable('users');
    }
}
