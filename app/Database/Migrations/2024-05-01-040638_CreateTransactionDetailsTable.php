<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionDetailsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'transaction_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '11',
            ],
            'item_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'qty' => [
                'type'       => 'INT',
                'constraint' => '3',
            ],
            'price' => [
                'type'       => 'INT',
                'constraint' => '9',
            ],
        ]);
        $this->forge->addForeignKey('transaction_code', 'transactions', 'transaction_code');
        $this->forge->createTable('transaction_details');
    }

    public function down()
    {
        $this->forge->dropTable('transaction_details');
    }
}
