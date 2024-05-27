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
        $role_id = session()->get('role_id');
        if ($role_id != 2 && $role_id != 1) {
            return redirect()->back();
        }

        $data = [
            'title' => 'Daftar Kategori | HFD APP',
            'content_header' => 'Daftar Kategori',
            'categories' => $this->categoryModel->orderBy('id', 'DESC')->findAll()
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
                    'is_unique' => 'Kategori <b>' . $data['category_name'] . '</b> sudah ada! Harap isi dengan kategori lain.',
                ],
            ],
        ]);

        if ($this->validation->run($data)) {
            $this->categoryModel->insert($data);
            return redirect()->back()->with('message_add', '<div class="alert alert-success alert-dismissible fade show" role="alert">Kategori <b>' . $data['category_name'] . '</b> telah ditambahkan <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            return redirect()->back()->with('message_add', '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . implode($this->validation->getErrors()) . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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
                    'is_unique' => 'Kategori <b>' . $data['category_name'] . '</b> sudah ada! Harap isi dengan kategori lain.',
                ],
            ],
        ]);

        if ($this->validation->run($data)) {
            $this->categoryModel->update($id, $data);
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Kategori <b>' . $data['category_name'] . '</b> telah di-update <i class="fas fa-check-circle"></i> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . implode($this->validation->getErrors()) . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $category = $this->categoryModel->find($id);

        if ($this->categoryModel->delete($id)) {
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Kategori <b>' . $category['category_name'] . '</b> telah dihapus <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Kategori <b>' . $category['category_name'] . '</b> tidak dapat dihapus! karena <b>ada</b> dalam <b>Daftar Item</b><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    }
}
