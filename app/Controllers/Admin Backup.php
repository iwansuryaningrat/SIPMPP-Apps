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
}
