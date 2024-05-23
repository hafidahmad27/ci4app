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
            'items' => $this->itemModel->getItems()->getResultArray(),
            'category_options' => $this->categoryModel->findAll()
        ];

        return view('backend/item/index', $data);
    }

    public function form_add()
    {
        $data = [
            'title' => 'Form Tambah Item | HFD APP',
            'category_options' => $this->categoryModel->findAll(),
            'items' => $this->itemModel->findAll()
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
                    'is_unique' => 'Item <b>' . $data['item_name'] . '</b> sudah ada! Harap isi dengan item lain.',
                ],
            ],
        ]);

        if ($this->validation->run($data)) {
            $this->itemModel->insert($data);
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Item <b>' . $data['item_name'] . '</b> telah ditambahkan <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . implode($this->validation->getErrors()) . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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
                    'is_unique' => 'Item <b>' . $data['item_name'] . '</b> sudah ada! Harap isi dengan item lain.',
                ],
            ],
        ]);

        if ($this->validation->run($data)) {
            $this->itemModel->update($id, $data);
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">Item <b>' . $data['item_name'] . '</b> telah di-update</b> <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">' . implode($this->validation->getErrors()) . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    }

    public function getEditById()
    {
        $id = $this->request->getPost('id');
        $item = $this->itemModel->find($id);

        return json_encode($item);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $item = $this->itemModel->find($id);

        if ($this->itemModel->delete($id)) {
            return redirect()->back()->with('message', '<div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">Item <b>' . $item['item_name'] . '</b> telah dihapus <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            return redirect()->back()->with('message', '<div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">Item <b>' . $item['item_name'] . '</b> tidak dapat dihapus! karena <b>ada</b> dalam <b>Keranjang Item</b><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    }
}
