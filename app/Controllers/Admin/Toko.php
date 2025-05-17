<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Toko extends BaseController
{
    protected $toko;
    protected $lib;
    public function __construct() {
        $this->toko = new \App\Models\TokoModel();
        $this->lib = new \App\Libraries\Decode();
    }

    public function index(): string
    {
        return view('admin/toko');
    }

    public function store() 
    {
        return $this->response->setJSON($this->toko->first());
    }

    function add() : ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $param->logo = $this->lib->decodebase64($param->berkas->base64);
            $this->toko->insert($param);
            $param->id_toko = $this->toko->insertID();
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
            $param->logo = isset($param->berkas) ?  $this->lib->decodebase64($param->berkas->base64, $param->logo) : $param->logo;
            $this->toko->update($param->id_toko, $param);
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
            $this->toko->delete($id);
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
