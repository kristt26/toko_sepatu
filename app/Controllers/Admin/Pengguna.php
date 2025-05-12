<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pengguna extends BaseController
{
    protected $pengguna;
    protected $lib;
    public function __construct() {
        $this->pengguna = new \App\Models\UserModel();
        $this->lib = new \App\Libraries\Decode();
    }

    public function index(): string
    {
        $data['pengguna'] = $this->pengguna->asArray()->select('customer.*, users.username')
        ->join('customer', 'customer.id_users = users.id_users')
        ->where('role', 'customer')->findAll();
        return view('admin/pengguna', $data);
    }
}
