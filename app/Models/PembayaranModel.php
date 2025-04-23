<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table            = 'pembayaran';
    protected $primaryKey       = 'id_pembayaran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_order','metode_bayar', 'status_bayar', 'tanggal_bayar', 'bukti_bayar'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
