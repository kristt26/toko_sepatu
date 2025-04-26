<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_users';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'password', 'role'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    public function findByUsernameOrEmail($login)
    {
        // Cari sebagai username
        $user = $this->where('username', $login)->first();

        if ($user) {
            return $user;
        }

        // Jika tidak ditemukan, cari sebagai email melalui user_info
        $db = \Config\Database::connect();
        $builder = $db->table('user_info');
        $userInfo = $builder->where('email', $login)->get()->getRowArray();

        if ($userInfo) {
            return $this->find($userInfo['id_users']);
        }

        return null;
    }
}
