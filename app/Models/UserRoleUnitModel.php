<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRoleUnitModel extends Model
{
    protected $table            = 'user_role_unit';
    protected $primaryKey       = ['email', 'role_id', 'unit_id', 'tahun'];
    protected $returnType       = 'array';
    protected $allowedFields    = ['email', 'role_id', 'unit_id', 'tahun', 'created_at', 'updated_at', 'deleted_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Join Table User Unit
    public function getUserUnit($email, $tahun)
    {
        return $this->select('user_role_unit.*, users.*, units.*, role.*')
            ->join('users', 'users.email = user_role_unit.email')
            ->join('units', 'units.unit_id = user_role_unit.unit_id')
            ->join('role', 'role.role_id = user_role_unit.role_id')
            ->where('user_role_unit.email', $email)
            ->where('user_role_unit.tahun', $tahun)
            ->findAll();
    }

    // Join Table User Unit Role
    public function getUserUnitRole($email, $tahun, $role)
    {
        return $this->select('user_role_unit.*, users.*, units.*, role.*')
            ->join('users', 'users.email = user_role_unit.email')
            ->join('units', 'units.unit_id = user_role_unit.unit_id')
            ->join('role', 'role.role_id = user_role_unit.role_id')
            ->where('user_role_unit.email', $email)
            ->where('user_role_unit.tahun', $tahun)
            ->where('role.role', $role)
            ->findAll();
    }

    // Join Table User Unit Role Tahun
    public function getUserUnitRoleTahun($email, $tahun, $role)
    {
        return $this->select('user_role_unit.unit_id, units.nama_unit')
            ->join('users', 'users.email = user_role_unit.email')
            ->join('units', 'units.unit_id = user_role_unit.unit_id')
            ->join('role', 'role.role_id = user_role_unit.role_id')
            ->where('user_role_unit.email', $email)
            ->where('user_role_unit.tahun', $tahun)
            ->where('role.role', $role)
            ->findAll();
    }

    // Get user's role by email and tahun
    public function getUserRole($email, $tahun)
    {
        return $this->select('role.*')
            ->join('users', 'users.email = user_role_unit.email')
            ->join('units', 'units.unit_id = user_role_unit.unit_id')
            ->join('role', 'role.role_id = user_role_unit.role_id')
            ->where('user_role_unit.email', $email)
            ->where('user_role_unit.tahun', $tahun)
            ->findAll();
    }

    // Join all table for spesific data
    public function getDataSpec($email, $tahun, $role, $unit_id)
    {
        return $this->select('user_role_unit.*, users.*, units.*, role.*')
            ->join('users', 'users.email = user_role_unit.email')
            ->join('units', 'units.unit_id = user_role_unit.unit_id')
            ->join('role', 'role.role_id = user_role_unit.role_id')
            ->where('user_role_unit.email', $email)
            ->where('user_role_unit.tahun', $tahun)
            ->where('role.role', $role)
            ->where('user_role_unit.unit_id', $unit_id)
            ->first();
    }

    // Joining All table to find all data
    public function getData()
    {
        return $this->select('user_role_unit.*, users.*, units.*, role.*')
            ->join('users', 'users.email = user_role_unit.email')
            ->join('units', 'units.unit_id = user_role_unit.unit_id')
            ->join('role', 'role.role_id = user_role_unit.role_id')
            ->findAll();
    }
}
