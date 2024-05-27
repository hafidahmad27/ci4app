<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Setting extends BaseController
{
    protected $userModel, $validation;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $id = session()->get('id');

        $data = [
            'title' => 'Settings | HFD APP',
            'content_header' => 'Settings',
            'user' => $this->userModel->select('users.id, name, username, password, role_id, role_name')->join('roles', 'users.role_id = roles.id')->find($id)
        ];

        return view('backend/setting/index', $data);
    }

    public function changeProfil()
    {
        $id = session()->get('id');

        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username')
        ];

        $this->validation->setRules([
            'name' => [
                'rules' => 'is_unique[users.name,id,' . $id . ']',
                'errors' => [
                    'is_unique' => 'Nama "' . $data['name'] . '" sudah ada! Harap isi dengan nama lain.'
                ]
            ],
            'username' => [
                'rules' => 'is_unique[users.username,id,' . $id . ']',
                'errors' => [
                    'is_unique' => 'Username "' . $data['username'] . '" sudah ada! Harap isi dengan username lain.'
                ]
            ],
        ]);

        if ($this->validation->run($data)) {
            session()->set($data);
            $this->userModel->update($id, $data);
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Username berhasil diubah <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $this->validation->listErrors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    }

    public function changePassword()
    {
        $id = session()->get('id');
        $input_password_old = $this->request->getVar('password_old');
        $old_password = $this->userModel->find($id);
        $new_password = $this->request->getVar('password_new');

        if (password_verify($input_password_old, $old_password['password'])) {
            $data = [
                'password' => password_hash($new_password, PASSWORD_DEFAULT)
            ];
            session()->set($data);
            $this->userModel->update($id, $data);
            return redirect()->back()->with('message-password', '<div class="alert alert-success alert-dismissible fade show" role="alert">Password berhasil diubah <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            return redirect()->back()->with('message-password', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><b>Password lama tidak benar</b> <i class="fas fa-exclamation-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    }
}
