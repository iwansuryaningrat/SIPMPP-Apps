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
use App\Models\UserUnitModel;
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
    protected $userunitModel;
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
        $this->userunitModel = new UserUnitModel();
        $this->userroleunitModel = new UserRoleUnitModel();
        $this->data_user = [
            'email' => session()->get('email'),
            'nama' => session()->get('nama'),
            'foto' => session()->get('foto'),
            'role_id' => session()->get('role_id'),
            'role' => session()->get('role'),
            'tahun' => session()->get('tahun'),
        ];
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
            'tahun' => $this->tahunModel->findAll(),
            'units' => $units,
        ];


        return view('admin/index', $data);
    }

    //daftar user (Done)
    public function daftarUser()
    {
        $users = $this->usersModel->findAll();
        $data = [
            'title' => 'Daftar User | SIPMPP Admin UNDIP',
            'tab' => 'user',
            'css' => 'styles-admin-daftar-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $this->data_user,
            'users' => $users
        ];

        return view('admin/daftar-user', $data);
    }

    // User Method (Kurang parsing data units)
    public function user()
    {
        $usersession = $this->data_user;
        $users = $this->userroleunitModel->getData();
        // dd($users);

        $data = [
            'title' => 'Base User | SIPMPP Admin UNDIP',
            'tab' => 'user',
            'css' => 'styles-admin-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'users' => $users
        ];

        return view('admin/user-baseuser', $data);
    }

    // Leader Method (Kurang parsing data units)
    public function leader()
    {
        $usersession = $this->data_user;
        $users = $this->userroleunitModel->getData();
        // dd($users);

        $data = [
            'title' => 'Pimpinan | SIPMPP Admin UNDIP',
            'tab' => 'user',
            'css' => 'styles-admin-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'users' => $users
        ];

        return view('admin/user-leader', $data);
    }

    // Auditor Method (Done)
    public function auditor()
    {
        $usersession = $this->data_user;
        $users = $this->userroleunitModel->getData();
        // dd($users);

        $data = [
            'title' => 'Auditor | SIPMPP Admin UNDIP',
            'tab' => 'user',
            'css' => 'styles-admin-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'users' => $users
        ];

        return view('admin/user-auditor', $data);
    }

    // units Method (Done)
    public function units()
    {
        $usersession = $this->data_user;
        $units = $this->unitsModel->findAll();

        $data = [
            'title' => 'Daftar Unit | SIPMPP Admin UNDIP',
            'tab' => 'unit',
            'css' => 'styles-admin-unit.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'units' => $units
        ];

        return view('admin/units', $data);
    }

    // Data Induk Method
    public function dataInduk()
    {
        $usersession = $this->data_user;
        $induk = $this->dataIndukModel->getInduk();
        // dd($induk);

        $data = [
            'title' => 'Data Induk | SIPMPP Admin UNDIP',
            'tab' => 'induk',
            'css' => 'styles-admin-data-induk.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'induk' => $induk
        ];

        return view('admin/dataInduk', $data);
    }

    //view data induk method
    public function viewDataInduk()
    {
        return view('admin/view-dataInduk');
    }

    // Standar Method
    public function standar()
    {

        $usersession = $this->data_user;
        $standar = $this->standarModel->getAllStandar();
        // dd($standar);

        $data = [
            'title' => 'Daftar Standar | SIPMPP Admin UNDIP',
            'tab' => 'standar',
            'css' => 'styles-admin-standar.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'standar' => $standar
        ];

        return view('admin/standar', $data);
    }

    //view standar method
    public function viewStandar()
    {
        return view('admin/view-standar');
    }

    //view indikator
    public function viewIndikator($standar_id, $kategori_id)
    {
        $usersession = $this->data_user;
        $indikator = $this->indikatorModel->getIndikator($kategori_id, $standar_id);

        // dd($indikator);
        $data = [
            'title' => 'Daftar Indikator | SIPMPP Admin UNDIP',
            'tab' => 'standar',
            'css' => 'styles-admin-standar.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'indikator' => $indikator
        ];

        return view('admin/view-indikator', $data);
    }

    //penilaian
    public function penilaian()
    {
        return view('admin/penilaian');
    }

    // Report Method
    public function report()
    {
        return view('admin/report');
    }

    // FORM METHOD

    //Add user form method (Done)
    public function addUserForm()
    {
        $data = [
            'title' => 'Form Tambah User | SIPMPP Admin UNDIP',
            'tab' => 'user',
            'css' => 'styles-admin-add-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $this->data_user,
        ];
        return view('admin/add-user', $data);
    }

    // add basic user Form (Done)
    public function addBasicUserform()
    {
        $users = $this->usersModel->findAll();
        $units = $this->unitsModel->findAll();
        $tahun = $this->tahunModel->findAll();
        $role = $this->roleModel->getRole('user');
        // dd($role, $tahun, $units, $users);
        $data = [
            'title' => 'Form Tambah User | SIPMPP Admin UNDIP',
            'tab' => 'user',
            'css' => 'styles-admin-add-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $this->data_user,
            'users' => $users,
            'units' => $units,
            'tahun' => $tahun,
            'role' => $role,
        ];

        return view('admin/add-base-user', $data);
    }

    // add auditor Form (Done)
    public function addAuditor()
    {
        $users = $this->usersModel->findAll();
        $units = $this->unitsModel->findAll();
        $tahun = $this->tahunModel->findAll();
        $role = $this->roleModel->getRole('auditor');
        // dd($role, $tahun, $units, $users);
        $data = [
            'title' => 'Form Tambah Auditor | SIPMPP Admin UNDIP',
            'tab' => 'user',
            'css' => 'styles-admin-add-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $this->data_user,
            'users' => $users,
            'units' => $units,
            'tahun' => $tahun,
            'role' => $role,
        ];

        return view('admin/add-auditor', $data);
    }

    // add leader Form (Done)
    public function addLeader()
    {
        $users = $this->usersModel->findAll();
        $units = $this->unitsModel->findAll();
        $tahun = $this->tahunModel->findAll();
        $role = $this->roleModel->getRole('pimpinan');
        // dd($role, $tahun, $units, $users);
        $data = [
            'title' => 'Form Tambah User Pimpinan | SIPMPP Admin UNDIP',
            'tab' => 'user',
            'css' => 'styles-admin-add-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $this->data_user,
            'users' => $users,
            'units' => $units,
            'tahun' => $tahun,
            'role' => $role,
        ];

        return view('admin/add-leader', $data);
    }

    //add data induk method (Done)
    public function addDataIndukForm()
    {
        $usersession = $this->data_user;
        $induk = $this->dataIndukModel->getInduk();
        $kategori = $this->kategoriModel->findAll();

        $data = [
            'title' => 'Form Add Data Induk | SIPMPP Admin UNDIP',
            'tab' => 'induk',
            'css' => 'styles-admin-add-datainduk.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'induk' => $induk,
            'kategori' => $kategori
        ];

        return view('admin/add-dataInduk', $data);
    }

    // Add data induk method (Done)
    public function adddatainduk()
    {
        $kategori_id = $this->request->getVar('kategori_id');
        $induk_id = $this->request->getVar('induk_id');
        $nama_induk = $this->request->getVar('nama_induk');

        $data = $this->dataIndukModel->getIndukById($induk_id, $kategori_id);
        // dd($data);
        if ($data) {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Data Induk sudah ada!</div>');
            return redirect()->to(base_url('admin/dataInduk'));
        } else {
            $data = [
                'induk_id' => (int)$induk_id,
                'kategori_id' => $kategori_id,
                'nama_induk' => $nama_induk
            ];
            $this->dataIndukModel->insert($data);
            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data Induk berhasil ditambahkan!</div>');
            return redirect()->to(base_url('admin/dataInduk'));
        }
    }

    //Add standar method (Done)
    public function addStandarform()
    {
        $usersession = $this->data_user;
        $standar = $this->standarModel->getAllStandar();
        $kategori = $this->kategoriModel->findAll();
        // dd($standar);

        $data = [
            'title' => 'Tambah Standar | SIPMPP Admin UNDIP',
            'tab' => 'standar',
            'css' => 'styles-admin-add-standar.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'standar' => $standar,
            'kategori' => $kategori
        ];

        return view('admin/add-standar', $data);
    }

    // Save Standar Method (Done)
    public function addstandar()
    {
        $kategori_id = $this->request->getVar('kategori_id');
        $standar = $this->request->getVar('namaStandar');
        $standar_id = $this->request->getVar('kode');
        // dd($kategori_id, $standar, $standar_id);

        $datastandar = $this->standarModel->getStandarByKategori($standar_id, $kategori_id);

        if ($datastandar) {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">
            Data Standar sudah ada!
            </div>');
            return redirect()->to(base_url('admin/standar'));
        } else {
            $data = [
                'kategori_id' => $kategori_id,
                'nama_standar' => $standar,
                'standar_id' => $standar_id
            ];

            // dd($data);

            $this->standarModel->insert($data);
            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
            Data Standar berhasil ditambahkan!
            </div>');
            return redirect()->to(base_url('admin/standar'));
        }
    }


    // FORM ACTION METHOD

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

    // Add user role unit method (Done)
    public function addBasicUser($role)
    {
        $email = $this->request->getVar('user');
        $role_id = $this->roleModel->getRole($role);
        $role_id = (int)$role_id['role_id'];

        if ($role == 'pimpinan') {
            $unit = 'lppm';
        } else {
            $unit = $this->request->getVar('unit');
        }
        $tahun = (int)$this->request->getVar('tahun');

        $data = [
            'email' => $email,
            'role_id' => $role_id,
            'unit_id' => $unit,
            'tahun' => $tahun,
        ];

        // Insert data ke User Role Unit
        $this->userroleunitModel->insert($data);

        // Set flashdata gagal dan kirim pesan eror dengan flashdata
        $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">User berhasil ditambahkan!</div>');
        return redirect()->to(base_url('admin/daftaruser'));
    }

    // Add Unit method
    public function addunit()
    {
        $nama_unit = $this->request->getVar('nama_unit');
        // dd($unit);

        function split_name($name)
        {
            $name = trim($name);
            $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
            $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
            return array($first_name, $last_name);
        }

        if (split_name($nama_unit)[1] != '') {
            $id = strtolower(split_name($nama_unit)[1]);
        } else {
            $id = strtolower(split_name($nama_unit)[0]);
        }
        // dd($id);

        // Get unit by id
        $unit = $this->unitsModel->getUnit($id);
        // dd($unit);

        if ($unit != null) {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Unit telah ada! Silakan menambahkan unit lain.</div>');
            return redirect()->to(base_url('admin/units'));
        } else {
            $data = [
                'unit_id' => $id,
                'nama_unit' => $nama_unit,
            ];

            $this->unitsModel->insert($data);

            // Set flashdata gagal dan kirim pesan eror dengan flashdata
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">Unit berhasil ditambahkan!</div>');
            return redirect()->to(base_url('admin/units'));
        }
    }

    // Edit unit method (Done)
    public function editunit()
    {
        $unit_id = $this->request->getVar('unit_id');
        $nama_unit = $this->request->getVar('nama_unit');

        $unit = $this->unitsModel->getUnit($unit_id);

        if ($unit != null) {
            $data = [
                'unit_id' => $unit_id,
                'nama_unit' => $nama_unit,
            ];

            dd($data);

            $this->unitsModel->update($unit_id, $data);

            // Set flashdata gagal dan kirim pesan eror dengan flashdata
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">Unit berhasil diubah!</div>');
            return redirect()->to(base_url('admin/units'));
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Unit tidak ditemukan!</div>');
            return redirect()->to(base_url('admin/units'));
        }
    }

    // GENERATOR

    // Generate data induk method (Need Testing)
    public function generateDataInduk($tahun = null)
    {
        if ($tahun == null) {
            $tahun = (int)date('Y');
        }

        $datainduk = $this->dataIndukModel->findAll();
        $units = $this->unitsModel->findAll();

        foreach ($units as $unit) {
            foreach ($datainduk as $induk) {
                $data = [
                    'unit_id' => $unit['unit_id'],
                    'tahun' => $tahun,
                    'induk_id' => $induk['induk_id'],
                    'nilai' => 0,
                ];

                $this->unitIndukTahunModel->insert($data);
            }
        }

        // Set flashdata sukses
        $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data Induk berhasil digenerate setiap unit!</div>');
        return redirect()->to(base_url('admin/datainduk'));
    }

    // Generate standar method (Need Testing)
    public function generateStandar($tahun = null)
    {
        if ($tahun == null) {
            $tahun = (int)date('Y');
        }

        $units = $this->unitsModel->findAll();
        $indikator = $this->indikatorModel->findAll();

        foreach ($units as $unit) {
            foreach ($indikator as $stand) {
                $data = [
                    'tahun' => $tahun,
                    'kategori_id' => $stand['kategori_id'],
                    'standar_id' => $stand['standar_id'],
                    'indikator_id' => $stand['indikator_id'],
                    'unit_id' => $unit['unit_id'],
                    'status' => 'Belum Diisi',
                ];

                $this->penilaianModel->insert($data);
            }
        }

        // Set flashdata sukses
        $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">Standar berhasil digenerate setiap unit!</div>');
        return redirect()->to(base_url('admin/standar'));
    }

    //kategori page (Done)
    public function kategori()
    {
        $usersession = $this->data_user;
        $kategori = $this->kategoriModel->findAll();
        $data = [
            'title' => 'Daftar Unit | SIPMPP Admin UNDIP',
            'tab' => 'kategori',
            'css' => 'styles-admin-kategori.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'kategori' => $kategori
        ];

        return view('admin/kategori', $data);
    }

    // Add kategori method (Done)
    public function addkategori()
    {
        $kategori = $this->request->getVar('kategori');

        function name($name)
        {
            $name = trim($name);
            $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
            $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
            return array($first_name, $last_name);
        }

        if (name($kategori)[1] != '') {
            $id = name($kategori)[0] . '-' . name($kategori)[1];
            $id = strtolower($id);
        } else {
            $id = strtolower(name($kategori)[0]);
            $id = strtolower($id);
        }

        $datakategori = $this->kategoriModel->getKategoriById($id);

        if ($datakategori != null) {
            $data = [
                'kategori_id' => $id,
                'nama_kategori' => $kategori,
            ];

            $this->kategoriModel->insert($data);

            // Set flashdata gagal dan kirim pesan eror dengan flashdata
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">Kategori berhasil ditambahkan!</div>');
            return redirect()->to(base_url('admin/kategori'));
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Kategori sudah ada!</div>');
            return redirect()->to(base_url('admin/kategori'));
        }
    }

    // Edit kategori method (Done)
    public function editkategori()
    {
        $kategori = $this->request->getVar('kategori');
        $id = $this->request->getVar('id');

        $datakategori = $this->kategoriModel->getKategoriById($id);

        if ($datakategori != null) {

            $data = [
                'kategori_id' => $id,
                'nama_kategori' => $kategori,
            ];

            $this->kategoriModel->update($id, $data);

            // Set flashdata gagal dan kirim pesan eror dengan flashdata
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">Kategori berhasil diubah!</div>');
            return redirect()->to(base_url('admin/kategori'));
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Kategori sudah ada!</div>');
            return redirect()->to(base_url('admin/kategori'));
        }
    }

    //edit data induk page
    public function editDataInduk($induk_id, $kategori_id)
    {
        $usersession = $this->data_user;
        $datainduk = $this->dataIndukModel->getIndukById($induk_id, $kategori_id);
        // dd($datainduk);
        $kategori = $this->kategoriModel->findAll();

        $data = [
            'title' => 'Form Edit Data Induk | SIPMPP Admin UNDIP',
            'tab' => 'induk',
            'css' => 'styles-admin-add-datainduk.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'induk' => $datainduk,
            'kategori' => $kategori
        ];

        return view('admin/edit-dataInduk', $data);
    }

    // Update data induk
    public function updateInduk()
    {
        $induk_id = $this->request->getVar('induk_id');
        $kategori_id = $this->request->getVar('kategori_id');
        $nama_induk = $this->request->getVar('nama_induk');

        $data = [
            'induk_id' => $induk_id,
            'kategori_id' => $kategori_id,
            'nama_induk' => $nama_induk,
        ];

        $this->dataIndukModel->update($induk_id, $data);

        // Set flashdata gagal dan kirim pesan eror dengan flashdata
        $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data Induk berhasil diubah!</div>');
        return redirect()->to(base_url('admin/induk'));
    }

    // Profile Method (Done)
    public function profile()
    {
        $data_user = $this->data_user;
        $user = $this->usersModel->getUserByEmail($data_user['email']);

        $data = [
            'title' => 'Profile | SIPMPP UNDIP 2022',
            'data_user' => $data_user,
            'user' => $user,
            'tab' => 'profile',
            'header' => '',
            'css' => 'styles-admin-profile.css'
        ];

        return view('admin/profile', $data);
    }

    // Edit Password Method (Done)
    public function editPassword()
    {
        $data_user = $this->data_user;
        $user = $this->usersModel->getUserByEmail($data_user['email']);

        $old_password = $this->request->getVar('old-password');
        $new_password = $this->request->getVar('new-password');

        // Cek apakah password lama sama dengan password lama
        if (password_verify($old_password, $user['password'])) {
            // Cek apakah password baru sama dengan password lama
            if ($old_password == $new_password) {
                $this->session->setFlashdata('message', '<div class="alert alert-danger" role="alert"> <strong>Maaf!</strong> Password baru tidak boleh sama dengan password lama.</div>');
                return redirect()->to('/admin/profile/');
            } else {
                // Update Password
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $this->usersModel->updatePassword($data_user['email'], $new_password);

                $this->session->setFlashdata('message', '<div class="alert alert-success" role="alert"><strong>Selamat!</strong> Password berhasil diubah.</div>');
                return redirect()->to('/admin/profile/');
            }
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger" role="alert">
            <strong>Maaf!</strong> Password lama tidak sesuai.</div>');
            return redirect()->to('/admin/profile/');
        }
    }

    // Edit Profile Method (Done)
    public function editProfile()
    {
        $data_user = $this->data_user;
        $user = $this->usersModel->getUserByEmail($data_user['email']);

        // Mengambil foto profil
        $foto = $this->request->getFile('photo-profile');
        if ($foto->getError() == 4) {
            $namafoto = $user['foto'];
        } else {
            // Hapus foto lama
            $namafoto = $user['foto'];
            unlink('profile/' . $namafoto);
            // set nama foto baru
            $namafoto = 'foto-' . $user['email'] . '.' . $foto->getExtension();
            $foto->move('profile/', $namafoto);
        };

        $data = [
            'nama' => $this->request->getVar('fullname'),
            'nip' => $this->request->getVar('nip'),
            'telp' => $this->request->getVar('no-telp'),
            'foto' => $namafoto,
        ];

        // Update Data
        $this->usersModel->updateProfile($data_user['email'], $data);

        // Update Session
        $datasession = [
            'email' => $user['email'],
            'nama' => $data['nama'],
            'foto' => $data['foto'],
            'role_id' => $data_user['role_id'],
            'role' => $data_user['role'],
            'tahun' => $this->getTahun,
            'isLoggedIn' => true,
        ];

        $this->session->set($datasession);

        $this->session->setFlashdata('message', '<div class="alert alert-success" role="alert">
        <strong>Selamat!</strong> Data berhasil diubah.</div>');
        return redirect()->to('/admin/profile/');
    }
}
