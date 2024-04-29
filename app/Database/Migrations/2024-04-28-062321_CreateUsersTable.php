<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
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
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
