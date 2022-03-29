<?php

namespace App\Models;

use CodeIgniter\Model;

class DataIndukModel extends Model
{
    protected $table            = 'data_induk';
    protected $primaryKey       = ['induk_id', "kategori_id"];
    protected $returnType       = 'array';
    protected $allowedFields    = ['induk_id', "kategori_id", 'nama_induk', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Join table kategori
    public function getInduk()
    {
        return $this->select('data_induk.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.kategori_id = data_induk.kategori_id')
            ->findAll();
    }

    // get induk data by induk_id and kategori_id
    public function getIndukById($induk_id, $kategori_id)
    {
        return $this->where('induk_id', $induk_id)
            ->where('kategori_id', $kategori_id)
            ->first();
    }
}
