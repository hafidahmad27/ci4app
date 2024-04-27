<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Login Halaman Admin | HFD APP'
        ];

        return view('backend/login', $data);
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getVar('password');
        $user = $this->userModel->where(['username' => $username])->first();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'username' => $user['username'],
                        'password' => $user['password'],
                        'level' => $user['level']
                    ];
                    session()->set($data);
                    return redirect()->route('backend.dashboard.view');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Password salah!');
                }
            } else {
                return redirect()->back()->with('error', 'User "' . $user['username'] . '" tidak aktif!');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak ditemukan!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
