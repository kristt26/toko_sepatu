<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kasir extends BaseController
{
    protected $pengguna;
    protected $lib;
    public function __construct()
    {
        $this->pengguna = new \App\Models\UserModel();
        $this->lib = new \App\Libraries\Decode();
    }

    public function index(): string
    {
        return view('admin/kasir');
    }

    public function store(): ResponseInterface
    {
        $data = $this->pengguna->asArray()
            ->whereNotIn('users.role', ['customer'])
            ->findAll();
        return $this->response->setJSON($data);
    }

    function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        $param->password = password_hash($param->password, PASSWORD_DEFAULT);
        try {
            $this->pengguna->insert($param);
            $param->id_users = $this->pengguna->insertID();
            return $this->response->setJSON($param);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}
