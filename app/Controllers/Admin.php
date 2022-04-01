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

    // User Method (Kurang parsing data units)
    public function user()
    {
        $usersession = $this->data_user;
        $units = $this->userroleunitModel->getData();
        $users = $this->userroleunitModel->getDataEmailRole(1);
        // dd($users);

        $data = [
            'title' => 'Base User | SIPMPP Admin UNDIP',
            'tab' => 'user',
            'css' => 'styles-admin-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'users' => $users,
            'units' => $units,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
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
            'tahuns' => $tahun,
            'role' => $role,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
        ];

        return view('admin/add-base-user', $data);
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

    // Delete User Role Unit Method (Kurang kondisi hapus per unit tertentu)
    public function deleteUserRoleUnit($email, $role_id)
    {
        $this->userroleunitModel->deleteUserRoleUnit($email, $role_id);
        // Set flashdata gagal dan kirim pesan eror dengan flashdata
        $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">User berhasil dihapus!</div>');
        return redirect()->to(base_url('admin/daftaruser'));
    }

    // Leader Method (Kurang parsing data units)
    public function leader()
    {
        $usersession = $this->data_user;
        $units = $this->userroleunitModel->getData();
        $users = $this->userroleunitModel->getDataEmailRole(4);
        // dd($users);

        $data = [
            'title' => 'Pimpinan | SIPMPP Admin UNDIP',
            'tab' => 'user',
            'css' => 'styles-admin-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'users' => $users,
            'units' => $units,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
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
            'tahuns' => $tahun,
            'roles' => $role,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
        ];

        return view('admin/add-leader', $data);
    }

    // Auditor Method (Done)
    public function auditor()
    {
        $usersession = $this->data_user;
        $units = $this->userroleunitModel->getData();
        $users = $this->userroleunitModel->getDataEmailRole(3);
        // dd($users);

        $data = [
            'title' => 'Auditor | SIPMPP Admin UNDIP',
            'tab' => 'user',
            'css' => 'styles-admin-user.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'users' => $users,
            'units' => $units,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
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
            'tahuns' => $tahun,
            'roles' => $role,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
        ];

        return view('admin/add-auditor', $data);
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
            'units' => $units,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
        ];

        return view('admin/units', $data);
    }

    // Add Unit method (Done)
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

        $nama = explode(" ", $nama_unit);
        $count = count($nama);

        $id = $nama[0];
        if ($count > 1) {
            for ($i = 1; $i < $count; $i++) {
                $id .= $nama[$i];
            }
        }

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

    // Edit unit method
    public function editunit()
    {
        $unit_id = $this->request->getVar('unit_id');
        $nama_unit = $this->request->getVar('nama_unit');
        dd($unit_id, $nama_unit);

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

    // Delete unit method
    public function deleteunit($unit_id)
    {
        $unit = $this->unitsModel->getUnit($unit_id);

        if ($unit != null) {
            // Hapus Semua role user yang berhubungan dengan unit ini
            $this->userroleunitModel->deleteUnit($unit_id);
            $this->unitsModel->delete($unit_id);

            // Set flashdata gagal dan kirim pesan eror dengan flashdata
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">Unit berhasil dihapus!</div>');
            return redirect()->to(base_url('admin/units'));
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Unit tidak ditemukan!</div>');
            return redirect()->to(base_url('admin/units'));
        }
    }

    //kategori page (Done)
    public function kategori()
    {
        $usersession = $this->data_user;
        $kategori = $this->kategoriModel->findAll();
        $data = [
            'title' => 'Daftar Kategori | SIPMPP Admin UNDIP',
            'tab' => 'kategori',
            'css' => 'styles-admin-kategori.css',
            'header' => 'header__mini',
            'i' => $this->i,
            'usersession' => $usersession,
            'kategori' => $kategori,
            'tahun' => $usersession['tahun'],
            'tahunsession' => $this->tahun,
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

        $id = strtolower(name($kategori)[0]);
        $id = strtolower($id);


        $datakategori = $this->kategoriModel->getKategoriById($id);

        if ($datakategori != null) {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Kategori sudah ada!</div>');
            return redirect()->to(base_url('admin/kategori'));
        } else {
            $data = [
                'kategori_id' => $id,
                'nama_kategori' => $kategori,
            ];

            $this->kategoriModel->insert($data);

            // Set flashdata gagal dan kirim pesan eror dengan flashdata
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">Kategori berhasil ditambahkan!</div>');
            return redirect()->to(base_url('admin/kategori'));
        }
    }

    // Edit kategori method
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

    // Delete kategori method
    public function deletekategori($kategori_id)
    {
        $kategori = $this->kategoriModel->getKategoriById($kategori_id);

        if ($kategori != null) {
            $this->kategoriModel->delete($kategori_id);

            // Set flashdata gagal dan kirim pesan eror dengan flashdata
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">Kategori berhasil dihapus!</div>');
            return redirect()->to(base_url('admin/kategori'));
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Kategori tidak ditemukan!</div>');
            return redirect()->to(base_url('admin/kategori'));
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
