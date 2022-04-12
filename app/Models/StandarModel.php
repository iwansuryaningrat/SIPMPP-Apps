<?php

namespace App\Models;

use CodeIgniter\Model;

class StandarModel extends Model
{
    protected $table            = 'standar';
    protected $primaryKey       = ['standar_id', "kategori_id"];
    protected $returnType       = 'array';
    protected $allowedFields    = ['standar_id', "kategori_id", "NoStd", 'nama_standar', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Get all standar and join
    public function getAllStandar()
    {
        return $this->select('standar.*')
            ->orderBy('standar.kategori_id', 'ASC')
            ->orderBy('standar.NoStd', 'ASC')
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

    // Update Standar by standar_id and kategori_id
    public function updateStandar($standar_id, $kategori_id, $nama_standar)
    {
        return $this->where('standar_id', $standar_id)
            ->where('kategori_id', $kategori_id)
            ->set('nama_standar', $nama_standar)
            ->update();
    }

    // Get Standar by Kategori id
    public function getStandarByKategoriId($kategori_id)
    {
        return $this->select('standar.*')
            ->where('standar.kategori_id', $kategori_id)
            ->orderBy('standar.NoStd', 'ASC')
            ->findAll();
    }
}
