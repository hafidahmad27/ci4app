<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'transaction_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '11',
            ],
            'transaction_date' => [
                'type'       => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'total' => [
                'type'       => 'INT',
                'constraint' => '9',
            ],
        ]);
        $this->forge->addPrimaryKey('transaction_code');
        $this->forge->createTable('transactions');
    }

    public function down()
    {
        $this->forge->dropTable('transactions');
    }
}
