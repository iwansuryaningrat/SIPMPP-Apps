<?php

namespace App\Models;

use CodeIgniter\Model;

class StandarModel extends Model
{
    protected $table            = 'standar';
    protected $primaryKey       = ['standar_id', "kategori_id"];
    protected $returnType       = 'array';
    protected $allowedFields    = ['standar_id', "kategori_id", 'nama_standar', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Get Standar
    public function getStandar($standar_id)
    {
        return $this->select('standar.standar_id, standar.nama_standar')
            ->where('standar.standar_id', $standar_id)
            ->first();
    }

    // Get all standar and join
    public function getAllStandar()
    {
        return $this->select('standar.standar_id, standar.nama_standar, kategori.nama_kategori, kategori.kategori_id')
            ->join('kategori', 'kategori.kategori_id = standar.kategori_id')
            ->findAll();
    }

    // Get standar by standar_id and kategori_id
    public function getStandarByKategori($standar_id, $kategori_id)
    {
        return $this->select('standar.*')
            ->where('standar.standar_id', $standar_id)
            ->where('standar.kategori_id', $kategori_id)
            ->first();
    }
}
