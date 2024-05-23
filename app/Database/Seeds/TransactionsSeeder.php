<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TransactionsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'transaction_code'  => 'TRX24050001',
                'total'             => '999999999',
            ],
            [
                'transaction_code'  => 'TRX24050002',
                'total'             => '100000000',
            ],
            [
                'transaction_code'  => 'TRX24050003',
                'total'             => '450000000',
            ],
        ];

        // Using Query Builder
        $this->db->table('transactions')->insertBatch($data);
    }
}
