<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
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
            ],
        ]);
        $this->forge->addForeignKey('category_id', 'categories', 'id');
        $this->forge->createTable('items');
    }

    public function down()
    {
        $this->forge->dropTable('items');
    }
}
