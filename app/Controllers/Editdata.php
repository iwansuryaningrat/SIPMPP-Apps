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

class Editdata extends BaseController
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

    // Edit unit method (Done)
    public function editunit()
    {
        $unit_id = $this->request->getVar('unit_id');
        $nama_unit = $this->request->getVar('nama_unit');
        // dd($unit_id, $nama_unit);

        $unit = $this->unitsModel->getUnit($unit_id);

        if ($unit != null) {

            $this->unitsModel->updateUnit($unit_id, $nama_unit);

            // Set flashdata gagal dan kirim pesan eror dengan flashdata
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span>Unit berhasil diubah!</span></div>');

            return redirect()->to(base_url('admin/units'));
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span>Unit tidak ditemukan!</span></div>');

            return redirect()->to(base_url('admin/units'));
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
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span>Kategori berhasil diubah!</span></div>');

            return redirect()->to(base_url('admin/kategori'));
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span>Kategori sudah ada!</span></div>');

            return redirect()->to(base_url('admin/kategori'));
        }
    }

    // Update data induk
    public function updateInduk($induk_id, $kategori_id)
    {
        $kode = $this->request->getVar('kode');
        $nama_induk = $this->request->getVar('nama_induk');

        $this->dataIndukModel->updateInduk($induk_id, $kategori_id, $kode, $nama_induk);

        // Set flashdata gagal dan kirim pesan eror dengan flashdata
        $this->session->setFlashdata('message', '<div class="alert alert-success alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span>Data Induk berhasil diubah!</span></div>');

        return redirect()->to(base_url('admin/datainduk'));
    }

    // Edit Password Method (Done)
    public function editPassword()
    {
        $data_user = $this->data_user;
        $user = $this->usersModel->getUserByEmail($data_user['email']);

        $old_password = $this->request->getVar('oldPassword');
        $new_password = $this->request->getVar('newPassword');

        // Cek apakah password lama sama dengan password lama
        if (password_verify($old_password, $user['password'])) {
            // Cek apakah password baru sama dengan password lama
            if ($old_password == $new_password) {
                $this->session->setFlashdata('pwdmessage', '<div class="alert alert-danger alert__sipmpp" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span><strong>Maaf!</strong> Password baru tidak boleh sama dengan password lama.</span></div>');

                return redirect()->to('/admin/profile/');
            } else {
                // Update Password
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $this->usersModel->updatePassword($data_user['email'], $new_password);

                $this->session->setFlashdata('pwdmessage', '<div class="alert alert-success alert__sipmpp" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span><strong>Selamat!</strong> Password berhasil diubah.</span></div>');

                return redirect()->to('/admin/profile/');
            }
        } else {
            $this->session->setFlashdata('pwdmessage', '<div class="alert alert-danger alert__sipmpp" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span><strong>Maaf!</strong> Password lama tidak sesuai.</span></div>');

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
            if ($namafoto != 'default.png') {
                unlink('profile/' . $namafoto);
            }
            // set nama foto baru
            $namafoto = $foto->getMTime() . '-' . $foto->getName();
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
            'unit_id' => $data_user['unit_id'],
            'unit' => $data_user['unit'],
            'tahun' => $data_user['tahun'],
            'isLoggedIn' => true,
        ];

        $this->session->set($datasession);

        $this->session->setFlashdata('profilemessage', '<div class="alert alert-success alert__sipmpp" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span><strong>Selamat!</strong> Data berhasil diubah.</span></div>');

        return redirect()->to('/admin/profile/');
    }

    // Update Standar Method (Done)
    public function editStandar($standar_id, $kategori_id)
    {
        $nama_standar = $this->request->getVar('namaStandar');

        $this->standarModel->updateStandar($standar_id, $kategori_id, $nama_standar);

        session()->setFlashdata('message', '<div class="alert alert-success alert__sipmpp" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span>Data Standar berhasil diubah!</span></div>');

        return redirect()->to(base_url('admin/standar'));
    }

    // Update Indikator Method (Done)
    public function editIndikator($indikator_id, $kategori_id, $standar_id)
    {
        $data = $this->request->getPost();
        $nama_indikator = $data['indikator'];
        $target = $data['target'];
        $induk_id = $data['kebutuhan_data'];
        $nilai_acuan = $data['nilai_patokan'];
        $satuan = $data['satuan'];
        $keterangan = $data['keterangan'];

        $datas = [
            'indikator_id' => $indikator_id,
            'kategori_id' => $kategori_id,
            'standar_id' => $standar_id,
            'nama_indikator' => $nama_indikator,
            'target' => $target,
            'nilai_acuan' => $nilai_acuan,
            'satuan' => $satuan,
            'keterangan' => $keterangan,
            'induk_id' => $induk_id,
        ];

        if ($datas) {
            $this->indikatorModel->updateIndikator($indikator_id, $kategori_id, $standar_id, $datas);
        }

        session()->setFlashdata('message', '<div class="alert alert-success alert__sipmpp" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span>Data Indikator berhasil ditambahkan!</span></div>');

        return redirect()->to(base_url('/admin/viewIndikator/' . $standar_id . '/' . $kategori_id));
    }
}
