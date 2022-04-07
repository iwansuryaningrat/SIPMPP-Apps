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

class Savedata extends BaseController
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

    // Add data induk method (Done)
    public function adddatainduk()
    {
        $kategori_id = $this->request->getVar('kategori_id');
        $induk_id = $this->request->getVar('induk_id');
        $kode = $this->request->getVar('kode');
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
                'kode' => $kode,
                'nama_induk' => $nama_induk
            ];
            $this->dataIndukModel->insert($data);
            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data Induk berhasil ditambahkan!</div>');
            return redirect()->to(base_url('admin/dataInduk'));
        }
    }

    // Save Standar Method (Done)
    public function addstandar()
    {
        $kategori_id = $this->request->getVar('kategori_id');
        $standar = $this->request->getVar('namaStandar');
        $standar_id = $this->request->getVar('kode');
        $lenth = strlen($standar_id);
        $NoStd = substr($standar_id, 1, $lenth - 1);

        $datastandar = $this->standarModel->getStandarByKategori($standar_id, $kategori_id);

        if ($datastandar) {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">
            Data Standar sudah ada!
            </div>');
            return redirect()->to(base_url('admin/standar'));
        } else {
            $data = [
                'standar_id' => $standar_id,
                'NoStd' => $NoStd,
                'kategori_id' => $kategori_id,
                'nama_standar' => $standar,
            ];

            // dd($data);

            $this->standarModel->insert($data);
            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
            Data Standar berhasil ditambahkan!
            </div>');
            return redirect()->to(base_url('admin/standar'));
        }
    }

    // Insert Indikator Method
    public function insertIndikator($standar_id, $kategori_id)
    {
        $indikator = $this->request->getVar('indikator');
        $bobot = $this->request->getVar('bobot');
        $keterangan = $this->request->getVar('keterangan');

        $dataindikator = $this->indikatorModel->getIndikator($kategori_id, $standar_id);

        if ($dataindikator) {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">
            Data Indikator sudah ada!
            </div>');
            return redirect()->to(base_url('admin/standar'));
        } else {
            $data = [
                'standar_id' => $standar_id,
                'kategori_id' => $kategori_id,
                'indikator' => $indikator,
                'bobot' => $bobot,
                'keterangan' => $keterangan,
            ];

            // dd($data);

            $this->indikatorModel->insert($data);
            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
            Data Indikator berhasil ditambahkan!
            </div>');
            return redirect()->to(base_url('admin/standar'));
        }
    }

    // Save Auto Generator for Data Induk
    public function indukgenerator()
    {
        $data = $this->request->getPost('tahun');
        dd($data);
    }

    // Save Auto Generator for Penilaian
    public function penilaiangenerator()
    {
        $data = $this->request->getPost();
        dd($data);
    }
}
