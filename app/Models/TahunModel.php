<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunModel extends Model
{
    protected $table            = 'tahun';
    protected $primaryKey       = 'tahun';
    protected $returnType       = 'array';
    protected $allowedFields    = ['tahun'];
}
