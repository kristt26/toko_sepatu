<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'order';
    protected $primaryKey       = 'id_order';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_customer','id_area', 'kode_order', 'tanggal_order', 'status', 'total', 'alamat_pengiriman'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
