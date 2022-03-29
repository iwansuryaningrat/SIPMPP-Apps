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
            ->findAll();
    }

    // Joining all tables
    public function getPenilaianSpec($unit_id, $standar_id, $tahun, $kategori_id)
    {
        return $this->select('penilaian.*, kategori.nama_kategori, standar.nama_standar , indikator.*, units.*, unit_induk_tahun.nilai')
            ->join('kategori', 'kategori.kategori_id = penilaian.kategori_id')
            ->join('standar', 'standar.standar_id = penilaian.standar_id')
            ->join('units', 'units.unit_id = penilaian.unit_id')
            ->join('indikator', 'indikator.standar_id = penilaian.standar_id')
            ->join('unit_induk_tahun', 'unit_induk_tahun.induk_id = indikator.induk_id')
            ->where('penilaian.unit_id', $unit_id)
            ->where('penilaian.standar_id', $standar_id)
            ->where('penilaian.tahun', $tahun)
            ->where('penilaian.kategori_id', $kategori_id)
            ->where('indikator.kategori_id', $kategori_id)
            ->where('standar.kategori_id', $kategori_id)
            ->where('unit_induk_tahun.tahun', $tahun)
            ->where('unit_induk_tahun.unit_id', $unit_id)
            ->groupby('indikator.nama_indikator')
            ->orderBy('penilaian.indikator_id', 'ASC')
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
        return $this->select('penilaian.*, kategori.nama_kategori, standar.nama_standar , indikator.*, units.*, unit_induk_tahun.nilai')
            ->join('kategori', 'kategori.kategori_id = penilaian.kategori_id')
            ->join('standar', 'standar.standar_id = penilaian.standar_id')
            ->join('units', 'units.unit_id = penilaian.unit_id')
            ->join('indikator', 'indikator.standar_id = penilaian.standar_id')
            ->join('unit_induk_tahun', 'unit_induk_tahun.induk_id = indikator.induk_id')
            ->where('penilaian.unit_id', $unit_id)
            ->where('penilaian.standar_id', $standar_id)
            ->where('penilaian.tahun', $tahun)
            ->where('penilaian.kategori_id', $kategori_id)
            ->where('penilaian.indikator_id', $indikator_id)
            ->where('indikator.kategori_id', $kategori_id)
            ->where('indikator.indikator_id', $indikator_id)
            ->where('standar.kategori_id', $kategori_id)
            ->where('unit_induk_tahun.tahun', $tahun)
            ->where('unit_induk_tahun.unit_id', $unit_id)
            ->groupby('indikator.nama_indikator')
            ->findAll();
    }
}
