<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TransactionDetailsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'transaction_code'  => 'TRX24050001',
                'item_name'         => 'Aaaaaaaa',
                'qty'               => '2',
                'price'             => '1000000',
            ],
            [
                'transaction_code'  => 'TRX24050002',
                'item_name'         => 'Bbbbbbbb',
                'qty'               => '20',
                'price'             => '500000',
            ],
            [
                'transaction_code'  => 'TRX24050002',
                'item_name'         => 'Cccccccc',
                'qty'               => '5',
                'price'             => '300000',
            ],
            [
                'transaction_code'  => 'TRX24050003',
                'item_name'         => 'Dddddddd',
                'qty'               => '10',
                'price'             => '400000',
            ],
            [
                'transaction_code'  => 'TRX24050003',
                'item_name'         => 'Eeeeeeee',
                'qty'               => '80',
                'price'             => '500000',
            ],
        ];

        // Using Query Builder
        $this->db->table('transaction_details')->insertBatch($data);
    }
}
