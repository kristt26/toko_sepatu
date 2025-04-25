<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pembelian extends BaseController
{
    protected $pembelian;
    protected $variant;
    protected $produk;
    protected $conn;
    public function __construct() {
        $this->pembelian = new \App\Models\PembelianModel();
        $this->variant = new \App\Models\VariantModel();
        $this->produk = new \App\Models\ProdukModel();
        $this->conn = \Config\Database::connect();
    }

    public function index(): string
    {
        return view('admin/pembelian');
    }

    public function store() 
    {
        $data['pembelian'] = $this->pembelian->select('pembelian.*, produk.nama_produk, variant.ukuran, variant.warna, variant.id_produk, variant.stok')
            ->join('variant', 'variant.id_variant = pembelian.id_variant')
            ->join('produk', 'produk.id_produk = variant.id_produk')
            ->orderBy('id_pembelian', 'DESC')->findAll() ?? [];
        $data['produks'] = $this->produk->findAll();
        $variant = $this->variant->findAll();
        foreach ($data['produks'] as $key => $value) {
            $value->variant = [];
            foreach ($variant as $key1 => $value1) {
                if ($value->id_produk == $value1->id_produk) {
                    $value->variant[] = $value1;
                }
            }
        }
        return $this->response->setJSON($data);
    }

    function add() : ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->conn->transException(true)->transStart();
            $variant = $this->variant->find($param->id_variant);
            $this->variant->update($param->id_variant, [
                'stok' => $variant->stok + $param->qty
            ]);
            $this->pembelian->insert($param);
            $param->id_pembelian = $this->pembelian->insertID();
            $this->conn->transComplete();
            return $this->response->setJSON($param);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'Gagal simpan data',
                'message' => $th->getMessage()
            ])->setStatusCode(500);
        }
    }

    function edit() : ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->conn->transException(true)->transStart();
            $variant = $this->variant->find($param->id_variant);  
            $item = $this->pembelian->find($param->id_pembelian);  
            $this->variant->update($param->id_variant, [
                'stok' => $variant->stok - $item->qty + $param->qty
            ]);
            $this->pembelian->update($param->id_pembelian, $param);
            $this->conn->transComplete();
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil diubah'
            ]);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ])->setStatusCode(401);
        }
    }

    function delete($id = null) : ResponseInterface
    {
        try {
            $this->conn->transException(true)->transStart();
            $item = $this->pembelian->find($id);
            $variant = $this->variant->find($item->id_variant);
            $this->variant->update($item->id_variant, [
                'stok' => $variant->stok - $item->qty
            ]);
            $this->pembelian->delete($id);
            $this->conn->transComplete();
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
