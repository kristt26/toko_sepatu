<?php

namespace App\Models;

use CodeIgniter\Model;

class TokoModel extends Model
{
    protected $table            = 'toko';
    protected $primaryKey       = 'id_toko';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama','alamat', 'telepon', 'logo', 'bank', 'rekening', 'nama_rekening'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
