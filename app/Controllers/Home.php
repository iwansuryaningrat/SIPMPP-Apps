<?php

namespace App\Controllers;

use App\Models\DataIndukModel;
use App\Models\IndikatorModel;
use App\Models\KategoriModel;
use App\Models\PenilaianModel;
use App\Models\StandarModel;
use App\Models\TahunModel;
use App\Models\UnitIndukTahunModel;
use App\Models\UnitsModel;
use App\Models\UsersModel;
use App\Models\UserRoleUnitModel;

class Home extends BaseController
{
    protected $dataIndukModel;
    protected $indikatorModel;
    protected $kategoriModel;
    protected $penilaianModel;
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
            'role' => session()->get('role'),
            'role_id' => session()->get('role_id'),
            'tahun' => session()->get('tahun'),
        ];
        $this->tahun = $this->userroleunitModel->getTahunRole($this->data_user['email'], $this->data_user['role_id'], $this->data_user['unit_id']);
        $this->i = 1;
        $this->session = \Config\Services::session();
        $this->thisTahun = (int)date('Y');
    }

    // Dashboard Method
    public function index()
    {
        $data_user = $this->data_user;
        $units = $this->unitsModel->findAll();
        // dd($units);

        $i = 1;

        $data = [
            'title' => 'Dashboard SIPMPP | SIPMPP UNDIP ' . $this->thisTahun,
            'data_user' => $data_user,
            'i' => $i,
            'tab' => 'home',
            'tahun' => $data_user['tahun'],
            'header' => 'header__big',
            'css' => 'styles-dashboard.css',
            'units' => $units,
            'tahunsession' => $this->tahun,
        ];

        return view('user/index', $data);
    }

    // Data Induk Method (Done)
    public function dataInduk()
    {
        $data_user = $this->data_user;
        $tahun = $data_user['tahun'];

        $unit_id = $data_user['unit_id'];

        // $data_induk = $this->unitIndukTahunModel->getIndukUnit($unit_id, $tahun);
        $data_indukPen = $this->unitIndukTahunModel->getIndukUnitKategori($unit_id, $tahun, 'PEN');
        // dd($data_induk);
        $data_indukPPM = $this->unitIndukTahunModel->getIndukUnitKategori($unit_id, $tahun, 'PPM');

        $i = 1;

        $data = [
            'title' => 'Data Induk | SIPMPP UNDIP ' . $this->thisTahun,
            'tab' => 'induk',
            'header' => 'header__mini header__datainduk',
            'css' => 'styles-data-induk.css',
            'i' => $i,
            'data_user' => $data_user,
            'data_indukPen' => $data_indukPen,
            'data_indukPPM' => $data_indukPPM,
            'tahunsession' => $this->tahun,
            'tahun' => $data_user['tahun'],
        ];

        return view('user/datainduk', $data);
    }

    // Edit Data Induk Method (Done)
    public function editDataInduk()
    {
        $user = $this->data_user;
        $tahun = $user['tahun'];
        $unit_id = $user['unit_id'];

        $induk_id = $this->request->getVar('induk_id');

        $nilai = $this->request->getVar('nilai');
        $kategori_id = $this->request->getVar('kategori_id');


        // Update Data
        $this->unitIndukTahunModel->updateNilai($unit_id, $tahun, $induk_id, $kategori_id, $nilai);

        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data Induk berhasil diubah!</div>');

        return redirect()->to('/home/datainduk/' . $unit_id . '/' . $tahun);
    }

    // Standar Method (Done)
    public function standar()
    {
        $data_user = $this->data_user;
        $tahun = $data_user['tahun'];

        $unit_id = $data_user['unit_id'];


        $data = $this->penilaianModel->getPenilaian($unit_id, $tahun);
        // dd($data);
        $data_nilai = [];
        foreach ($data as $datap) {
            $nilai_akhir = 0;
            $i = 1;
            $datapenilaian = $this->penilaianModel->getPenilaianSpec($data_user['unit_id'], $datap['standar_id'], $tahun, $datap['kategori_id']);
            // dd($datapenilaian);
            foreach ($datapenilaian as $nilai) {
                $nilai_akhir += $nilai['nilai_akhir'];
                $i++;
            }
            $nilai_akhir = $nilai_akhir / $i;
            $data_nilai[] = [
                'standar_id' => $datap['standar_id'],
                'kategori_id' => $datap['kategori_id'],
                'nilai_akhir' => $nilai_akhir,
            ];
        }
        // dd($data_nilai);


        $i = 1;

        $status = [];
        foreach ($data as $s) {
            $status[] = $s['status'];
        }


        // Cek apakah semua standar sudah diisi
        if (in_array('Dikirim', $status)) {
            $status = "Sudah Dikirim";
        } elseif (in_array('Diaudit', $status)) {
            $status = "Sudah Diaudit";
        } else {
            $status = "Belum Dikirim";
        }

        $data = [
            'title' => 'Standar | SIPMPP UNDIP ' . $this->thisTahun,
            'data_user' => $data_user,
            'tab' => 'standar',
            'header' => 'header__mini header__spmi',
            'css' => 'styles-standar.css',
            'tahun' => $tahun,
            'i' => $i,
            'status' => $status,
            'data_standar' => $data,
            'data_nilai' => $data_nilai,
            'tahunsession' => $this->tahun,
        ];

        return view('user/standar', $data);
    }

    // Indikator Method (Done)
    public function indikator($standar_id, $kategori_id)
    {
        $data_user = $this->data_user;

        $tahun = $data_user['tahun'];

        $datapenilaian = $this->penilaianModel->getPenilaianSpec($data_user['unit_id'], $standar_id, $tahun, $kategori_id);
        $indikator = $this->indikatorModel->getIndikator($kategori_id, $standar_id);
        // dd($datapenilaian, $indikator);

        $kategori =  $this->kategoriModel->getKategoriById($kategori_id)['nama_kategori'];
        // dd($kategori);

        $standar = $this->standarModel->getStandarByKategori($standar_id, $kategori_id);

        $i = 1;

        $data = [
            'title' => 'Indikator | SIPMPP UNDIP ' . $this->thisTahun,
            'data_user' => $data_user,
            'tab' => 'standar',
            'i' => $i,
            'header' => 'header__mini header__indikator',
            'css' => 'styles-indikator.css',
            'tahun' => $tahun,
            'datapenilaian' => $datapenilaian,
            'standar' => $standar,
            'kategori' => $kategori,
            'indikator' => $indikator,
            'tahunsession' => $this->tahun,
        ];

        return view('user/indikator', $data);
    }

    // Indikator Form Method (Done)
    public function indikatorForm($kategori_id, $standar_id, $indikator_id)
    {
        $data_user = $this->data_user;
        $unit_id = $data_user['unit_id'];
        $tahun = $data_user['tahun'];

        // dd($kategori_id, $standar_id, $indikator_id);

        // $datapenilaian = $this->penilaianModel->getPenilaianByUnitId($unit_id, $standar_id, $kategori_id, $tahun, $indikator_id);
        $datapenilaian = $this->penilaianModel->getPenilaianSpecId($unit_id, $standar_id, $tahun, $kategori_id, $indikator_id);
        // dd($datapenilaian);
        $standar = $this->standarModel->getStandarByKategori($standar_id, $kategori_id);
        // dd($datapenilaian, $standar);
        $induk = $this->unitIndukTahunModel->getIndukUnitSpec($unit_id, $tahun, $datapenilaian['indikator_id'], $kategori_id);
        // dd($induk);
        $kategori = $this->kategoriModel->getKategoriById($kategori_id);
        // dd($kategori);

        if ($datapenilaian['nilai'] == 0) {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Nilai Data Induk Belum Diisi. Silakan isi Data Induk terlebih dahulu</div>');
            return redirect()->to('/home/indikator/' . $standar_id . '/' . $kategori_id);
        } else {
            $data = [
                'title' => 'Form Indikator SPMI | SIPMPP UNDIP ' . $this->thisTahun,
                'data_user' => $data_user,
                'tab' => 'standar',
                'header' => 'header__mini header__indikator',
                'css' => 'styles-form-indikator-spmi.css',
                'kategori' => $kategori['nama_kategori'],
                'datapenilaian' => $datapenilaian,
                'standar' => $standar,
                // 'induk' => $induk,
                'tahun' => $tahun,
                'tahunsession' => $this->tahun,
            ];

            return view('user/indikatorform', $data);
        }
    }

    // Save Indikator Method (Done)
    public function saveIndikator($indikator_id, $tahun, $standar_id, $unit_id, $kategori_id)
    {
        $indikator_id = (int)$indikator_id;
        $nilai_input = $this->request->getVar('hasil');
        $keterangan = $this->request->getVar('keterangan');
        $status = "Diisi";

        // dd($kategori_id, $standar_id, $unit_id, $tahun, $indikator_id, $nilai_input, $keterangan, $status);

        $datapenilaian = $this->penilaianModel->getPenilaianSpecId($unit_id, $standar_id, $tahun, $kategori_id, $indikator_id);
        // dd($datapenilaian);

        if ($nilai_input == 'ADA / SESUAI') {
            $nilai_input = 1;
            $hasil = 100;
            $nilai_akhir = $hasil;
        } elseif ($nilai_input == 'TIDAK ADA / SESUAI') {
            $nilai_input = 0;
            $hasil = 0;
            $nilai_akhir = $hasil;
        } else {
            $nilai_input = (int)$nilai_input;
            $nilai_acuan = (int)$datapenilaian['nilai_acuan'];
            $nilai_induk = (int)$datapenilaian['nilai'];
            $hasil = $nilai_input / $nilai_induk * 100;
            if ($hasil >= $nilai_acuan) {
                $nilai_akhir = 100;
            } else {
                $nilai_akhir = $hasil / $nilai_acuan * 100;
            }
        }


        // Dokumen handler
        $dokumen = $this->request->getFile('dokumen');
        if ($dokumen->getError() == 4) {
            return redirect()->to('/home/indikatorform/' . $kategori_id . '/' . $standar_id . '/' . $indikator_id);
        } else {
            $namadokumen = 'dokumen-' . $indikator_id . '-' . $standar_id . '-' . $unit_id . '-' . $kategori_id . '-' . $tahun . '.' . $dokumen->getExtension();
            // dd($namadokumen);
            $dokumen->move('dokumen/', $namadokumen);
        };

        $data = [
            'nilai_input' => $nilai_input,
            'dokumen' => $namadokumen,
            'keterangan' => $keterangan,
            'status' => $status,
            'hasil' => $hasil,
            'nilai_akhir' => $nilai_akhir
        ];

        $this->penilaianModel->updatePenilaian($unit_id, $tahun, $standar_id, $kategori_id, $indikator_id, $data);

        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data Indikator berhasil diubah</div>');

        return redirect()->to('/home/indikator/' . $standar_id . '/' . $kategori_id);
    }

    // Send Penilaian Method (Done)
    public function sendPenilaian()
    {
        $data_user = $this->data_user;
        $tahun = $data_user['tahun'];


        $unit_id = $data_user['unit_id'];
        $standar = $this->penilaianModel->getPenilaian($unit_id, $tahun);
        $status = [];
        foreach ($standar as $s) {
            array_push($status, $s['status']);
        }
        // dd($status);

        // Cek apakah semua standar sudah diisi
        if (in_array('Belum Diisi', $status) || in_array('Belum Lengkap', $status)) {
            // dd('Belum Lengkap');
            $this->session->setFlashdata('message', '<div class="alert alert-danger" role="alert"><strong>Maaf!</strong> Data penilaian belum lengkap.</div>');
            return redirect()->to('/home/standar/');
        } else {
            // dd('Lengkap');
            $this->penilaianModel->updateStatus($data_user['unit_id'], $tahun, 'Dikirim');

            $this->session->setFlashdata('message', '<div class="alert alert-success" role="alert"><strong>Selamat!</strong> Data penilaian telah dikirim.</div>');
            return redirect()->to('/home/standar/');
        }
    }

    // Report Method
    public function report()
    {
        $data_user = $this->data_user;

        $i = 1;

        $data = [
            'title' => 'Report SIPMPP | SIPMPP UNDIP ' . $this->thisTahun,
            'data_user' => $data_user,
            'i' => $i,
            'tab' => 'report',
            'header' => 'header__mini',
            'css' => 'styles-report.css',
            'tahunsession' => $this->tahun,
            'tahun' => $data_user['tahun'],
        ];

        return view('user/report', $data);
    }

    // Profile Method (Done)
    public function profile()
    {
        $data_user = $this->data_user;
        $user = $this->usersModel->getUserByEmail($data_user['email']);

        $data = [
            'title' => 'Profile | SIPMPP UNDIP ' . $this->thisTahun,
            'data_user' => $data_user,
            'user' => $user,
            'tab' => 'profile',
            'header' => 'header__mini header__profile',
            'css' => 'styles-profile.css',
            'tahunsession' => $this->tahun,
            'tahun' => $data_user['tahun'],
        ];

        return view('user/profile', $data);
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
                return redirect()->to('/home/profile/');
            } else {
                // Update Password
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $this->usersModel->updatePassword($data_user['email'], $new_password);

                $this->session->setFlashdata('message', '<div class="alert alert-success" role="alert"><strong>Selamat!</strong> Password berhasil diubah.</div>');
                return redirect()->to('/home/profile/');
            }
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger" role="alert"><strong>Maaf!</strong> Password lama tidak sesuai.</div>');
            return redirect()->to('/home/profile/');
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

        $this->session->setFlashdata('message', '<div class="alert alert-success" role="alert"><strong>Selamat!</strong> Data berhasil diubah.</div>');
        return redirect()->to('/home/profile/');
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

        return json_encode($datasession['tahun']);
    }
}
