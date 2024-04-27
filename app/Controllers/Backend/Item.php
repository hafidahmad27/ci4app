<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoryModel;
use App\Models\ItemModel;

class Item extends BaseController
{
    protected $itemModel, $categoryModel, $validation;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
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
            'title' => 'Daftar Item | HFD APP',
            'content_header' => 'Daftar Item',
            'relations' => $this->itemModel->getItems()->getResultArray(),
            'options' => $this->categoryModel->findAll()
        ];

        return view('backend/item/index', $data);
    }

    public function form_add()
    {
        $data = [
            'title' => 'Form Tambah Item | HFD APP',
            // 'content_header' => 'Form Tambah Item',
            'options' => $this->categoryModel->findAll(),
            'table' => $this->itemModel->findAll()
        ];

        return view('backend/item/form_add', $data);
    }

    public function insert()
    {
        $data = [
            'item_name' => $this->request->getPost('item_name'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
            'category_id' => $this->request->getPost('category_id')
        ];

        $this->validation->setRules([
            'item_name' => [
                'rules'  => 'is_unique[items.item_name]',
                'errors' => [
                    'is_unique' => 'Item "' . $data['item_name'] . '" sudah ada. Harap isi dengan item lain!',
                ],
            ],
        ]);

        if ($this->validation->run($data)) {
            $this->itemModel->insert($data);
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Item "' . $data['item_name'] . '" telah ditambahkan</strong> <i class="fas fa-check-circle"></i></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>' . implode($this->validation->getErrors()) . '</strong></div>');
        }
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $data = [
            'item_name' => $this->request->getPost('item_name'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
            'category_id' => $this->request->getPost('category_id')
        ];

        $this->validation->setRules([
            'item_name' => [
                'rules'  => 'is_unique[items.item_name,id,' . $id . ']',
                'errors' => [
                    'is_unique' => 'Item "' . $data['item_name'] . '" sudah ada. Harap isi dengan item lain!',
                ],
            ],
        ]);

        if ($this->validation->run($data)) {
            $this->itemModel->update($id, $data);
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert"><strong>Item "' . $data['item_name'] . '" telah di-update</strong> <i class="fas fa-check-circle"></i></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert"><strong>' . implode($this->validation->getErrors()) . '</strong></div>');
        }
    }

    public function getEditById()
    {
        $id = $this->request->getPost('id');
        $relations = $this->itemModel->where(['id' => $id])->get()->getRowArray();

        return json_encode($relations);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $relations = $this->itemModel->where(['id' => $id])->get()->getRowArray();

        $this->itemModel->delete($id);
        return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert"><strong>Item "' . $relations['item_name'] . '" telah dihapus</strong> <i class="fas fa-check-circle"></i></div>');
    }
}
