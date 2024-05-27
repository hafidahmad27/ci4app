<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCartItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'item_id' => [
                'type'       => 'INT',
            ],
            'qty' => [
                'type'       => 'INT',
                'constraint' => '3',
            ],
        ]);
        $this->forge->addForeignKey('item_id', 'items', 'id');
        $this->forge->createTable('cart_items');
    }

    public function down()
    {
        $this->forge->dropTable('cart_items');
    }
}
