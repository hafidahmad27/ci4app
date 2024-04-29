<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ItemsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'item_name'     => 'HP-14 CM0078AU',
                'price'         => '7500000',
                'description'   => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat nisi ab est reprehenderit similique exercitationem repudiandae necessitatibus rerum magnam blanditiis.',
                'category_id'   => '3',
            ],
            [
                'item_name'     => 'AIO Lenovo V330 Core i3-8100',
                'price'         => '10499000',
                'description'   => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat nisi ab est reprehenderit similique exercitationem repudiandae necessitatibus rerum magnam blanditiis.',
                'category_id'   => '1',
            ],
            [
                'item_name'     => 'ASUS TUF FX505DD R5',
                'price'         => '9500000',
                'description'   => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat nisi ab est reprehenderit similique exercitationem repudiandae necessitatibus rerum magnam blanditiis.',
                'category_id'   => '2',
            ],
            [
                'item_name'     => 'Samsung Galaxy A52s 5G 8/256',
                'price'         => '3799000',
                'description'   => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat nisi ab est reprehenderit similique exercitationem repudiandae necessitatibus rerum magnam blanditiis.',
                'category_id'   => '5',
            ],
            [
                'item_name'     => 'Apple iPad Pro 11',
                'price'         => '11999000',
                'description'   => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat nisi ab est reprehenderit similique exercitationem repudiandae necessitatibus rerum magnam blanditiis.',
                'category_id'   => '4',
            ],
        ];

        // Using Query Builder
        $this->db->table('items')->insertBatch($data);
    }
}
