<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Ahmad Hafid',
                'username' => 'superadmin',
                'password' => password_hash('superadmin', PASSWORD_DEFAULT),
                'role_id' => '1'
            ],
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
