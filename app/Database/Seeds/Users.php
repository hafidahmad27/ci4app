<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Ahmad Hafid',
                'username' => 'superadmin',
                'password' => password_hash('superadmin', PASSWORD_DEFAULT),
                'level' => 'superadmin'
            ],
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
