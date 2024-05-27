<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role_name' => 'superadmin',
            ],
            [
                'role_name' => 'admin',
            ],
            [
                'role_name' => 'pimpinan',
            ],
        ];

        // Using Query Builder
        $this->db->table('roles')->insertBatch($data);
    }
}
