<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $table            = 'penilaian';
    protected $primaryKey       = ['tahun', "kategori_id", "standar_id", "indikator_id", "unit_id"];
    protected $returnType       = 'array';
    protected $allowedFields    = ['tahun', "kategori_id", "standar_id", "indikator_id", "unit_id", 'nilai_input', 'dokumen', 'keterangan', 'catatan', 'status', 'hasil', 'nilai_akhir', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Joining all tables
    public function getPenilaian($unit_id, $tahun)
    {
        return $this->select('penilaian.*, standar.nama_standar')
            ->join('standar', 'standar.kategori_id = penilaian.kategori_id AND standar.standar_id=penilaian.standar_id')
            ->where('penilaian.unit_id', $unit_id)
            ->where('penilaian.tahun', $tahun)
            ->groupby('standar.nama_standar')
            ->orderBy('standar.NoStd', 'ASC')
            ->findAll();
    }

    // Joining all tables
    public function getPenilaianSpec($unit_id, $standar_id, $tahun, $kategori_id)
    {
        // return $this->select('penilaian.*, kategori.nama_kategori, standar.nama_standar , indikator.*, units.*, unit_induk_tahun.nilai')
        return $this->select('penilaian.*')
            // ->join('kategori', 'kategori.kategori_id = penilaian.kategori_id')
            // ->join('standar', 'standar.standar_id = penilaian.standar_id')
            // ->join('units', 'units.unit_id = penilaian.unit_id')
            // ->join('indikator', 'indikator.standar_id = penilaian.standar_id')
            // ->join('unit_induk_tahun', 'unit_induk_tahun.induk_id = indikator.induk_id')
            ->where('penilaian.unit_id', $unit_id)
            ->where('penilaian.standar_id', $standar_id)
            ->where('penilaian.tahun', $tahun)
            ->where('penilaian.kategori_id', $kategori_id)
            // ->where('indikator.kategori_id', $kategori_id)
            // ->where('standar.kategori_id', $kategori_id)
            // ->where('unit_induk_tahun.tahun', $tahun)
            // ->where('unit_induk_tahun.unit_id', $unit_id)
            // ->groupby('penilaian.indikator_id')
            // ->groupby('indikator.indikator_id')
            // ->groupby('indikator.nama_indikator')
            // ->orderBy('standar.NoStd', 'ASC')
            ->findAll();
    }

    // Update status berdasarkan unit_id dan tahun
    public function updateStatus($unit_id, $tahun, $status)
    {
        return $this->where('unit_id', $unit_id)
            ->where('tahun', $tahun)
            ->set('status', $status)
            ->update();
    }

    // Get status berdasarkan unit_id dan tahun dan standar dan kategori_id
    public function getStatus($unit_id, $tahun, $standar_id, $kategori_id)
    {
        return $this->select('status')
            ->where('unit_id', $unit_id)
            ->where('tahun', $tahun)
            ->where('standar_id', $standar_id)
            ->where('kategori_id', $kategori_id)
            ->findAll();
    }

    // Update data
    public function updatePenilaian($unit_id, $tahun, $standar_id, $kategori_id, $indikator_id, $data)
    {
        return $this->where('unit_id', $unit_id)
            ->where('tahun', $tahun)
            ->where('standar_id', $standar_id)
            ->where('kategori_id', $kategori_id)
            ->where('indikator_id', $indikator_id)
            ->set($data)
            ->update();
    }

    // Joining all tables
    public function getPenilaianSpecId($unit_id, $standar_id, $tahun, $kategori_id, $indikator_id)
    {
        return $this->select('penilaian.*, kategori.nama_kategori, standar.nama_standar , indikator.*, units.*, data_induk.*, unit_induk_tahun.nilai')
            ->join('kategori', 'kategori.kategori_id = penilaian.kategori_id')
            ->join('standar', 'standar.standar_id = penilaian.standar_id')
            ->join('units', 'units.unit_id = penilaian.unit_id')
            ->join('indikator', 'indikator.standar_id = penilaian.standar_id')
            ->join('data_induk', 'data_induk.induk_id = indikator.induk_id')
            ->join('unit_induk_tahun', 'unit_induk_tahun.induk_id = indikator.induk_id')
            ->where('penilaian.unit_id', $unit_id)
            ->where('penilaian.standar_id', $standar_id)
            ->where('penilaian.tahun', $tahun)
            ->where('penilaian.kategori_id', $kategori_id)
            ->where('penilaian.indikator_id', $indikator_id)
            ->where('indikator.kategori_id', $kategori_id)
            ->where('indikator.indikator_id', $indikator_id)
            ->where('standar.kategori_id', $kategori_id)
            ->where('data_induk.kategori_id', $kategori_id)
            ->where('unit_induk_tahun.kategori_id', $kategori_id)
            ->where('unit_induk_tahun.tahun', $tahun)
            ->where('unit_induk_tahun.unit_id', $unit_id)
            // ->groupby('indikator.nama_indikator')
            ->first();
    }

    // Get Penilaian By Unit_id, standar_id, kategori_id, tahun and indikator_id
    public function getPenilaianByUnitId($unit_id, $standar_id, $kategori_id, $tahun, $indikator_id)
    {
        return $this->select('penilaian.*')
            ->where('penilaian.unit_id', $unit_id)
            ->where('penilaian.standar_id', $standar_id)
            ->where('penilaian.kategori_id', $kategori_id)
            ->where('penilaian.tahun', $tahun)
            ->where('penilaian.indikator_id', $indikator_id)
            ->findAll();
    }

    // Get Penilaian By Unit_id and tahun
    public function getPenilaianByUnitIdTahun($unit_id, $tahun)
    {
        return $this->select('penilaian.*, standar.nama_standar, standar.NoStd')
            ->join('standar', 'standar.standar_id = penilaian.standar_id')
            ->where('penilaian.unit_id', $unit_id)
            ->where('penilaian.tahun', $tahun)
            // ->where('penilaian.kategori_id', 'standar.kategori_id')
            ->groupby('penilaian.standar_id')
            ->groupby('penilaian.kategori_id')
            ->orderBy('standar.NoStd', 'ASC')
            ->findAll();
    }

    // Get Penilaian By Unit_id and tahun and standar_id
    public function getPenilaianProgress($unit_id, $tahun, $standar_id, $kategori_id)
    {
        return $this->select('penilaian.*')
            ->where('penilaian.unit_id', $unit_id)
            ->where('penilaian.tahun', $tahun)
            ->where('penilaian.standar_id', $standar_id)
            ->where('penilaian.kategori_id', $kategori_id)
            ->findAll();
    }

    // Cek Data
    public function cekData($tahun, $unit_id, $standar_id, $indikator_id, $kategori_id)
    {
        return $this->select('penilaian.*')
            ->where('penilaian.unit_id', $unit_id)
            ->where('penilaian.tahun', $tahun)
            ->where('penilaian.standar_id', $standar_id)
            ->where('penilaian.indikator_id', $indikator_id)
            ->where('penilaian.kategori_id', $kategori_id)
            ->first();
    }

    // Get Penilaian By Kategorinya
    public function getPenilaianByKat($unit_id, $tahun, $kategori_id)
    {
        // return $this->select('penilaian.*, standar.nama_standar')
        return $this->select('penilaian.*, standar.nama_standar, standar.NoStd')
            // ->join('standar', 'standar.kategori_id = penilaian.kategori_id AND standar.standar_id=penilaian.standar_id')
            ->join('standar', 'standar.standar_id=penilaian.standar_id')
            ->where('penilaian.unit_id', $unit_id)
            ->where('penilaian.tahun', $tahun)
            ->where('penilaian.kategori_id', $kategori_id)
            ->where('standar.kategori_id', $kategori_id)
            // ->where('standar.kategori_id', 'penilaian.kategori_id')
            ->groupby('standar.nama_standar')
            ->orderBy('standar.NoStd', 'ASC')
            ->findAll();
    }

    // Get Penilaian Data
    public function getPenilaianData($unit_id, $tahun, $kategori_id)
    {
        return $this->select('penilaian.*, standar.nama_standar, standar.NoStd')
            ->join('standar', 'standar.standar_id=penilaian.standar_id')
            ->where('penilaian.unit_id', $unit_id)
            ->where('penilaian.tahun', $tahun)
            ->where('penilaian.kategori_id', $kategori_id)
            ->where('standar.kategori_id', $kategori_id)
            ->groupby('standar.nama_standar')
            ->orderBy('standar.NoStd', 'ASC')
            ->findAll();
    }

    // Get All Data & Join
    public function getAllData()
    {
        return $this->select('penilaian.*, standar.nama_standar, standar.NoStd, kategori.nama_kategori')
            ->join('standar', 'standar.standar_id=penilaian.standar_id')
            ->join('kategori', 'kategori.kategori_id=penilaian.kategori_id')
            // ->groupby('standar.nama_standar')
            ->orderBy('standar.NoStd', 'ASC')
            ->findAll();
    }

    // Joining all tables
    public function getPenilaianSpecOne($unit_id, $standar_id, $tahun, $kategori_id)
    {
        return $this->select('penilaian.*, standar.nama_standar, standar.NoStd')
            // return $this->select('penilaian.*')
            // ->join('kategori', 'kategori.kategori_id = penilaian.kategori_id')
            ->join('standar', 'standar.standar_id = penilaian.standar_id')
            // ->join('units', 'units.unit_id = penilaian.unit_id')
            // ->join('indikator', 'indikator.standar_id = penilaian.standar_id')
            // ->join('unit_induk_tahun', 'unit_induk_tahun.induk_id = indikator.induk_id')
            ->where('penilaian.unit_id', $unit_id)
            ->where('penilaian.standar_id', $standar_id)
            ->where('penilaian.tahun', $tahun)
            ->where('penilaian.kategori_id', $kategori_id)
            ->where('standar.kategori_id', $kategori_id)
            ->where('standar.standar_id', $standar_id)
            // ->where('indikator.kategori_id', $kategori_id)
            // ->where('standar.kategori_id', $kategori_id)
            // ->where('unit_induk_tahun.tahun', $tahun)
            // ->where('unit_induk_tahun.unit_id', $unit_id)
            // ->groupby('penilaian.indikator_id')
            // ->groupby('indikator.indikator_id')
            // ->groupby('indikator.nama_indikator')
            // ->orderBy('standar.kategori_id', 'ASC')
            // ->orderBy('standar.NoStd', 'ASC')
            ->first();
    }
}
