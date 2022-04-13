<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Test extends BaseController
{
    protected $helpers = ['download'];

    public function index()
    {
        return view('test');
    }

    public function open($fileName)
    {
        // $data = readfile(base_url('/dokumen/UAS MCQ.pdf'));
        // print_r($data);
        return $this->response->download('dokumen/' . $fileName, null);
        // $file = new \CodeIgniter\Files\File('dokumen/UAS MCQ.pdf');
        // return $file->openFile('dokumen/UAS MCQ.pdf');
        // fopen("dokumen/UAS MCQ.pdf", "");
        // header("Content-Length: " . filesize('dokumen/UAS MCQ.pdf'));
        // header("Content-type: application/pdf");
        // header("Content-disposition: inline; filename=" . basename('dokumen/UAS MCQ.pdf'));
        // header('Expires: 0');
        // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        // readfile('dokumen/UAS MCQ.pdf');
        // $this->output
        //     ->set_content_type('application/pdf')
        //     ->set_output(file_get_contents('dokumen/UAS MCQ.pdf'));
        // $this->load->helper('download');
        // $data = file_get_contents('dokumen/UAS MCQ.pdf');
        // $name = 'UAS MCQ.pdf';
        // force_download($name, $data);
    }
}
