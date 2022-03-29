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

class Home extends BaseController
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
        $this->i = 1;
        $this->session = \Config\Services::session();
    }

    // Dashboard Method
    public function index()
    {
        $data_user = $this->data_user;
        $units = $this->unitsModel->findAll();
        // dd($units);

        $i = 1;

        $data = [
            'title' => 'Dashboard SIPMPP | SIPMPP UNDIP 2022',
            'data_user' => $data_user,
            'i' => $i,
            'tab' => 'home',
            'header' => 'header__big',
            'css' => 'styles-dashboard.css',
            'units' => $units,
        ];

        return view('user/index', $data);
    }

    // Data Induk Method (Done)
    public function dataInduk()
    {
        $data_user = $this->data_user;
        $tahun = $data_user['tahun'];

        $unit_id = $data_user['unit_id'];

        // $data_induk = $this->unitIndukTahunModel->getIndukUnit($unit_id, $tahun);
        $data_indukPen = $this->unitIndukTahunModel->getIndukUnitKategori($unit_id, $tahun, 'PEN');
        // dd($data_induk);
        $data_indukPPM = $this->unitIndukTahunModel->getIndukUnitKategori($unit_id, $tahun, 'PPM');

        $i = 1;

        $data = [
            'title' => 'Data Induk | SIPMPP UNDIP 2022',
            'tab' => 'induk',
            'header' => 'header__mini',
            'css' => 'styles-data-induk.css',
            'i' => $i,
            'data_user' => $data_user,
            'data_indukPen' => $data_indukPen,
            'data_indukPPM' => $data_indukPPM,
        ];

        return view('user/datainduk', $data);
    }

    // Edit Data Induk Method (Done)
    public function editDataInduk()
    {
        $user = $this->data_user;
        $tahun = $user['tahun'];
        $unit_id = $user['unit_id'];

        $induk_id = $this->request->getVar('induk_id');
        // dd($induk_id);
        $nilai = $this->request->getVar('nilai');
        $kategori_id = $this->request->getVar('kategori_id');
        // dd($nilai, $kategori_id);

        // $data_induk = $this->unitIndukTahunModel->getIndukUnitSpec($unit_id, $tahun, $induk_id, $kategori_id);
        // dd($data_induk);

        // Update Data
        $this->unitIndukTahunModel->updateNilai($unit_id, $tahun, $induk_id, $kategori_id, $nilai);
        // $this->unitIndukTahunModel->updateNilai($unit_id, $tahun, $induk_id, $nilai);

        return redirect()->to('/home/datainduk/' . $unit_id . '/' . $tahun);
    }
}
