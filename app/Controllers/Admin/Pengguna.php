<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pengguna extends BaseController
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
        return view('admin/pengguna');
    }

    public function store(): ResponseInterface
    {
        $data = $this->pengguna->asArray()
            ->select('customer.*, users.username, users.role')
            ->join('customer', 'customer.id_users = users.id_users', 'left')
            ->whereNotIn('users.role', ['admin']) // harus array
            ->findAll();
        return $this->response->setJSON($data);
    }

    public function aktive(): ResponseInterface
    {
        $data = $this->pengguna->where('id_users', session()->get('user_id'))->first();
        return $this->response->setJSON($data);
    }

    function add(): ResponseInterface
    {
        $param = $this->request->getJSON();
        $param->password = password_hash($param->password, PASSWORD_DEFAULT);
        $param->role = 'kasir';
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
