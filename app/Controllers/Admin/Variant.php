<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Variant extends BaseController
{
    protected $variant;
    protected $lib;
    public function __construct() {
        $this->variant = new \App\Models\VariantModel();
        $this->lib = new \App\Libraries\Decode();
        
    }

    public function store($id_produk = null) 
    {
        $data = $this->variant->select("variant.*, (SELECT COUNT(*) FROM pembelian where variant.id_variant=pembelian.id_pembelian) as countPembelian")
        ->where('id_produk', $id_produk)->findAll();
        return $this->response->setJSON($data ?? []);
    }

    function add() : ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $param->gambar = $this->lib->decodebase64($param->berkas->base64);
            $this->variant->insert($param);
            $param->id_variant = $this->variant->insertID();
            return $this->response->setJSON($param);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ])->setStatusCode(500);
        }
    }

    function edit() : ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $param->gambar = isset($param->berkas) && !empty($param->berkas->base64) ? $this->lib->decodebase64($param->berkas->base64, $param->gambar) : $param->gambar;
            $this->variant->update($param->id_variant, $param);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil diubah'
            ]);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ])->setStatusCode(500);
        }
    }

    function delete($id = null) : ResponseInterface
    {
        try {
            $this->variant->delete($id);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}
