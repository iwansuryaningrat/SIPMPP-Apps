<?php

namespace App\Models;

use CodeIgniter\Model;

class IndikatorModel extends Model
{
    protected $table            = 'indikator';
    protected $primaryKey       = ['indikator_id', "kategori_id", "standar_id"];
    protected $returnType       = 'array';
    protected $allowedFields    = ['indikator_id', "kategori_id", "standar_id", 'nama_indikator', 'target', 'nilai_acuan', 'satuan', 'keterangan', 'induk_id', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Get Indikator data by kategori_id and standar_id
    public function getIndikator($kategori_id, $standar_id)
    {
        return $this->select('indikator.*')
            ->where('indikator.kategori_id', $kategori_id)
            ->where('indikator.standar_id', $standar_id)
            ->findAll();
    }

    // Find Indikator by induk_id
    public function findIndikatorByInduk($induk_id, $kategori_id)
    {
        return $this->select('indikator.*')
            ->where('indikator.induk_id', $induk_id)
            ->where('indikator.kategori_id', $kategori_id)
            ->findAll();
    }

    // Find Spesific data by all primary key
    public function findIndikator($indikator_id, $kategori_id, $standar_id)
    {
        return $this->select('indikator.*')
            ->where('indikator.indikator_id', $indikator_id)
            ->where('indikator.kategori_id', $kategori_id)
            ->where('indikator.standar_id', $standar_id)
            ->first();
    }

    // Update Indikator
    public function updateIndikator($indikator_id, $kategori_id, $standar_id, $data)
    {
        return $this->where('indikator_id', $indikator_id)
            ->where('kategori_id', $kategori_id)
            ->where('standar_id', $standar_id)
            ->update($data);
    }

    // Get Indikator By Kategori_id
    public function getIndikatorByKategoriId($kategori_id)
    {
        return $this->select('indikator.*')
            ->where('indikator.kategori_id', $kategori_id)
            ->findAll();
    }
}
