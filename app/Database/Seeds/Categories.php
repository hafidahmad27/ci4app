<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Categories extends Seeder
{
    public function run()
    {
        $data = [
            [
                'category_name' => 'Computer',
            ],
            [
                'category_name' => 'Laptop',
            ],
            [
                'category_name' => 'Notebook',
            ],
            [
                'category_name' => 'Tablet',
            ],
            [
                'category_name' => 'Smartphone',
            ],
        ];

        // Using Query Builder
        $this->db->table('categories')->insertBatch($data);
    }
}
