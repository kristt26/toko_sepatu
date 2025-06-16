<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table            = 'review';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_produk','id_users', 'id_parent', 'rating', 'komentar', 'create_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
