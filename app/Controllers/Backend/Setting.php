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
            'table' => $this->userModel->find($id)
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
                    'is_unique' => 'Nama "' . $data['name'] . '" sudah ada. Harap isi dengan Nama lain!'
                ]
            ],
            'username' => [
                'rules' => 'is_unique[users.username,id,' . $id . ']',
                'errors' => [
                    'is_unique' => 'Username "' . $data['username'] . '" sudah ada. Harap isi dengan Username lain!'
                ]
            ],
        ]);

        if ($this->validation->run($data)) {
            session()->set($data);
            $this->userModel->update($id, $data);
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Username berhasil diubah</strong> <i class="fas fa-check-circle"></i></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>' . $this->validation->listErrors() . '</strong></div>');
        }
    }

    public function changePassword()
    {
        $id = session()->get('id');
        $new_password = $this->request->getVar('password');
        $old_password = $this->userModel->find($id);

        $data = [
            'password' => !empty($new_password) ? password_hash($new_password, PASSWORD_DEFAULT) : $old_password['password']
        ];

        session()->set($data);
        $this->userModel->update($id, $data);

        return redirect()->back()->with('message-password', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Password berhasil diubah</strong> <i class="fas fa-check-circle"></i></div>');
    }
}
