<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kategori extends BaseController
{
    protected $kategori;
    public function __construct() {
        $this->kategori = new \App\Models\KategoriModel();
    }

    public function index(): string
    {
        return view('admin/kategori');
    }

    public function store() 
    {
        return $this->response->setJSON($this->kategori->findAll());
    }

    function add() : ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->kategori->insert($param);
            $param->id_kategori = $this->kategori->insertID();
            return $this->response->setJSON($param);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    function edit() : ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->kategori->update($param->id_kategori, $param);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil diubah'
            ]);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    function delete($id = null) : ResponseInterface
    {
        try {
            $this->kategori->delete($id);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ])->setStatusCode(500);
        }
    }
}
