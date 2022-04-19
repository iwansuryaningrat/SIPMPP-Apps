<?php

namespace App\Controllers;

use App\Models\DataIndukModel;
use App\Models\IndikatorModel;
use App\Models\KategoriModel;
use App\Models\PenilaianModel;
use App\Models\StandarModel;
use App\Models\TahunModel;
use App\Models\UnitIndukTahunModel;
use App\Models\UnitsModel;
use App\Models\UsersModel;
use App\Models\UserRoleUnitModel;

use App\Controllers\Stats;

use App\Controllers\BaseController;

class Test extends BaseController
{
    protected $dataIndukModel;
    protected $indikatorModel;
    protected $kategoriModel;
    protected $penilaianModel;
    protected $standarModel;
    protected $tahunModel;
    protected $unitIndukTahunModel;
    protected $unitsModel;
    protected $usersModel;
    protected $userroleunitModel;
    protected $stats;

    public function __construct()
    {
        $this->stats = new Stats();
        $this->dataIndukModel = new DataIndukModel();
        $this->indikatorModel = new IndikatorModel();
        $this->kategoriModel = new KategoriModel();
        $this->penilaianModel = new PenilaianModel();
        $this->standarModel = new StandarModel();
        $this->tahunModel = new TahunModel();
        $this->unitIndukTahunModel = new UnitIndukTahunModel();
        $this->unitsModel = new UnitsModel();
        $this->usersModel = new UsersModel();
        $this->userroleunitModel = new UserRoleUnitModel();
        $this->data_user = [
            'email' => session()->get('email'),
            'nama' => session()->get('nama'),
            'foto' => session()->get('foto'),
            'unit_id' => session()->get('unit_id'),
            'unit' => session()->get('unit'),
            'role' => session()->get('role'),
            'role_id' => session()->get('role_id'),
            'tahun' => session()->get('tahun'),
        ];
        $this->tahun = $this->userroleunitModel->getTahunRole($this->data_user['email'], $this->data_user['role_id'], $this->data_user['unit_id']);
        $this->i = 1;
        $this->session = \Config\Services::session();
        $this->thisTahun = (int)date('Y');
    }

    public function index()
    {
        $data_user = $this->data_user;
        $tahun = $data_user['tahun'];

        $unit_id = $data_user['unit_id'];


        $data = $this->penilaianModel->getPenilaian($unit_id, $tahun);
        dd($data);
        $data_nilai = [];
        foreach ($data as $datap) {
            $nilai_akhir = 0;
            $i = 1;
            $datapenilaian = $this->penilaianModel->getPenilaianSpec($data_user['unit_id'], $datap['standar_id'], $tahun, $datap['kategori_id']);
            foreach ($datapenilaian as $nilai) {
                $nilai_akhir += $nilai['nilai_akhir'];
                $i++;
            }
            $nilai_akhir = $nilai_akhir / $i;
            $data_nilai[] = [
                'standar_id' => $datap['standar_id'],
                'kategori_id' => $datap['kategori_id'],
                'nilai_akhir' => $nilai_akhir,
            ];
        }
    }
}
