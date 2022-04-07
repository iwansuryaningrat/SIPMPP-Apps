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
        // dd($users);

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
        // dd($role, $tahun, $units, $users);
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

    // Delete User Role Unit Method (Kurang kondisi hapus per unit tertentu)
    public function deleteUserRoleUnit($email, $role_id)
    {
        $this->userroleunitModel->deleteUserRoleUnit($email, $role_id);
        // Set flashdata gagal dan kirim pesan eror dengan flashdata
        $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">User berhasil dihapus!</div>');
        return redirect()->to(base_url('admin/daftaruser'));
    }

    // Leader Method (Done)
    public function leader()
    {
        $usersession = $this->data_user;
        $units = $this->userroleunitModel->getData();
        $users = $this->userroleunitModel->getDataEmailRole(4);
        // dd($users);

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
        // dd($role, $tahun, $units, $users);
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
        // dd($users);

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
        // dd($role, $tahun, $units, $users);
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

            // dd($data);

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

    // Data Induk Method (Done)
    public function dataInduk()
    {
        $usersession = $this->data_user;
        $induk = $this->dataIndukModel->getInduk();
        // dd($induk);

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
        // dd($datainduk);
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

    // Update data induk
    public function updateInduk()
    {
        $induk_id = $this->request->getVar('induk_id');
        $kode = $this->request->getVar('kode');
        $kategori_id = $this->request->getVar('kategori_id');
        $nama_induk = $this->request->getVar('nama_induk');

        $data = [
            'induk_id' => $induk_id,
            'kategori_id' => $kategori_id,
            'kode' => $kode,
            'nama_induk' => $nama_induk,
        ];
        // dd($data);

        $this->dataIndukModel->update($induk_id, $data);

        // Set flashdata gagal dan kirim pesan eror dengan flashdata
        $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data Induk berhasil diubah!</div>');
        return redirect()->to(base_url('admin/induk'));
    }

    // Delete data induk (Kurang delete Data yang menggunakan data induk)
    public function deleteInduk($induk_id, $kategori_id)
    {
        $data = $this->dataIndukModel->getIndukById($induk_id, $kategori_id);
        // dd($data);
        if ($data) {
            $this->unitIndukTahunModel->$this->dataIndukModel->deleteByInduk($induk_id, $kategori_id);
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data Induk berhasil dihapus!</div>');
            return redirect()->to(base_url('admin/induk'));
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data Induk tidak ditemukan!</div>');
            return redirect()->to(base_url('admin/induk'));
        }
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

    // Edit Password Method (Need Testing)
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

    // Edit Profile Method (Need Testing)
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

    // Standar Method (Done)
    public function standar()
    {
        $usersession = $this->data_user;
        $standar = $this->standarModel->getAllStandar();
        $data_user = $this->data_user;
        // dd($standar);

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
        // dd($standar);
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

    // Update Standar Method (Done)
    public function editStandar($standar_id, $kategori_id)
    {
        $nama_standar = $this->request->getVar('namaStandar');

        $this->standarModel->updateStandar($standar_id, $kategori_id, $nama_standar);
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
        Data Standar berhasil diubah!
        </div>');
        return redirect()->to(base_url('admin/standar'));
    }

    // Delete Standar Method
    public function deleteStandar($standar_id, $kategori_id)
    {
        $this->standarModel->deleteStandar($standar_id, $kategori_id);
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
        Data Standar berhasil dihapus!
        </div>');
        return redirect()->to(base_url('admin/standar'));
    }

    // view indikator
    public function viewIndikator($standar_id, $kategori_id)
    {
        $usersession = $this->data_user;
        $indikator = $this->indikatorModel->getIndikator($kategori_id, $standar_id);
        $kategori = $this->kategoriModel->getKategoriById($kategori_id);
        $standar = $this->standarModel->getStandarByKategori($standar_id, $kategori_id);

        // dd($indikator, $kategori, $standar);
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

    //auto generate data induk
    public function autoGenerateDataInduk()
    {
        $usersession = $this->data_user;

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
        ];

        return view('admin/auto-generate-data-induk', $data);
    }

    //auto generate penilaian
    public function autoGeneratePenilaian()
    {
        $usersession = $this->data_user;

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
        ];

        return view('admin/auto-generate-penilaian', $data);
    }

    //penilaian
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
