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
