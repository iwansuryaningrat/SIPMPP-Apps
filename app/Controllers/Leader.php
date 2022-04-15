<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\DataIndukModel;
use App\Models\IndikatorModel;
use App\Models\KategoriModel;
use App\Models\PenilaianModel;
use App\Models\StandarModel;
use App\Models\TahunModel;
use App\Models\UnitIndukTahunModel;
use App\Models\UnitsModel;
use App\Models\UsersModel;

class Leader extends BaseController
{
    protected $dataIndukModel;
    protected $indikatorModel;
    protected $kategoriModel;
    protected $penilaianModel;
    protected $standarModel;
    protected $tahunModel;
    protected $unitIndukTahunModel;
    protected $unitsModel;
    protected $userunitModel;

    public function __construct()
    {
        $this->dataIndukModel = new DataIndukModel();
        $this->indikatorModel = new IndikatorModel();
        $this->kategoriModel = new KategoriModel();
        $this->penilaianModel = new PenilaianModel();
        $this->standarModel = new StandarModel();
        $this->tahunModel = new TahunModel();
        $this->unitIndukTahunModel = new UnitIndukTahunModel();
        $this->unitsModel = new UnitsModel();
        $this->usersModel = new UsersModel();
        $this->data_user = [
            'nama' => session()->get('nama'),
            'role' => session()->get('role'),
            'email' => session()->get('email'),
            'username' => session()->get('username'),
            'id_user' => session()->get('id_user'),
            'foto' => session()->get('foto'),
        ];
        $this->unitData = $this->transaksiModel->getTransaksiUserJoin($this->data_user['id_user']);
    }

    public function index()
    {
        // Untuk menampilkan data Dougnut Chart & tahunan
        $data_user = $this->data_user;

        // Induk Progress
        $indukpersen = $this->stats->getIndukProgress($data_user['unit_id'], $data_user['tahun']);

        // Standar Progress
        $dataprogresstandar = $this->stats->getStandarProgress($data_user['unit_id'], $data_user['tahun']);

        $databykat = $this->stats->getStandarProgressDoughnut($data_user['unit_id'], $data_user['tahun']);
        $datanilaiPEN = $databykat['pen'];
        $datanilaiPPM = $databykat['ppm'];

        // Nilai Per Tahun
        $nilaiTahun = $this->stats->getNilaiPerTahun($data_user['unit_id']);


        // Untuk menampilkan data indikator
        $unit_id = $data_user['unit_id'];
        $tahun = $data_user['tahun'];

        $kategori = $this->kategoriModel->findAll();
        foreach ($kategori as $kat) {
            $standar = $this->standarModel->getStandarByKategoriId($kat['kategori_id']);
            foreach ($standar as $std) {
                $namaStd = $std['standar_id'] . '. ' . $std['nama_standar'];
                $stat = $this->stats->getNilaiByStandar($unit_id, $tahun, $std['standar_id'], $kat['kategori_id']);
                $statstd[$std['standar_id']] = [
                    'kode' => $std['standar_id'],
                    'standar' => $namaStd,
                    'namaindikator' => $stat['nama'],
                    'nilai' => $stat['nilai'],
                ];
            }
            $Stats[$kat['kategori_id']] = $statstd;
        }

        $data = [
            'title' => 'Dashboard',
            'data_user' => $this->data_user,
            'unitData' => $this->unitData,
        ];
        return view('leader/index', $data);
    }
}
