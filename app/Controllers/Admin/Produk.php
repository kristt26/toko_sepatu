<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Produk extends BaseController
{
    protected $produk;
    public function __construct() {
        $this->produk = \App\Models\ProdukModel::class;
    }
    public function index(): string
    {
        return view('admin/beranda');
    }

    public function store() : ResponseInterface
    {
        $data = [
            'status' => 'success',
            'message' => 'Data berhasil disimpan',
            'data' => $this->produk->findAll()
        ];
        return $this->response->setJSON($data);
        
    }
}
