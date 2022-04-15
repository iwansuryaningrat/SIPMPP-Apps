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

use App\Controllers\BaseController;

class Stats extends BaseController
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

    // Get Induk Progress Output Percentage (Done)
    public function getIndukProgress($unit_id, $tahun)
    {
        // Induk Progress
        $indukdata = $this->unitIndukTahunModel->getDataByUnit($unit_id, $tahun);
        $sum = 0;
        $count = 0;
        foreach ($indukdata as $datainduk) {
            if ($datainduk['nilai'] != 0) {
                $sum++;
                $count++;
            } else {
                $count++;
            }
        }
        if ($count == 0) {
            $indukpersen = 0;
        } else {
            $indukpersen = ($sum / $count) * 100;
        }
        $indukpersen = round($indukpersen, 2);

        return $indukpersen;
    }

    // Get Standar Progress (Done)
    public function getStandarProgress($unit_id, $tahun)
    {
        // Standar Progress
        $standar = $this->penilaianModel->getPenilaianByUnitIdTahun($unit_id, $tahun);
        $standarprogress = [];
        foreach ($standar as $datastandar) {
            $Standar = $this->standarModel->getStandarByKategori($datastandar['standar_id'], $datastandar['kategori_id']);
            if (isset($Standar['nama_standar'])) {
                $namaStandar = $Standar['nama_standar'];
            }
            $indikator = $this->penilaianModel->getPenilaianProgress($unit_id, $tahun, $datastandar['standar_id'], $datastandar['kategori_id']);
            $ssum = 0;
            $scount = 0;
            foreach ($indikator as $dataindikator) {
                if ($dataindikator['status'] == 'Diisi') {
                    $ssum++;
                    $scount++;
                } else {
                    $scount++;
                }
            }

            if ($scount == 0) {
                $persentase = 0;
            } else {
                $persentase = ($ssum / $scount) * 100;
                $persentase = round($persentase, 2);
            }

            $standarprogress[] = [
                'standar' => $datastandar['standar_id'],
                'nama_standar' => $namaStandar,
                'kategori' => $datastandar['kategori_id'],
                'count' => $scount,
                'sum' => $ssum,
                'persen' => $persentase,
            ];
        }

        $sscount = 0;
        $sssum = 0;
        foreach ($standarprogress as $progresstandar) {
            $sscount += $progresstandar['count'];
            $sssum += $progresstandar['sum'];
        }

        if ($sscount == 0) {
            $standarpersen = 0;
        } else {
            $standarpersen = ($sssum / $sscount) * 100;
            $standarpersen = round($standarpersen, 2);
        }
        $dataprogresstandar = [
            'standar' => $standarprogress,
            'count' => $sscount,
            'sum' => $sssum,
            'persen' => $standarpersen,
        ];

        return $dataprogresstandar;
    }

    // Get Standar Progress for Doughnut Chart (Done)
    public function getStandarProgressDoughnut($unit_id, $tahun)
    {
        $standar = $this->penilaianModel->getPenilaianByUnitIdTahun($unit_id, $tahun);
        $standarPen = $this->standarModel->getStandarByKategoriId('PEN');
        foreach ($standarPen as $pen) {
            $standaridPen[] = $pen['standar_id'];
            $nilaiPen[] = 0;
        }
        $countpen = 0;

        $standarPPM = $this->standarModel->getStandarByKategoriId('PPM');
        foreach ($standarPPM as $PPM) {
            $standaridPPM[] = $PPM['standar_id'];
            $nilaiPPM[] = 0;
        }
        $countPPM = 0;

        foreach ($standar as $datastandar) {
            $indikator = $this->penilaianModel->getPenilaianProgress($unit_id, $tahun, $datastandar['standar_id'], $datastandar['kategori_id']);
            if ($datastandar['kategori_id'] == 'PEN') {
                $PENnilai = 0;
                $PENcount = 0;
                foreach ($indikator as $dataindikator) {
                    if ($dataindikator['status'] == 'Diisi') {
                        $PENnilai += $dataindikator['nilai_akhir'];
                        $PENcount++;
                    }
                }
                if ($PENcount != 0) {
                    $nilaiPen[array_search($datastandar['standar_id'], $standaridPen)] = round($PENnilai / $PENcount, 2);
                }
            } elseif ($datastandar['kategori_id'] == 'PPM') {
                $PPMnilai = 0;
                $PPMcount = 0;
                foreach ($indikator as $dataindikator) {
                    if ($dataindikator['status'] == 'Diisi') {
                        $PPMnilai += $dataindikator['nilai_akhir'];
                        $PPMcount++;
                    }
                }
                if ($PPMcount != 0) {
                    $nilaiPPM[array_search($datastandar['standar_id'], $standaridPPM)] = round($PPMnilai / $PPMcount, 2);
                }
            }
        }

        $sumPEN = 0;
        $JumlahPen = 0;
        foreach ($nilaiPen as $pen) {
            if ($pen != 0) {
                $sumPEN += $pen;
                $JumlahPen++;
            }
        }
        if ($JumlahPen != 0) {
            $avgPEN = ($sumPEN / $JumlahPen);
            $avgPEN = round($avgPEN, 2);
        } else {
            $avgPEN = 0;
        }
        $datanilaiPEN = [
            'standar' => $standaridPen,
            'nilai' => $nilaiPen,
            'avg' => $avgPEN,
        ];

        $sumPPM = 0;
        $JumlahPPM = 0;
        foreach ($nilaiPPM as $PPM) {
            if ($PPM != 0) {
                $sumPPM += $PPM;
                $JumlahPPM++;
            }
        }
        if ($JumlahPPM != 0) {
            $avgPPM = round(($sumPPM / $JumlahPPM), 2);
        } else {
            $avgPPM = 0;
        }
        $datanilaiPPM = [
            'standar' => $standaridPPM,
            'nilai' => $nilaiPPM,
            'avg' => $avgPPM,
        ];

        $data = [
            'pen' => $datanilaiPEN,
            'ppm' => $datanilaiPPM,
        ];

        return $data;
    }

    // Get Nilai Per Tahun (Done)
    public function getNilaiPerTahun($unit_id)
    {
        $daftarTahun = $this->tahunModel->findAll();
        foreach ($daftarTahun as $year) {
            $tahun[] = $year['tahun'];
        }

        foreach ($daftarTahun as $dataTahun) {
            $nilai[] = Stats::getStandarProgressDoughnut($unit_id, $dataTahun['tahun']);
        }

        $data = [
            'tahun' => $tahun,
            'nilai' => $nilai,
        ];

        return $data;
    }

    // Get Nilai Per Indikator
    public function getNilaiByStandar($unit_id, $tahun, $standar_id, $kategori_id)
    {
        $indikator = $this->penilaianModel->getPenilaianProgress($unit_id, $tahun, $standar_id, $kategori_id);
        $nama = [];
        $nilai = [];
        foreach ($indikator as $indikator) {
            $nilai[] = $indikator['nilai_akhir'];
            $namaIndikator = $this->indikatorModel->findIndikator($indikator['indikator_id'], $kategori_id, $standar_id);
            $nama[] = $namaIndikator['nama_indikator'];
        }

        $data = [
            'nama' => $nama,
            'nilai' => $nilai,
        ];

        return $data;
    }
}
