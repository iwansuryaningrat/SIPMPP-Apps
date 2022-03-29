<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'kategori';
    protected $primaryKey       = 'kategori_id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['kategori_id', 'nama_kategori', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Get Kategori by kategori_id
    public function getKategoriById($kategori_id)
    {
        return $this->where('kategori_id', $kategori_id)->first();
    }
}
