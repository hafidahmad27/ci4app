<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table            = 'transactions';
    // protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['transaction_code', 'transaction_date', 'total'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;

    // protected array $casts = [];
    // protected array $castHandlers = [];

    // Dates
    // protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];

    public function generateTransactionCode()
    {
        $builder = $this->db->table('transactions')
            ->selectMax('transaction_code', 'tr_code');

        $query = $builder->get()->getResultArray();

        $kd = '';
        if ($query > 0) {
            foreach ($query as $ck) {
                $ambilKode = substr($ck['tr_code'], -4);
                $counter = intval($ambilKode) + 1;
                $kd = sprintf('%04s', $counter);
            }
        } else {
            $kd = '0001';
        }
        return 'TRX' . substr(date('Ym'), -4) . $kd;
    }
}
