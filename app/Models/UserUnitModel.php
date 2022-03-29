<?php

namespace App\Models;

use CodeIgniter\Model;

class UserUnitModel extends Model
{
    protected $table            = 'user_unit';
    protected $primaryKey       = ['email', 'unit_id'];
    protected $returnType       = 'array';
    protected $allowedFields    = ['email', 'unit_id'];
}
