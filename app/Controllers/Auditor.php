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

use App\Controllers\Stats;

class Auditor extends BaseController
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
    protected $stats;

    public function __construct()
    {
        $this->stats = new Stats();
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

        // Induk Progress
        $indukpersen = $this->stats->getIndukProgress($data_user['unit_id'], $data_user['tahun']);

        // Standar Progress
        $dataprogresstandar = $this->stats->getStandarProgress($data_user['unit_id'], $data_user['tahun']);

        $databykat = $this->stats->getStandarProgressDoughnut($data_user['unit_id'], $data_user['tahun']);
        $datanilaiPEN = $databykat['pen'];
        $datanilaiPPM = $databykat['ppm'];

        // Nilai Per Tahun
        $nilaiTahun = $this->stats->getNilaiPerTahun($data_user['unit_id']);

        $i = 1;

        $data = [
            'title' => 'Dashboard Auditor | SIPMPP UNDIP 2022',
            'data_user' => $data_user,
            'i' => $i,
            'tab' => 'home',
            'tahun' => $data_user['tahun'],
            'header' => 'header__big',
            'css' => 'styles-dashboard.css',
            'cssCustom' => '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>',
            'tahunsession' => $this->tahun,
            'indukpersen' => $indukpersen,
            'dataprogresstandar' => $dataprogresstandar,
            'datanilaiPEN' => $datanilaiPEN,
            'datanilaiPPM' => $datanilaiPPM,
            'nilaiTahun' => $nilaiTahun,
        ];

        return view('auditor/index', $data);
    }

    // Data Induk Method (Done)
    public function dataInduk()
    {
        $data_user = $this->data_user;
        $tahun = $data_user['tahun'];

        $unit_id = $data_user['unit_id'];

        $data_indukPen = $this->unitIndukTahunModel->getIndukUnitKategori($unit_id, $tahun, 'PEN');
        $data_indukPPM = $this->unitIndukTahunModel->getIndukUnitKategori($unit_id, $tahun, 'PPM');

        $i = 1;

        $data = [
            'title' => 'Data Induk | SIPMPP UNDIP 2022',
            'tab' => 'induk',
            'header' => 'header__mini header__datainduk',
            'css' => 'styles-data-induk.css',
            'cssCustom' => '',
            'i' => $i,
            'data_user' => $data_user,
            'data_indukPen' => $data_indukPen,
            'data_indukPPM' => $data_indukPPM,
            'tahunsession' => $this->tahun,
            'tahun' => $data_user['tahun'],
        ];

        return view('auditor/datainduk', $data);
    }

    // Standar Method (Done)
    public function standar()
    {
        $data_user = $this->data_user;
        $tahun = $data_user['tahun'];

        $unit_id = $data_user['unit_id'];

        $data = [];
        // Penelitian
        $dataPEN = $this->penilaianModel->getPenilaianStat($unit_id, $tahun, 'PEN');
        $nilaiPEN = [];
        foreach ($dataPEN as $datap) {
            $nilai_akhir = 0;
            $i = 1;
            $datapenilaian = $this->penilaianModel->getPenilaianSpec($data_user['unit_id'], $datap['standar_id'], $tahun, $datap['kategori_id']);
            foreach ($datapenilaian as $nilai) {
                $nilai_akhir += $nilai['nilai_akhir'];
                $i++;
            }
            $nilai_akhir = $nilai_akhir / $i;
            $nilaiPEN[] = [
                'standar_id' => $datap['standar_id'],
                'kategori_id' => $datap['kategori_id'],
                'nilai_akhir' => $nilai_akhir,
            ];
        }

        // Pengabdian
        $dataPPM = $this->penilaianModel->getPenilaianStat($unit_id, $tahun, 'PPM');
        $nilaiPPM = [];
        foreach ($dataPPM as $datap) {
            $nilai_akhir = 0;
            $i = 1;
            $dataPPMilaian = $this->penilaianModel->getPenilaianSpec($data_user['unit_id'], $datap['standar_id'], $tahun, $datap['kategori_id']);
            foreach ($dataPPMilaian as $nilai) {
                $nilai_akhir += $nilai['nilai_akhir'];
                $i++;
            }
            $nilai_akhir = $nilai_akhir / $i;
            $nilaiPPM[] = [
                'standar_id' => $datap['standar_id'],
                'kategori_id' => $datap['kategori_id'],
                'nilai_akhir' => $nilai_akhir,
            ];
        }

        foreach ($dataPEN as $PEN) {
            $data[] = $PEN;
        }
        foreach ($dataPPM as $PPM) {
            $data[] = $PPM;
        }

        $data_nilai = [];
        foreach ($data as $datap) {
            $nilai_akhir = 0;
            $i = 1;
            $datapenilaian = $this->penilaianModel->getPenilaianSpec($data_user['unit_id'], $datap['standar_id'], $tahun, $datap['kategori_id']);
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
            $data_nilai = [];
        }

        $data = [
            'title' => 'Nilai SPMI | SIPMPP UNDIP 2022',
            'data_user' => $data_user,
            'tab' => 'standar',
            'header' => 'header__mini header__spmi',
            'css' => 'styles-standar.css',
            'cssCustom' => '',
            'tahun' => $tahun,
            'i' => $i,
            'status' => $status,
            'data_standar' => $data,
            'data_nilai' => $data_nilai,
            'tahunsession' => $this->tahun,
        ];

        return view('auditor/standar', $data);
    }

    // Indikator Method (Done)
    public function indikator($standar_id, $kategori_id)
    {
        $data_user = $this->data_user;

        $tahun = $data_user['tahun'];

        $datapenilaian = $this->penilaianModel->getPenilaianSpec($data_user['unit_id'], $standar_id, $tahun, $kategori_id);
        $indikator = $this->indikatorModel->getIndikator($kategori_id, $standar_id);

        $kategori =  $this->kategoriModel->getKategoriById($kategori_id)['nama_kategori'];

        $standar = $this->standarModel->getStandarByKategori($standar_id, $kategori_id);

        $i = 1;

        $data = [
            'title' => 'Indikator | SIPMPP UNDIP 2022',
            'data_user' => $data_user,
            'tab' => 'standar',
            'i' => $i,
            'header' => 'header__mini header__indikator',
            'css' => 'styles-indikator.css',
            'cssCustom' => '',
            'tahun' => $tahun,
            'datapenilaian' => $datapenilaian,
            'standar' => $standar,
            'kategori' => $kategori,
            'indikator' => $indikator,
            'tahunsession' => $this->tahun,
        ];

        return view('auditor/indikator', $data);
    }

    // Indikator Form Method (Done)
    public function indikatorForm($kategori_id, $standar_id, $indikator_id)
    {
        $data_user = $this->data_user;
        $unit_id = $data_user['unit_id'];
        $tahun = $data_user['tahun'];
        // dd($unit_id, $tahun, $kategori_id, $standar_id, $indikator_id);

        $datapenilaian = $this->penilaianModel->getPenilaianSpecId($unit_id, $standar_id, $tahun, $kategori_id, $indikator_id);
        $standar = $this->standarModel->getStandarByKategori($standar_id, $kategori_id);
        // $induk = $this->unitIndukTahunModel->getIndukUnitSpec($unit_id, $tahun, $datapenilaian['indikator_id'], $kategori_id);
        $kategori = $this->kategoriModel->getKategoriById($kategori_id);
        // dd($datapenilaian);

        if ($datapenilaian['nilai'] == 0 || $datapenilaian == null) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert__sipmpp" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span>Nilai Data Induk Belum Diisi. Silakan isi Data Induk terlebih dahulu!</span></div>');

            return redirect()->to('/auditor/indikator/' . $standar_id . '/' . $kategori_id);
        } else {
            $data = [
                'title' => 'Form Edit Indikator | SIPMPP UNDIP ' . $this->thisTahun,
                'data_user' => $data_user,
                'tab' => 'standar',
                'header' => 'header__mini header__indikator',
                'css' => 'styles-form-indikator-spmi.css',
                'cssCustom' => '',
                'kategori' => $kategori['nama_kategori'],
                'datapenilaian' => $datapenilaian,
                'standar' => $standar,
                'tahun' => $tahun,
                'tahunsession' => $this->tahun,
            ];

            return view('auditor/indikatorform', $data);
        }
    }

    // Save Indikator Method (Done)
    public function saveIndikator($indikator_id, $tahun, $standar_id, $unit_id, $kategori_id)
    {
        $catatan = $this->request->getPost('catatan');

        $this->penilaianModel->updateCatatan($tahun, $unit_id, $standar_id, $indikator_id, $kategori_id, $catatan);

        session()->setFlashdata('message', '<div class="alert alert-success alert__sipmpp" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span>Data Indikator berhasil diubah!</span></div>');

        return redirect()->to('/auditor/indikator/' . $standar_id . '/' . $kategori_id);
    }

    // Send Penilaian Method (Done)
    public function sendPenilaian()
    {
        $data_user = $this->data_user;
        $tahun = $data_user['tahun'];


        $unit_id = $data_user['unit_id'];
        $dataPEN = $this->penilaianModel->getPenilaianStat($unit_id, $tahun, 'PEN');
        $dataPPM = $this->penilaianModel->getPenilaianStat($unit_id, $tahun, 'PPM');
        foreach ($dataPEN as $PEN) {
            $standar[] = $PEN;
        }
        foreach ($dataPPM as $PPM) {
            $standar[] = $PPM;
        }
        $status = [];
        foreach ($standar as $s) {
            array_push($status, $s['status']);
        }
        // dd($status);

        // Cek apakah semua standar sudah diisi
        if (in_array('Belum Diisi', $status) || in_array('Belum Lengkap', $status)) {
            // dd('Belum Lengkap');
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert__sipmpp" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span><strong>Maaf!</strong> Data penilaian belum lengkap.</span></div>');

            return redirect()->to('/auditor/standar/');
        } else {
            // dd('Lengkap');
            $this->penilaianModel->updateStatus($data_user['unit_id'], $tahun, 'Dikirim');

            $this->session->setFlashdata('message', '<div class="alert alert-success alert__sipmpp" role="alert"><i class="fa-solid fa-circle-check color__success"></i></i><span><strong>Selamat!</strong> Data penilaian telah dikirim.</span></div>');

            return redirect()->to('/auditor/standar/');
        }
    }

    // Report Method
    public function report()
    {
        $data_user = $this->data_user;

        $unit_id = $data_user['unit_id'];
        $tahun = $data_user['tahun'];

        // Penelitian Chart
        $standarPEN = $this->standarModel->getStandarByKategoriId('PEN');
        foreach ($standarPEN as $stdPEN) {
            $namastdPEN = $stdPEN['standar_id'] . '. ' . $stdPEN['nama_standar'];
            $stat = $this->stats->getNilaiByStandar($unit_id, $tahun, $stdPEN['standar_id'], 'PEN');
            $statstdPEN[$stdPEN['standar_id']] = [
                'kode' => $stdPEN['standar_id'],
                'standar' => $namastdPEN,
                'namaindikator' => $stat['nama'],
                'nilai' => $stat['nilai'],
            ];
        }
        $Stats['PEN'] = $statstdPEN;

        // Pengabdian Chart
        $standarPPM = $this->standarModel->getStandarByKategoriId('PPM');
        foreach ($standarPPM as $stdPPM) {
            $namastdPPM = $stdPPM['standar_id'] . '. ' . $stdPPM['nama_standar'];
            $stat = $this->stats->getNilaiByStandar($unit_id, $tahun, $stdPPM['standar_id'], 'PPM');
            $statstdPPM[$stdPPM['standar_id']] = [
                'kode' => $stdPPM['standar_id'],
                'standar' => $namastdPPM,
                'namaindikator' => $stat['nama'],
                'nilai' => $stat['nilai'],
            ];
        }
        $Stats['PPM'] = $statstdPPM;

        $i = 1;

        $data = [
            'title' => 'Report SIPMPP | SIPMPP UNDIP 2022',
            'data_user' => $data_user,
            'i' => $i,
            'tab' => 'report',
            'header' => 'header__mini header__report',
            'css' => 'styles-report.css',
            'cssCustom' => '',
            'tahunsession' => $this->tahun,
            'tahun' => $data_user['tahun'],
            'stats' => $Stats,
        ];

        return view('auditor/report', $data);
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
            'header' => 'header__mini header__profile',
            'css' => 'styles-profile.css',
            'cssCustom' => '',
            'tahunsession' => $this->tahun,
            'tahun' => $data_user['tahun'],
        ];

        return view('auditor/profile', $data);
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

                return redirect()->to('/auditor/profile/');
            } else {
                // Update Password
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $this->usersModel->updatePassword($data_user['email'], $new_password);

                $this->session->setFlashdata('pwdmessage', '<div class="alert alert-success alert__sipmpp" role="alert"><i class="fa-solid fa-circle-check color__success"></i><span><strong>Selamat!</strong> Password berhasil diubah.</span></div>');

                return redirect()->to('/auditor/profile/');
            }
        } else {
            $this->session->setFlashdata('pwdmessage', '<div class="alert alert-danger alert__sipmpp" role="alert"><i class="fa-solid fa-circle-exclamation color__danger"></i><span><strong>Maaf!</strong> Password lama tidak sesuai.</span></div>');

            return redirect()->to('/auditor/profile/');
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

        return redirect()->to('/auditor/profile/');
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

    // Download Method (Done)
    public function download($fileName)
    {
        return $this->response->download('dokumen/' . $fileName, null);
    }
}
