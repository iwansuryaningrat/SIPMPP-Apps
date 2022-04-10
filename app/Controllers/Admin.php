<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\DataIndukModel;
use App\Models\IndikatorModel;
use App\Models\KategoriModel;
use App\Models\PenilaianModel;
use App\Models\RoleModel;
use App\Models\StandarModel;
use App\Models\TahunModel;
use App\Models\UnitIndukTahunModel;
use App\Models\UnitsModel;
use App\Models\UsersModel;
use App\Models\UserRoleUnitModel;
use Config\Validation;

class Admin extends BaseController
{
    protected $dataIndukModel;
    protected $indikatorModel;
    protected $kategoriModel;
    protected $penilaianModel;
    protected $roleModel;
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
        $this->roleModel = new RoleModel();
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
            'role_id' => session()->get('role_id'),
            'role' => session()->get('role'),
            'tahun' => session()->get('tahun'),
        ];
        $this->tahun = $this->userroleunitModel->getTahunRole($this->data_user['email'], $this->data_user['role_id'], $this->data_user['unit_id']);
        $this->i = 1;
        $this->thisTahun = (int)date('Y');
        $this->session = \Config\Services::session();
    }

    // Admin Dashboard Method
    public function index()
    {
        $usersession = $this->data_user;
        $units = $this->unitsModel->findAll();

        $data = [
            'title' => 'Dashboard SIPMPP | SIPMPP UNDIP ' . $this->thisTahun,
            'tab' => 'home',
            'css' => 'styles-admin-dashboard.css',
            'header' => 'header__big',
            'i' => $this->i,
            'usersession' => $usersession,
            'units' => $units,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];


        return view('admin/index', $data);
    }

    // Daftar user (Done)
    public function daftarUser()
    {
        $users = $this->usersModel->findAll();
        $usersession = $this->data_user;
        $data = [
            'title' => 'Daftar User | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'user',
            'css' => 'styles-admin-daftar-user.css',
            'header' => 'header__mini header__daftarUser',
            'i' => $this->i,
            'users' => $users,
            'usersession' => $usersession,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/daftar-user', $data);
    }

    //Add user form method (Done)
    public function addUserForm()
    {
        $usersession = $this->data_user;
        $data = [
            'title' => 'Form Tambah User | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'user',
            'css' => 'styles-admin-add-user.css',
            'header' => 'header__mini header__addUserForm',
            'i' => $this->i,
            'usersession' => $usersession,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/add-user', $data);
    }

    // User Method (Done)
    public function user()
    {
        $usersession = $this->data_user;
        $units = $this->userroleunitModel->getData();
        $users = $this->userroleunitModel->getDataEmailRole(1);

        $data = [
            'title' => 'Base User | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'user',
            'css' => 'styles-admin-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'users' => $users,
            'units' => $units,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/user-baseuser', $data);
    }

    // add basic user Form (Done)
    public function addBasicUserform()
    {
        $usersession = $this->data_user;
        $users = $this->usersModel->findAll();
        $units = $this->unitsModel->findAll();
        $tahun = $this->tahunModel->findAll();
        $role = $this->roleModel->getRole('user');

        $data = [
            'title' => 'Form Tambah User | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'user',
            'css' => 'styles-admin-add-user.css',
            'header' => 'header__mini header__addBasicUserForm',
            'i' => $this->i,
            'usersession' => $this->data_user,
            'users' => $users,
            'units' => $units,
            'tahuns' => $tahun,
            'role' => $role,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/add-base-user', $data);
    }

    // Leader Method (Done)
    public function leader()
    {
        $usersession = $this->data_user;
        $units = $this->userroleunitModel->getData();
        $users = $this->userroleunitModel->getDataEmailRole(4);

        $data = [
            'title' => 'Pimpinan | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'user',
            'css' => 'styles-admin-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'users' => $users,
            'units' => $units,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/user-leader', $data);
    }

    // add leader Form (Done)
    public function addLeader()
    {
        $usersession = $this->data_user;
        $users = $this->usersModel->findAll();
        $units = $this->unitsModel->findAll();
        $tahun = $this->tahunModel->findAll();
        $role = $this->roleModel->getRole('pimpinan');

        $data = [
            'title' => 'Form Tambah User Pimpinan | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'user',
            'css' => 'styles-admin-add-user.css',
            'header' => 'header__mini header__addAuditor',
            'i' => $this->i,
            'usersession' => $this->data_user,
            'users' => $users,
            'units' => $units,
            'tahuns' => $tahun,
            'roles' => $role,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/add-leader', $data);
    }

    // Auditor Method (Done)
    public function auditor()
    {
        $usersession = $this->data_user;
        $units = $this->userroleunitModel->getData();
        $users = $this->userroleunitModel->getDataEmailRole(3);

        $data = [
            'title' => 'Auditor | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'user',
            'css' => 'styles-admin-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'users' => $users,
            'units' => $units,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/user-auditor', $data);
    }

    // add auditor Form (Done)
    public function addAuditor()
    {
        $usersession = $this->data_user;
        $users = $this->usersModel->findAll();
        $units = $this->unitsModel->findAll();
        $tahun = $this->tahunModel->findAll();
        $role = $this->roleModel->getRole('auditor');

        $data = [
            'title' => 'Form Tambah Auditor | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'user',
            'css' => 'styles-admin-add-user.css',
            'header' => 'header__mini header__addAuditor',
            'i' => $this->i,
            'usersession' => $this->data_user,
            'users' => $users,
            'units' => $units,
            'tahuns' => $tahun,
            'roles' => $role,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/add-auditor', $data);
    }

    // units Method (Done)
    public function units()
    {
        $usersession = $this->data_user;
        $units = $this->unitsModel->findAll();

        $data = [
            'title' => 'Daftar Unit | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'unit',
            'css' => 'styles-admin-unit.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'units' => $units,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/units', $data);
    }

    // kategori page (Done)
    public function kategori()
    {
        $usersession = $this->data_user;
        $kategori = $this->kategoriModel->findAll();
        $data = [
            'title' => 'Daftar Kategori | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'kategori',
            'css' => 'styles-admin-kategori.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'kategori' => $kategori,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/kategori', $data);
    }

    // Data Induk Method (Done)
    public function dataInduk()
    {
        $usersession = $this->data_user;
        $induk = $this->dataIndukModel->getInduk();

        $data = [
            'title' => 'Data Induk | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'induk',
            'css' => 'styles-admin-data-induk.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'induk' => $induk,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/dataInduk', $data);
    }

    // Isian Data Induk method
    public function isianDataInduk()
    {
        $usersession = $this->data_user;

        $data = [
            'title' => 'Isian Data Induk | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'induk',
            'css' => 'styles-admin-data-induk.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,

            'cssCustom' => '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">',
        ];

        return view('admin/isian-data-induk', $data);
    }

    //add data induk method (Done)
    public function addDataIndukForm()
    {
        $usersession = $this->data_user;
        $induk = $this->dataIndukModel->getInduk();
        $kategori = $this->kategoriModel->findAll();

        $data = [
            'title' => 'Form Add Data Induk | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'induk',
            'css' => 'styles-admin-add-datainduk.css',
            'header' => 'header__mini header__addBasicUserForm',
            'i' => $this->i,
            'usersession' => $usersession,
            'induk' => $induk,
            'kategori' => $kategori,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/add-dataInduk', $data);
    }

    // edit data induk page (Done)
    public function editDataInduk($induk_id, $kategori_id)
    {
        $usersession = $this->data_user;
        $datainduk = $this->dataIndukModel->getIndukById($induk_id, $kategori_id);
        $kategori = $this->kategoriModel->findAll();

        $data = [
            'title' => 'Form Edit Data Induk | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'induk',
            'css' => 'styles-admin-add-datainduk.css',
            'header' => 'header__mini header__addBasicUserForm',
            'i' => $this->i,
            'usersession' => $usersession,
            'induk' => $datainduk,
            'kategori' => $kategori,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/edit-dataInduk', $data);
    }

    // Profile Method (Done)
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
            'css' => 'styles-admin-profile.css',
            'tahun' => $data_user['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/profile', $data);
    }

    // Standar Method (Done)
    public function standar()
    {
        $usersession = $this->data_user;
        $standar = $this->standarModel->getAllStandar();
        $data_user = $this->data_user;

        $data = [
            'title' => 'Daftar Standar | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'standar',
            'css' => 'styles-admin-standar.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'standar' => $standar,
            'tahun' => $data_user['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/standar', $data);
    }

    // Add standar method (Done)
    public function addStandarform()
    {
        $usersession = $this->data_user;
        $standar = $this->standarModel->getAllStandar();
        $kategori = $this->kategoriModel->findAll();

        $data = [
            'title' => 'Tambah Standar | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'standar',
            'css' => 'styles-admin-add-standar.css',
            'header' => 'header__mini header__addStandarForm',
            'i' => $this->i,
            'usersession' => $usersession,
            'standar' => $standar,
            'kategori' => $kategori,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/add-standar', $data);
    }

    // Edit Standar Method (Done)
    public function editStandarform($standar_id, $kategori_id)
    {
        $usersession = $this->data_user;
        $standar = $this->standarModel->getStandarByKategori($standar_id, $kategori_id);
        $kategori = $this->kategoriModel->findAll();

        $data = [
            'title' => 'Edit Standar | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'standar',
            'css' => 'styles-admin-edit-standar.css',
            'header' => 'header__mini header__addStandarForm',
            'i' => $this->i,
            'usersession' => $usersession,
            'standar' => $standar,
            'kategori' => $kategori,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/edit-standar', $data);
    }

    // view indikator
    public function viewIndikator($standar_id, $kategori_id)
    {
        $usersession = $this->data_user;
        $indikator = $this->indikatorModel->getIndikator($kategori_id, $standar_id);
        $kategori = $this->kategoriModel->getKategoriById($kategori_id);
        $standar = $this->standarModel->getStandarByKategori($standar_id, $kategori_id);

        $data = [
            'title' => 'Daftar Indikator | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'standar',
            'css' => 'styles-view-indikator.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'kategori' => $kategori,
            'standar' => $standar,
            'usersession' => $usersession,
            'indikator' => $indikator,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/view-indikator', $data);
    }

    // Add Indikator Method
    public function addIndikatorform($standar_id, $kategori_id)
    {
        $usersession = $this->data_user;
        $standar = $this->standarModel->getStandarByKategori($standar_id, $kategori_id);
        $kategori = $this->kategoriModel->getKategoriById($kategori_id);
        $indikator = $this->indikatorModel->getIndikator($kategori_id, $standar_id);

        $data = [
            'title' => 'Tambah Indikator | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'standar',
            'css' => 'styles-admin-add-indikator.css',
            'header' => 'header__mini header__addIndikatorForm',
            'i' => $this->i,
            'usersession' => $usersession,
            'standar' => $standar,
            'kategori' => $kategori,
            'indikator' => $indikator,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/add-indikator', $data);
    }

    // Edit Indikator Method
    public function editIndikatorform($standar_id, $kategori_id, $indikator_id)
    {
        $usersession = $this->data_user;
        $standar = $this->standarModel->getStandarByKategori($standar_id, $kategori_id);
        $kategori = $this->kategoriModel->getKategoriById($kategori_id);
        $indikator = $this->indikatorModel->getIndikatorById($indikator_id);

        $data = [
            'title' => 'Edit Indikator | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'standar',
            'css' => 'styles-admin-edit-indikator.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'standar' => $standar,
            'kategori' => $kategori,
            'indikator' => $indikator,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];

        return view('admin/edit-indikator', $data);
    }

    //auto generate data induk (Done)
    public function autoGenerateDataInduk()
    {
        $usersession = $this->data_user;
        $daftartahun = $this->tahunModel->findAll();
        $daftarunit = $this->unitsModel->findAll();
        $indukPEN = $this->dataIndukModel->getIndukByKategoriId('PEN');
        $indukPPM = $this->dataIndukModel->getIndukByKategoriId('PPM');

        $data = [
            'title' => 'Auto Generate Data Induk | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'induk',
            'css' => 'styles-admin-add-indikator.css',
            'header' => 'header__mini header__autoGenerateDataInduk',
            'i' => $this->i,
            'usersession' => $usersession,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
            'daftartahun' => $daftartahun,
            'daftarunit' => $daftarunit,
            'indukPEN' => $indukPEN,
            'indukPPM' => $indukPPM,
        ];

        return view('admin/auto-generate-data-induk', $data);
    }

    //auto generate penilaian (Done)
    public function autoGeneratePenilaian()
    {
        $usersession = $this->data_user;
        $daftartahun = $this->tahunModel->findAll();
        $daftarunit = $this->unitsModel->findAll();
        $standarPEN = $this->standarModel->getStandarByKategoriId('PEN');
        $standarPPM = $this->standarModel->getStandarByKategoriId('PPM');

        $data = [
            'title' => 'Auto Generate Penilaian | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'penilaian',
            'css' => 'styles-admin-add-indikator.css',
            'header' => 'header__mini header__autoGeneratePenilaian',
            'i' => $this->i,
            'usersession' => $usersession,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
            'daftartahun' => $daftartahun,
            'daftarunit' => $daftarunit,
            'standarPEN' => $standarPEN,
            'standarPPM' => $standarPPM,
        ];

        return view('admin/auto-generate-penilaian', $data);
    }

    // penilaian
    public function penilaian()
    {
        $users = $this->usersModel->findAll();
        $usersession = $this->data_user;
        $data = [
            'title' => 'Penilaian | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'penilaian',
            'css' => 'styles-admin-penilaian.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'users' => $users,
            'usersession' => $usersession,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">',
        ];

        return view('admin/penilaian', $data);
    }

    // Report Method
    public function report()
    {
        $users = $this->usersModel->findAll();
        $usersession = $this->data_user;
        $data = [
            'title' => 'Report | SIPMPP Admin UNDIP ' . $this->thisTahun,
            'tab' => 'report',
            'css' => 'styles-admin-report.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'users' => $users,
            'usersession' => $usersession,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
            'cssCustom' => '',
        ];
        return view('admin/report', $data);
    }

    // Swith Tahun Method (Done)
    public function switchTahun()
    {
        $data_user = $this->data_user;
        $tahun = $this->request->getVar('tahun');

        $datasession = [
            'email' => $data_user['email'],
            'nama' => $data_user['nama'],
            'foto' => $data_user['foto'],
            'role_id' => $data_user['role_id'],
            'role' => $data_user['role'],
            'tahun' => $tahun,
            'isLoggedIn' => true,
        ];

        $this->session->set($datasession);

        return redirect()->to(base_url('/admin/index'));
    }
}
