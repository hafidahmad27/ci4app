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
        $user = $this->userModel->select('users.id, name, username, password, role_id, is_active, role_name')->join('roles', 'users.role_id = roles.id')->where('username', $username)->first();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'username' => $user['username'],
                        'password' => $user['password'],
                        'role_id' => $user['role_id'],
                        'role_name' => $user['role_name']
                    ];
                    session()->set($data);
                    return redirect()->route('backend.dashboard.view');
                } else {
                    return redirect()->back()->withInput()->with('error', '<b>Password salah!</b>');
                }
            } else {
                return redirect()->back()->with('error', 'User <b>' . $user['username'] . '</b> tidak aktif!');
            }
        } else {
            return redirect()->back()->with('error', '<b>Username tidak ditemukan!</b>');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
