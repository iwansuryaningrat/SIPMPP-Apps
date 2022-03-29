<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table            = 'role';
    protected $primaryKey       = 'role_id';
    protected $allowedFields    = ['role'];

    // Get role
    public function getRole($role)
    {
        return $this->where('role', $role)->first();
    }

    // Get role
    public function getRoleId($role_id)
    {
        return $this->where('role_id', $role_id)->first();
    }
}
