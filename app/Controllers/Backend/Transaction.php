<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Models\ItemModel;
use App\Models\CartItemModel;

class Transaction extends BaseController
{
    protected $transactionModel, $transactionDetailModel, $itemModel, $cartItemModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->transactionDetailModel = new TransactionDetailModel();
        $this->itemModel = new ItemModel();
        $this->cartItemModel = new CartItemModel();
    }

    public function index()
    {
        $level = session()->get('level');
        if ($level != 'admin' && $level != 'superadmin') {
            return redirect()->back();
        }

        $data = [
            'title' => 'Form Transaksi | HFD APP',
            'display_transaction_code' => $this->transactionModel->generateTransactionCode(),
            'item_options' => $this->itemModel->findAll(),
            'cart_items' => $this->cartItemModel->getCartItems()->getResultArray(),
            'display_total_price' => $this->cartItemModel->getTotalPrice()
        ];

        return view('backend/transaction/index', $data);
    }

    public function addToCart()
    {
        $data_input = [
            'item_id' => $this->request->getPost('item_id'),
            'qty' => $this->request->getPost('qty')
        ];

        $cartItems = $this->cartItemModel->where('item_id', $data_input['item_id'])->findAll();
        foreach ($cartItems as $cartItem) {
            $data_get = [
                'id' => $cartItem['id'],
                'item_id' => $cartItem['item_id'],
                'qty' => $cartItem['qty']
            ];
        }
        if ($cartItems) {
            $id = $data_get['id'];
            $data = [
                'qty' => $data_get['qty'] + $data_input['qty']
            ];
            $this->cartItemModel->update($id, $data);
        } else {
            $this->cartItemModel->insert($data_input);
        }

        return redirect()->back();
    }

    public function updateCart()
    {
        $id = $this->request->getPost('id');

        $data = [
            'qty' => $this->request->getPost('qty_edit')
        ];

        $this->cartItemModel->update($id, $data);
        return redirect()->back();
    }

    public function getEditCartItemById()
    {
        $id = $this->request->getPost('id');
        $cartItem = $this->cartItemModel->select('cart_items.id, item_name, qty')->join('items', 'cart_items.item_id = items.id')->find($id);

        return json_encode($cartItem);
    }

    public function deleteFromCart()
    {
        $id = $this->request->getPost('id');

        $this->cartItemModel->delete($id);
        return redirect()->back();
    }

    public function insert()
    {
        $transaction_data = [
            'transaction_code' => $this->request->getPost('transaction_code'),
            'total' => $this->cartItemModel->getTotalPrice()
        ];
        $this->transactionModel->insert($transaction_data);

        $storeCartItems = $this->cartItemModel->join('items', 'cart_items.item_id = items.id')->get()->getResultArray();
        foreach ($storeCartItems as $storeCartItem) {
            $transaction_detail_data[] = [
                'transaction_code' => $transaction_data['transaction_code'],
                'item_name' => $storeCartItem['item_name'],
                'qty' => $storeCartItem['qty'],
                'price' => $storeCartItem['price']
            ];
        }
        $this->transactionDetailModel->insertBatch($transaction_detail_data);

        $this->cartItemModel->emptyCart();

        return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show float-right" role="alert"><strong>Transaksi sukses</strong> <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    public function lists()
    {
        $data = [
            'title' => 'Daftar Transaksi | HFD APP',
            'content_header' => 'Daftar Transaksi',
            'transactions' => $this->transactionModel->orderBy('transaction_date', 'DESC')->findAll()
        ];

        return view('backend/transaction/lists', $data);
    }

    public function list_details($transaction_code)
    {
        $data = [
            'title' => 'Detail Transaksi | HFD APP',
            'content_header' => 'Detail Transaksi',
            'transactions' => $this->transactionModel->where('transaction_code', $transaction_code)->findAll(),
            'transaction_details' => $this->transactionDetailModel->where('transaction_code', $transaction_code)->findAll()
        ];
        return view('backend/transaction/list_details', $data);
    }
}
