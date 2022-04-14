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

use App\Controllers\Generator;

class Savedata extends BaseController
{
    protected $generator;
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
        $this->generator = new Generator();
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
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span>Email sudah terdaftar!</span></div>');

            return redirect()->to(base_url('admin/adduserform'));
        } else {
            $data = [
                'email' => $email,
                'nama' => $nama,
                'password' => $password,
            ];

            $this->usersModel->insert($data);
            // Set flashdata gagal dan kirim pesan eror dengan flashdata
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span>User berhasil ditambahkan!</span></div>');
            return redirect()->to(base_url('admin/daftaruser'));
        }
    }

    // Add user role unit method (Done)
    public function addBasicUser($role)
    {
        $data = $this->request->getPost();
        $email = $this->request->getVar('user');
        $role_id = $this->roleModel->getRole($role);
        $role_id = (int)$role_id['role_id'];

        if ($role != 'pimpinan') {
            $unit_id = $data['unit'];
        }
        $tahun = $data['tahun'];
        // dd($tahun);

        if ($role == 'pimpinan') {
            $unit_id = 'lppm';
            foreach ($tahun as $key => $value) {
                $cek = $this->userroleunitModel->getDataSpec($email, $value, $role, $unit_id);
                if ($cek == null) {
                    $data = [
                        'email' => $email,
                        'role_id' => $role_id,
                        'unit_id' => $unit_id,
                        'tahun' => $value,
                    ];
                    $this->userroleunitModel->insert($data);
                }
            }
        } else {
            foreach ($unit_id as $unit) {
                foreach ($tahun as $key => $value) {
                    $cek = $this->userroleunitModel->getDataSpec($email, $value, $role, $unit);
                    if ($cek == null) {
                        $data = [
                            'email' => $email,
                            'role_id' => $role_id,
                            'unit_id' => $unit,
                            'tahun' => $value,
                        ];
                        $this->userroleunitModel->insert($data);
                    }
                }
            }
        }

        // Set flashdata gagal dan kirim pesan eror dengan flashdata
        $this->session->setFlashdata('msg', '<div class="alert alert-success alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span>User berhasil ditambahkan!</span></div>');
        if ($role == 'user') {
            return redirect()->to(base_url('admin/user'));
        } else if ($role == 'auditor') {
            return redirect()->to(base_url('admin/auditor'));
        } else {
            return redirect()->to(base_url('admin/leader'));
        }
    }

    // Add Unit method (Done)
    public function addunit()
    {
        $nama_unit = $this->request->getVar('nama_unit');

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

        if ($unit != null) {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span>Unit telah ada! Silakan menambahkan unit lain.</span></div>');

            return redirect()->to(base_url('admin/units'));
        } else {
            $data = [
                'unit_id' => $id,
                'nama_unit' => $nama_unit,
            ];

            $this->unitsModel->insert($data);

            // Set flashdata gagal dan kirim pesan eror dengan flashdata
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span>Unit berhasil ditambahkan!</span></div>');

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
            $this->session->setFlashdata('msg', '<div class="alert alert-danger alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span>Kategori sudah ada!</span></div>');
            return redirect()->to(base_url('admin/kategori'));
        } else {
            $data = [
                'kategori_id' => $id,
                'nama_kategori' => $kategori,
            ];

            $this->kategoriModel->insert($data);

            // Set flashdata gagal dan kirim pesan eror dengan flashdata
            $this->session->setFlashdata('msg', '<div class="alert alert-success alert__sipmpp alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span>Kategori berhasil ditambahkan!</span></div>');
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

        if ($data) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert__sipmpp" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span>Data Induk sudah ada!</span></div>');

            return redirect()->to(base_url('admin/dataInduk'));
        } else {
            $data = [
                'induk_id' => (int)$induk_id,
                'kategori_id' => $kategori_id,
                'kode' => $kode,
                'nama_induk' => $nama_induk
            ];
            $this->dataIndukModel->insert($data);

            session()->setFlashdata('message', '<div class="alert alert-success alert__sipmpp" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span>Data Induk berhasil ditambahkan!</span></div>');

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
            session()->setFlashdata('message', '<div class="alert alert-danger alert__sipmpp" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span>Data Standar sudah ada!</span></div>');

            return redirect()->to(base_url('admin/standar'));
        } else {
            $data = [
                'standar_id' => $standar_id,
                'NoStd' => $NoStd,
                'kategori_id' => $kategori_id,
                'nama_standar' => $standar,
            ];

            $this->standarModel->insert($data);

            session()->setFlashdata('message', '<div class="alert alert-success alert__sipmpp" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span>Data Standar berhasil ditambahkan!</span></div>');

            return redirect()->to(base_url('admin/standar'));
        }
    }

    // Insert Indikator Method
    public function insertIndikator($standar_id, $kategori_id)
    {
        $data = $this->request->getPost();
        $nama_indikator = $data['indikator'];
        $target = $data['target'];
        $induk_id = $data['kebutuhan_data'];
        $nilai_acuan = $data['nilai_patokan'];
        $satuan = $data['satuan'];
        $keterangan = $data['keterangan'];

        $allindikator = $this->indikatorModel->getIndikator($kategori_id, $standar_id);
        $i = 1;
        foreach ($allindikator as $all) {
            if ($all['indikator_id'] == $i) {
                $i++;
            }
        }

        $dataindikator = $this->indikatorModel->findIndikator($i, $kategori_id, $standar_id);

        if ($dataindikator) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert__sipmpp" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span>Data Indikator sudah ada!</span></div>');

            return redirect()->to(base_url('/admin/addIndikatorform/' . $standar_id . ' / ' . $kategori_id));
        } else {
            $data = [
                'indikator_id' => $i,
                'kategori_id' => $kategori_id,
                'standar_id' => $standar_id,
                'nama_indikator' => $nama_indikator,
                'target' => $target,
                'nilai_acuan' => $nilai_acuan,
                'satuan' => $satuan,
                'keterangan' => $keterangan,
                'induk_id' => $induk_id,
            ];

            $this->indikatorModel->insert($data);

            session()->setFlashdata('message', '<div class="alert alert-success alert__sipmpp" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span>Data Indikator berhasil ditambahkan!</span></div>');

            return redirect()->to(base_url('/admin/viewIndikator/' . $standar_id . '/' . $kategori_id));
        }
    }

    // Save Auto Generator for Data Induk (Done)
    public function indukgenerator()
    {
        $tahun = $this->request->getPost(['tahun'])['tahun'];
        $unit = $this->request->getPost(['unit'])['unit'];
        $dataIndukPenelitian = $this->request->getPost(['dataIndukPenelitian'])['dataIndukPenelitian'];
        $dataIndukPengabdian = $this->request->getPost(['dataIndukPengabdian'])['dataIndukPengabdian'];

        $countpen = 0;
        $countppm = 0;
        foreach ($tahun as $year) {
            foreach ($unit as $units) {
                foreach ($dataIndukPenelitian as $pen) {
                    $respon = $this->generator->indukGenerator($year, $units, $pen, 'PEN');
                    if ($respon == "200") {
                        $countpen++;
                    }
                }
                foreach ($dataIndukPengabdian as $ppm) {
                    $respon = $this->generator->indukGenerator($year, $units, $ppm, 'PPM');
                    if ($respon == "200") {
                        $countppm++;
                    }
                }
            }
        }
        $sum = $countpen + $countppm;
        session()->setFlashdata('message', '<div class="alert alert-success alert__sipmpp" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span> ' . $sum . ' data telah ditambahkan.</span></div>');
        return redirect()->to('/admin/isianDataInduk');
    }

    // Save Auto Generator for Penilaian
    public function penilaiangenerator()
    {
        $tahun = $this->request->getPost(['tahun'])['tahun'];
        $unit = $this->request->getPost(['unit'])['unit'];
        $standarPenelitian = $this->request->getPost(['standarPenelitian'])['standarPenelitian'];
        $standarPengabdian = $this->request->getPost(['standarPengabdian'])['standarPengabdian'];

        $countpen = 0;
        $countppm = 0;
        foreach ($tahun as $year) {
            foreach ($unit as $units) {
                foreach ($standarPenelitian as $pen) {
                    $data = $this->indikatorModel->getIndikator('PEN', $pen);
                    foreach ($data as $indikator) {
                        $respon = $this->generator->penilaianGenerator($year, $units, $pen, $indikator['indikator_id'], 'PEN');
                        if ($respon == "200") {
                            $countpen++;
                        }
                    }
                }
                foreach ($standarPengabdian as $ppm) {
                    $data = $this->indikatorModel->getIndikator('PPM', $ppm);
                    foreach ($data as $indikator) {
                        $respon = $this->generator->penilaianGenerator($year, $units, $pen, $indikator['indikator_id'], 'PPM');
                        if ($respon == "200") {
                            $countppm++;
                        }
                    }
                }
            }
        }

        $sum = $countpen + $countppm;
        session()->setFlashdata('message', '<div class="alert alert-success alert__sipmpp" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span> ' . $sum . ' data telah ditambahkan.</span></div>');
        return redirect()->to('/admin/penilaian');
    }
}
