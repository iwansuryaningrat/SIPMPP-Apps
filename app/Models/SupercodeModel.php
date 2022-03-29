<?php

namespace App\Models;

use CodeIgniter\Model;

class SupercodeModel extends Model
{
    protected $table            = 'supercode';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['supercode'];

    // find supercode
    public function findSupercode($supercode)
    {
        return $this->where('supercode', $supercode)->first();
    }
}
