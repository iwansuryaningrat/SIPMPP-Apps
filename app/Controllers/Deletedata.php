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

class Deletedata extends BaseController
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

    // Delete User Role Unit Method (Kurang kondisi hapus per unit tertentu)
    public function deleteUserRoleUnit($email, $role_id)
    {
        $this->userroleunitModel->deleteUserRoleUnit($email, $role_id);
        // Set flashdata gagal dan kirim pesan eror dengan flashdata

        $this->session->setFlashdata('msg', '<div class="alert alert-success alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-minus color__success"></i><span>User berhasil dihapus!</span></div>');
        if ($role_id == 1) {
            return redirect()->to(base_url('admin/user'));
        } else if ($role_id == 3) {
            return redirect()->to(base_url('admin/auditor'));
        } else {
            return redirect()->to(base_url('admin/leader'));
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
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-minus color__success"></i><span>Unit berhasil dihapus!</span></div>');

            return redirect()->to(base_url('admin/units'));
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span>Unit tidak ditemukan!</span></div>');
            return redirect()->to(base_url('admin/units'));
        }
    }

    // Delete kategori method
    public function deletekategori($kategori_id)
    {
        $kategori = $this->kategoriModel->getKategoriById($kategori_id);

        if ($kategori != null) {
            $this->kategoriModel->delete($kategori_id);

            // Set flashdata gagal dan kirim pesan eror dengan flashdata
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-minus color__success"></i><span>Kategori berhasil dihapus!</span></div>');
            return redirect()->to(base_url('admin/kategori'));
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span>Kategori tidak ditemukan!</span></div>');
            return redirect()->to(base_url('admin/kategori'));
        }
    }

    // Delete data induk (Kurang delete Data yang menggunakan data induk)
    public function deleteInduk($induk_id, $kategori_id)
    {
        $data = $this->dataIndukModel->getIndukById($induk_id, $kategori_id);
        // dd($data);
        if ($data) {
            $this->unitIndukTahunModel->$this->dataIndukModel->deleteByInduk($induk_id, $kategori_id);
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-minus color__success"></i><span>Data Induk berhasil dihapus!</span></div>');

            return redirect()->to(base_url('admin/induk'));
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span>Data Induk tidak ditemukan!</span></div>');
            return redirect()->to(base_url('admin/induk'));
        }
    }

    // Delete Standar Method
    public function deleteStandar($standar_id, $kategori_id)
    {
        $this->standarModel->deleteStandar($standar_id, $kategori_id);
        session()->setFlashdata('message', '<div class="alert alert-success alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-minus color__success"></i><span>Data Standar berhasil dihapus!</span></div>');

        return redirect()->to(base_url('admin/standar'));
    }

    // Dellete Isian Data Induk
    public function deleteIsian($tahun, $unit_id, $induk_id, $kategori_id)
    {
        $this->unitIndukTahunModel->deleteIsian($tahun, $unit_id, $induk_id, $kategori_id);
        session()->setFlashdata('message', '<div class="alert alert-success alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-minus color__success"></i><span>Data Isian berhasil dihapus!</span></div>');

        return redirect()->to(base_url('admin/isianDataInduk'));
    }

    // Delete Penilaian
    public function deletePenilaian($tahun, $unit_id, $standar_id, $kategori_id)
    {
        $this->penilaianModel->deletePenilaian($tahun, $unit_id, $standar_id, $kategori_id);
        session()->setFlashdata('message', '<div class="alert alert-success alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-minus color__success"></i><span>Data Penilaian berhasil dihapus!</span></div>');

        return redirect()->to(base_url('admin/penilaian'));
    }
}
