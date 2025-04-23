<?php

namespace App\Models;

use CodeIgniter\Model;

class AreaModel extends Model
{
    protected $table            = 'service_area';
    protected $primaryKey       = 'id_area';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_area','harga_kirim'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
