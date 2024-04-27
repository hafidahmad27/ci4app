<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Report extends BaseController
{
    public function index()
    {
        $level = session()->get('level');
        if ($level != 'pimpinan' && $level != 'superadmin') {
            return redirect()->back();
        }

        $data = [
            'title' => 'Report | HFD APP',
            'content_header' => 'Report'
        ];

        return view('backend/report/index', $data);
    }
}
