<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoryModel;

class Category extends BaseController
{
    protected $categoryModel, $validation;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $level = session()->get('level');
        if ($level != 'admin' && $level != 'superadmin') {
            return redirect()->back();
        }

        $data = [
            'title' => 'Daftar Kategori | HFD APP',
            'content_header' => 'Daftar Kategori',
            'table' => $this->categoryModel->findAll()
        ];

        return view('backend/category/index', $data);
    }

    public function insert()
    {
        $data = [
            'category_name' => $this->request->getPost('category_name')
        ];

        $this->validation->setRules([
            'category_name' => [
                'rules'  => 'is_unique[categories.category_name]',
                'errors' => [
                    'is_unique' => 'Kategori "' . $data['category_name'] . '" sudah ada. Harap isi dengan kategori lain!',
                ],
            ],
        ]);

        if ($this->validation->run($data)) {
            $this->categoryModel->insert($data);
            return redirect()->back()->with('message_add', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Kategori "' . $data['category_name'] . '" telah ditambahkan</strong> <i class="fas fa-check-circle"></i></div>');
        } else {
            return redirect()->back()->with('message_add', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>' . implode($this->validation->getErrors()) . '</strong></div>');
        }
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $data = [
            'category_name' => $this->request->getPost('category_name')
        ];

        $this->validation->setRules([
            'category_name' => [
                'rules'  => 'is_unique[categories.category_name,id,' . $id . ']',
                'errors' => [
                    'is_unique' => 'Kategori "' . $data['category_name'] . '" sudah ada. Harap isi dengan kategori lain!',
                ],
            ],
        ]);

        if ($this->validation->run($data)) {
            $this->categoryModel->update($id, $data);
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Nama Kategori di-update menjadi "' . $data['category_name'] . '" </strong> <i class="fas fa-check-circle"></i></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>' . implode($this->validation->getErrors()) . '</strong></div>');
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $table = $this->categoryModel->find($id);

        if ($this->categoryModel->delete($id)) {
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Kategori "' . $table['category_name'] . '" telah dihapus</strong> <i class="fas fa-check-circle"></i></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Kategori "' . $table['category_name'] . '" tidak dapat dihapus, karena masih terikat dengan tabel lain!</strong></div>');
        }
    }
}
