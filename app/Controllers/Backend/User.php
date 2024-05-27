<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\RoleModel;
use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel, $roleModel, $validation;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $role_id = session()->get('role_id');
        if ($role_id != 1) {
            return redirect()->back();
        }

        $data = [
            'title' => 'Daftar User | HFD APP',
            'content_header' => 'Daftar User',
            'users' => $this->userModel->select('users.id, name, username, password, is_active, role_id, role_name')->join('roles', 'users.role_id = roles.id')->findAll(),
            'role_options' => $this->roleModel->where('id != 1')->findAll()
        ];

        return view('backend/user/index', $data);
    }

    public function insert()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getVar('username'), PASSWORD_DEFAULT),
            'role_id' => $this->request->getPost('role_id')
        ];

        $this->validation->setRules([
            'name' => [
                'rules' => 'is_unique[users.name]',
                'errors' => [
                    'is_unique' => 'Nama "' . $data['name'] . '" sudah ada! Harap isi dengan nama lain.'
                ]
            ],
            'username' => [
                'rules' => 'is_unique[users.username]',
                'errors' => [
                    'is_unique' => 'Username "' . $data['username'] . '" sudah ada! Harap isi dengan username lain.'
                ]
            ],
        ]);

        if ($this->validation->run($data)) {
            $this->userModel->insert($data);
            return redirect()->back()->with('message_add', '<div class="alert alert-success alert-dismissible fade show" role="alert">User <b>' . $data['name'] . '</b> telah ditambahkan <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            return redirect()->back()->with('message_add', '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $this->validation->listErrors() . '</b><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'role_id' => $this->request->getPost('role_id')
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
            $this->userModel->update($id, $data);
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">User <b>' . $data['name'] . '</b> telah di-update</b> <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $this->validation->listErrors() . '</b><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    }

    public function getEditById()
    {
        $id = $this->request->getPost('id');
        $user = $this->userModel->select('users.id, name, username, password, is_active, role_id, role_name')->join('roles', 'users.role_id = roles.id')->find($id);

        return json_encode($user);
    }

    public function resetPassword()
    {
        $id = $this->request->getPost('id');
        $user = $this->userModel->find($id);
        $default_password = password_hash($user['username'], PASSWORD_DEFAULT);

        $this->userModel->update($id, ['password' => $default_password]);
        return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Password <b>' . $user['name'] . '</b> telah di-reset</b> <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    public function userStatus()
    {
        $id = $this->request->getPost('id');
        $user = $this->userModel->find($id);

        if ($user['is_active'] == 1) {
            $is_active = 0;
        } else {
            $is_active = 1;
        }
        $this->userModel->update($id, ['is_active' => $is_active]);

        if ($user['is_active'] == 1) {
            return redirect()->back()->with('message', '<div class="alert alert-dark alert-dismissible fade show" role="alert">User <b>' . $user['name'] . '</b> telah dinonaktifkan</.b> <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-light alert-dismissible fade show" role="alert">User <b>' . $user['name'] . '</b> telah diaktifkan</b> <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $user = $this->userModel->find($id);

        $this->userModel->delete($id);
        return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">User <b>' . $user['username'] . '</b> telah dihapus</b> <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
}
