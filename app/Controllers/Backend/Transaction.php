<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Transaction extends BaseController
{
    public function index()
    {
        $level = session()->get('level');
        if ($level != 'admin' && $level != 'superadmin') {
            return redirect()->back();
        }

        $data = [
            'title' => 'Daftar Transaksi | HFD APP',
            'content_header' => 'Daftar Transaksi',
        ];

        return view('backend/transaction/index', $data);
    }
}
