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
            'role_id' => session()->get('role_id'),
            'role' => session()->get('role'),
            'tahun' => session()->get('tahun'),
        ];
        $this->tahun = $this->userroleunitModel->getTahun($this->data_user['email'], $this->data_user['role_id']);
        $this->i = 1;

        $this->session = \Config\Services::session();
    }

    // Admin Dashboard Method
    public function index()
    {
        $usersession = $this->data_user;
        $units = $this->unitsModel->findAll();

        $data = [
            'title' => 'Dashboard SIPMPP | SIPMPP UNDIP 2022',
            'tab' => 'home',
            'css' => 'styles-admin-dashboard.css',
            'header' => 'header__big',
            'i' => $this->i,
            'usersession' => $usersession,
            'units' => $units,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
        ];


        return view('admin/index', $data);
    }

    // Daftar user (Done)
    public function daftarUser()
    {
        $users = $this->usersModel->findAll();
        $usersession = $this->data_user;
        $data = [
            'title' => 'Daftar User | SIPMPP Admin UNDIP',
            'tab' => 'user',
            'css' => 'styles-admin-daftar-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'users' => $users,
            'usersession' => $usersession,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
        ];

        return view('admin/daftar-user', $data);
    }

    //Add user form method (Done)
    public function addUserForm()
    {
        $usersession = $this->data_user;
        $data = [
            'title' => 'Form Tambah User | SIPMPP Admin UNDIP',
            'tab' => 'user',
            'css' => 'styles-admin-add-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
        ];

        return view('admin/add-user', $data);
    }

    // Add user method (Done)
    public function addUser()
    {
        $email = $this->request->getVar('email');
        $nama = $this->request->getVar('fullname');
        $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);

        // Validasi email
        $validation =  \Config\Services::validation();
        $valid = $this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
        ]);

        if (!$valid) {
            // Set flashdata gagal dan kirim pesan eror dengan flashdata
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Email sudah terdaftar!</div>');
            return redirect()->to(base_url('admin/adduserform'));
        } else {
            $data = [
                'email' => $email,
                'nama' => $nama,
                'password' => $password,
            ];

            $this->usersModel->insert($data);
            // Set flashdata gagal dan kirim pesan eror dengan flashdata
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">User berhasil ditambahkan!</div>');
            return redirect()->to(base_url('admin/daftaruser'));
        }
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
