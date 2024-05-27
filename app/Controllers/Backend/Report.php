<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Report extends BaseController
{
    public function a_reports()
    {
        $role_id = session()->get('role_id');
        if ($role_id != 3 && $role_id != 1) {
            return redirect()->back();
        }

        $data = [
            'title' => 'Report A | HFD APP',
            'content_header' => 'Report A'
        ];

        return view('backend/report/a_reports', $data);
    }

    public function b_reports()
    {
        $role_id = session()->get('role_id');
        if ($role_id != 3 && $role_id != 1) {
            return redirect()->back();
        }

        $data = [
            'title' => 'Report B | HFD APP',
            'content_header' => 'Report B'
        ];

        return view('backend/report/b_reports', $data);
    }
}
