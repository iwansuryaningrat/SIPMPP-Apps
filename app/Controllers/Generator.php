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

use App\Controllers\BaseController;

class Generator extends BaseController
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

    //  Induk Generator Method (Done)
    public function indukGenerator($tahun, $unit, $induk_id, $kategori_id)
    {
        // Cek di database
        $data = $this->unitIndukTahunModel->cekData($tahun, $unit, $induk_id, $kategori_id);

        if ($data == null) {
            $data = [
                'tahun' => $tahun,
                'unit_id' => $unit,
                'induk_id' => $induk_id,
                'kategori_id' => $kategori_id,
                'nilai' => '0',
            ];

            $this->unitIndukTahunModel->insert($data);

            return "200";
        } else {
            return "500";
        }
    }

    //  Penilaian Generator Method (Done)
    public function penilaianGenerator($tahun, $unit, $standar_id, $indikator_id, $kategori_id)
    {
        // Cek di database
        $data = $this->penilaianModel->cekData($tahun, $unit, $standar_id, $indikator_id, $kategori_id);

        if ($data == null) {
            $data = [
                'tahun' => $tahun,
                'kategori_id' => $kategori_id,
                'standar_id' => $standar_id,
                'indikator_id' => $indikator_id,
                'unit_id' => $unit,
                'nilai_input' => '0',
                'status' => 'Belum Diisi',
                'hasil' => '0',
                'nilai_akhir' => '0',
            ];

            $this->penilaianModel->insert($data);

            return "200";
        } else {
            return "500";
        }
    }
}
