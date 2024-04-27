<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel, $validation;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $level = session()->get('level');
        if ($level != 'superadmin') {
            return redirect()->back();
        }

        $data = [
            'title' => 'Daftar User | HFD APP',
            'content_header' => 'Daftar User',
            'table' => $this->userModel->findAll()
        ];

        return view('backend/user/index', $data);
    }

    public function insert()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getVar('username'), PASSWORD_DEFAULT),
            'level' => $this->request->getPost('level')
        ];

        $this->validation->setRules([
            'name' => [
                'rules' => 'is_unique[users.name]',
                'errors' => [
                    'is_unique' => 'Nama "' . $data['name'] . '" sudah ada. Harap isi dengan Nama lain!'
                ]
            ],
            'username' => [
                'rules' => 'is_unique[users.username]',
                'errors' => [
                    'is_unique' => 'Username "' . $data['username'] . '" sudah ada. Harap isi dengan username lain!'
                ]
            ],
        ]);

        if ($this->validation->run($data)) {
            $this->userModel->insert($data);
            return redirect()->back()->with('message_add', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>User "' . $data['name'] . '" telah ditambahkan</strong> <i class="fas fa-check-circle"></i></div>');
        } else {
            return redirect()->back()->with('message_add', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>' . $this->validation->listErrors() . '</strong></div>');
        }
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'level' => $this->request->getPost('level')
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
            $this->userModel->update($id, $data);
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>User "' . $data['name'] . '" telah di-update</strong> <i class="fas fa-check-circle"></i></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>' . $this->validation->listErrors() . '</strong></div>');
        }
    }

    public function getEditById()
    {
        $id = $this->request->getPost('id');
        $table = $this->userModel->find($id);

        return json_encode($table);
    }

    public function resetPassword()
    {
        $id = $this->request->getPost('id');
        $table = $this->userModel->find($id);
        $default_password = password_hash($table['username'], PASSWORD_DEFAULT);

        $this->userModel->update($id, ['password' => $default_password]);
        return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Password "' . $table['name'] . '" telah di-reset</strong> <i class="fas fa-check-circle"></i></div>');
    }

    public function userStatus()
    {
        $id = $this->request->getPost('id');
        $table = $this->userModel->find($id);

        if ($table['is_active'] == 1) {
            $is_active = 0;
        } else {
            $is_active = 1;
        }
        $this->userModel->update($id, ['is_active' => $is_active]);

        if ($table['is_active'] == 1) {
            return redirect()->back()->with('message', '<div class="alert alert-info alert-info2 alert-dismissible fade show" role="alert"><strong>User "' . $table['name'] . '" telah dinonaktifkan</strong> <i class="fas fa-check-circle"></i></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>User "' . $table['name'] . '" telah diaktifkan</strong> <i class="fas fa-check-circle"></i></div>');
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $table = $this->userModel->find($id);

        $this->userModel->delete($id);
        return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>User "' . $table['username'] . '" telah dihapus</strong> <i class="fas fa-check-circle"></i></div>');
    }
}
