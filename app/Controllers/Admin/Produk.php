<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Produk extends BaseController
{
    protected $produk;
    protected $lib;
    public function __construct() {
        $this->produk = new \App\Models\ProdukModel();
        $this->lib = new \App\Libraries\Decode();
        
    }

    public function index(): string
    {
        return view('admin/produk');
    }

    public function store() 
    {
        $data = $this->produk->select("produk.*, (SELECT SUM(variant.stok) FROM variant WHERE variant.id_produk = produk.id_produk) AS totalStok, (SELECT COUNT(*) FROM variant WHERE variant.id_produk = produk.id_produk) AS countStok")->findAll();
        return $this->response->setJSON($data);
    }

    function add() : ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->produk->insert($param);
            $param->id_produk = $this->produk->insertID();
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
            $this->produk->update($param->id_produk, $param);
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
            $this->produk->delete($id);
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
