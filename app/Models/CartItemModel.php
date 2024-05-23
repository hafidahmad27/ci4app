<?php

namespace App\Models;

use CodeIgniter\Model;

class CartItemModel extends Model
{
    protected $table            = 'cart_items';
    // protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['item_id', 'qty'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;

    // protected array $casts = [];
    // protected array $castHandlers = [];

    // Dates
    // protected $useTimestamps = false;
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

    public function getCartItems()
    {
        $builder = $this->db->table('items')
            ->join('cart_items', 'cart_items.item_id = items.id')
            ->orderBy('cart_items.id', 'DESC');

        $query = $builder->get();
        return $query;
    }

    public function getTotalPrice()
    {
        $builder = $this->db->table('items')->selectSum('(qty * price)', 'total')
            ->join('cart_items', 'cart_items.item_id = items.id');

        $query = $builder->get();

        foreach ($query->getResultArray() as $row) {
            $totalPrice = $row['total'];
        }
        return $totalPrice;
    }

    public function emptyCart()
    {
        $builder = $this->db->table('cart_items')
            ->truncate();

        $query = $builder;
        return $query;
    }
}
