<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitIndukTahunModel extends Model
{
    protected $table            = 'unit_induk_tahun';
    protected $primaryKey       = ['tahun', 'unit_id', 'induk_id'];
    protected $returnType       = 'array';
    protected $allowedFields    = ['tahun', 'unit_id', 'induk_id', 'kategori_id', 'nilai', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Joining Unit and Induk Table
    public function getIndukUnit($unit_id, $tahun)
    {
        return $this->select('unit_induk_tahun.*, units.nama_unit, data_induk.*, tahun.*, kategori.*')
            ->join('units', 'units.unit_id = unit_induk_tahun.unit_id')
            ->join('data_induk', 'data_induk.induk_id = unit_induk_tahun.induk_id')
            ->join('tahun', 'tahun.tahun = unit_induk_tahun.tahun')
            ->join('kategori', 'kategori.kategori_id = data_induk.kategori_id')
            ->where('unit_induk_tahun.unit_id', $unit_id)
            ->where('unit_induk_tahun.tahun', $tahun)
            ->groupby('data_induk.nama_induk')
            ->orderBy('data_induk.induk_id', 'ASC')
            ->findAll();
    }

    // get Data By Unit id and Tahun
    public function getDataByUnit($unit_id, $tahun)
    {
        return $this->select('unit_induk_tahun.*')
            ->where('unit_induk_tahun.unit_id', $unit_id)
            ->where('unit_induk_tahun.tahun', $tahun)
            ->orderBy('unit_induk_tahun.induk_id', 'ASC')
            ->findAll();
    }

    // Update field nilai
    public function updateNilai($unit_id, $tahun, $induk_id, $kategori_id, $nilai)
    {
        return $this->where('unit_id', $unit_id)
            ->where('tahun', $tahun)
            ->where('induk_id', $induk_id)
            ->where('kategori_id', $kategori_id)
            ->set('nilai', $nilai)
            ->update();
    }

    // Joining all tables
    public function getIndukUnitSpec($unit_id, $tahun, $induk_id, $kategori_id)
    {
        return $this->select('unit_induk_tahun.*, units.*, data_induk.*, tahun.*, kategori.*')
            ->join('units', 'units.unit_id = unit_induk_tahun.unit_id')
            ->join('data_induk', 'data_induk.induk_id = unit_induk_tahun.induk_id')
            ->join('tahun', 'tahun.tahun = unit_induk_tahun.tahun')
            ->join('kategori', 'kategori.kategori_id = data_induk.kategori_id')
            ->where('unit_induk_tahun.unit_id', $unit_id)
            ->where('unit_induk_tahun.tahun', $tahun)
            ->where('unit_induk_tahun.induk_id', $induk_id)
            ->where('data_induk.kategori_id', $kategori_id)
            ->first();
    }

    public function getIndukUnitKategori($unit_id, $tahun, $kategori_id)
    {
        return $this->select('unit_induk_tahun.*, units.*, data_induk.*, tahun.*, kategori.*')
            ->join('units', 'units.unit_id = unit_induk_tahun.unit_id')
            ->join('data_induk', 'data_induk.induk_id = unit_induk_tahun.induk_id')
            ->join('tahun', 'tahun.tahun = unit_induk_tahun.tahun')
            ->join('kategori', 'kategori.kategori_id = data_induk.kategori_id')
            ->where('unit_induk_tahun.unit_id', $unit_id)
            ->where('unit_induk_tahun.tahun', $tahun)
            ->where('unit_induk_tahun.kategori_id', $kategori_id)
            ->where('data_induk.kategori_id', $kategori_id)
            ->groupby('data_induk.nama_induk')
            ->orderBy('data_induk.induk_id', 'ASC')
            ->findAll();
    }

    // Delete Data Unit Induk Tahun by uinduk_id, kategori_id
    public function deleteByInduk($induk_id, $kategori_id)
    {
        return $this->where('induk_id', $induk_id)
            ->where('kategori_id', $kategori_id)
            ->delete();
    }

    // Cek Data 
    public function cekData($tahun, $unit, $induk_id, $kategori_id)
    {
        return $this->where('tahun', $tahun)
            ->where('unit_id', $unit)
            ->where('induk_id', $induk_id)
            ->where('kategori_id', $kategori_id)
            ->first();
    }
}
