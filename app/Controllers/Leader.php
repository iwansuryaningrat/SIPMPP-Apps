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
use App\Models\UserRoleUnitModel;

use App\Controllers\Stats;

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
        // Untuk menampilkan data Dougnut Chart & tahunan
        $data_user = $this->data_user;
        $data_tahun = $this->tahunModel->findAll();
        $data_unit = $this->unitsModel->findAll();

        // Induk Progress
        $indukpersen = $this->stats->getIndukProgress($data_user['unit_id'], $data_user['tahun']);

        // Standar Progress
        $dataprogresstandar = $this->stats->getStandarProgress($data_user['unit_id'], $data_user['tahun']);

        $databykat = $this->stats->getStandarProgressDoughnut($data_user['unit_id'], $data_user['tahun']);
        $datanilaiPEN = $databykat['pen'];
        $datanilaiPPM = $databykat['ppm'];

        // Nilai Per Tahun
        $nilaiTahun = $this->stats->getNilaiPerTahun($data_user['unit_id']);

        $data = [
            'title' => 'Dashboard Leader | SIPMPP UNDIP ' . $this->thisTahun,
            'data_user' => $data_user,
            'tab' => 'home',
            'tahun' => $data_user['tahun'],
            'header' => 'header__big',
            'css' => 'styles-leader-dashboard.css',
            'tahunsession' => $this->tahun,
            'data_tahun' => $data_tahun,
            'data_unit' => $data_unit,
            'indukpersen' => $indukpersen,
            'dataprogresstandar' => $dataprogresstandar,
            'datanilaiPEN' => $datanilaiPEN,
            'datanilaiPPM' => $datanilaiPPM,
            'nilaiTahun' => $nilaiTahun,
        ];

        return view('leader/index', $data);
    }

    // Units Method
    public function units()
    {
        $data_user = $this->data_user;
        $units = $this->unitsModel->findAll();
        $data = [
            'title' => 'Datar Unit | SIPMPP UNDIP ' . $this->thisTahun,
            'data_user' => $data_user,
            'tab' => 'units',
            'tahun' => $data_user['tahun'],
            'header' => 'header__mini header__unit',
            'css' => 'styles-leader-unit.css',
            'tahunsession' => $this->tahun,
            'units' => $units,
        ];

        return view('leader/unit', $data);
    }

    // Profile Method
    public function profile()
    {
        $data_user = $this->data_user;
        $user = $this->usersModel->getUserByEmail($data_user['email']);

        $data = [
            'title' => 'Profile | SIPMPP UNDIP ' . $this->thisTahun,
            'usersession' => $data_user,
            'data_user' => $data_user,
            'user' => $user,
            'tab' => 'profile',
            'header' => 'header__mini header__profile',
            'css' => 'styles-leader-profile.css',
            'tahun' => $data_user['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('leader/profile', $data);
    }

    // Switch Tahun & Unit Method 
    public function switchTahunUnit()
    {
        $tahun = $this->request->getPost('tahunLeader');
        $unit = $this->request->getPost('unitLeader');
        $nama_unit = $this->unitsModel->getUnit($unit)['nama_unit'];

        $this->session->set('tahun', $tahun);
        $this->session->set('unit_id', $unit);
        $this->session->set('unit', $nama_unit);

        return redirect()->to(base_url('leader/index'));
    }
}
