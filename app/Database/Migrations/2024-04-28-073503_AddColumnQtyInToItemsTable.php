<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnQtyInToItemsTable extends Migration
{
    public function up()
    {
        $fields = [
            'qty_in' => [
                'type' => 'INT',
                'after' => 'description',
            ],
        ];
        // $this->forge->addColumn('items', $fields);
    }

    public function down()
    {
        // $this->forge->dropColumn('items', 'qty_in');
    }
}
