<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Area extends BaseController
{
    protected $area;
    public function __construct() {
        $this->area = new \App\Models\AreaModel();
        
    }

    public function index(): string
    {
        return view('admin/area');
    }

    public function store() 
    {
        return $this->response->setJSON($this->area->findAll());
    }

    function add() : ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->area->insert($param);
            $param->id_area = $this->area->insertID();
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
            $this->area->update($param->id_area, $param);
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
            $this->area->delete($id);
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
