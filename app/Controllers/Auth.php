<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\UserRoleUnitModel;
use App\Models\UnitsModel;
use App\Models\RoleModel;
use App\Models\SupercodeModel;
use App\Models\TahunModel;

class Auth extends BaseController
{
    protected $usersModel;
    protected $userroleunitModel;
    protected $unitsModel;
    protected $roleModel;
    protected $supercodeModel;
    protected $tahunModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->userroleunitModel = new UserRoleUnitModel();
        $this->unitsModel = new UnitsModel();
        $this->roleModel = new RoleModel();
        $this->supercodeModel = new SupercodeModel();
        $this->tahunModel = new TahunModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }

    // Login Page (Done)
    public function login()
    {
        // Check Login status
        if (session()->get('isLoggedIn')) {
            if (session()->get('role') == 'admin') {
                return redirect()->to('/admin');
            } elseif (session()->get('role') == 'auditor') {
                return redirect()->to('/auditor');
            } elseif (session()->get('role') == 'pimpinan') {
                return redirect()->to('/leader');
            } elseif (session()->get('role') == 'user') {
                return redirect()->to('/home');
            }
        }

        $data = [
            'title' => 'Login | SIPMPP UNDIP 2022',
        ];

        return view('auth/login', $data);
    }

    // Valid Login (Done)
    public function loginProcess($email)
    {
        $role = $this->request->getVar('role');
        $role = $this->roleModel->getRoleId($role);
        $role = $role['role'];
        $unit_id = $this->request->getVar('unit');
        $tahun = $this->request->getVar('tahun');

        $data = $this->userroleunitModel->getDataSpec($email, $tahun, $role, $unit_id);
        // dd($role, $unit_id, $tahun, $data);

        $data = [
            'email' => $data['email'],
            'nama' => $data['nama'],
            'foto' => $data['foto'],
            'unit_id' => $data['unit_id'],
            'unit' => $data['nama_unit'],
            'role_id' => $data['role_id'],
            'role' => $data['role'],
            'tahun' => $data['tahun'],
            'isLoggedIn' => true,
        ];

        $this->session->set($data);


        if ($data['role'] == 'admin') {
            return redirect()->to('/admin');
        } elseif ($data['role'] == 'user') {
            return redirect()->to('/home');
        } elseif ($data['role'] == 'auditor') {
            return redirect()->to('/auditor');
        } else {
            return redirect()->to('/leader');
        }
    }

    // Register Page (Done)
    public function register()
    {
        // Check Login status
        if (session()->get('isLoggedIn')) {
            if (session()->get('role') == 'admin') {
                return redirect()->to('/admin');
            } elseif (session()->get('role') == 'auditor') {
                return redirect()->to('/auditor');
            } elseif (session()->get('role') == 'pimpinan') {
                return redirect()->to('/leader');
            } elseif (session()->get('role') == 'user') {
                return redirect()->to('/home');
            }
        }

        $data = [
            'title' => 'Register | SIPMPP UNDIP 2022',
        ];

        return view('auth/register', $data);
    }

    // valid register (Done)
    public function registerProcess()
    {
        $supercode = $this->supercodeModel->findAll();
        $supercode = $supercode[0]['supercode'];
        $inputcode = $this->request->getVar('superpass');
        $verify = password_verify($inputcode, $supercode);
        $email = $this->request->getVar('email');

        if ($verify == false) {
            session()->setFlashdata('error', 'Gagal melakukan proses registrasi. Mohon maaf untuk mengisi supercode dengan benar.');

            return redirect()->to('auth/register');
        } else {
            $user = $this->usersModel->getUserByEmail($email);
            if ($user == null) {

                $data = [
                    'nama' => $this->request->getVar('nama'),
                    'email' => $email,
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'foto' => 'default.png',
                ];

                $this->usersModel->insert($data);

                $role = $this->roleModel->getRole('admin');
                $tahun = $this->tahunModel->findAll();
                foreach ($tahun as $tahun) {
                    $data = [
                        'email' => $email,
                        'role_id' => $role['role_id'],
                        'unit_id' => 'lppm',
                        'tahun' => $tahun['tahun'],
                    ];

                    $this->userroleunitModel->insert($data);
                }

                session()->setFlashdata('success', 'Akun berhasil dibuat, silahkan login sebagai administrator.');

                return redirect()->to('/login');
            } else {
                session()->setFlashdata('gagal', 'Akun sudah terdaftar, silahkan login.');

                return redirect()->to('/login');
            }
        }
    }

    // Update Admin (Done)
    public function updateadmin($email)
    {
        $user = $this->usersModel->getUserByEmail($email);
        $data = [
            'email' => $email,
            'role_id' => '2',
            'unit_id' => 'lppm',
            'tahun' => date('Y'),
        ];

        $this->userroleunitModel->insert($data);

        session()->setFlashdata('success', 'Akun berhasil diupdate, silahkan login sebagai administrator.');

        return redirect()->to('/login');
    }

    // Logout
    public function logout()
    {
        $this->session->destroy();

        return redirect()->to('/login');
    }

    // Generate Password (Done)
    public function generatepassword($password)
    {
        $data = password_hash($password, PASSWORD_DEFAULT);
        dd($data);
    }

    // Form Login Unit (Done)
    public function formLoginUnit()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->usersModel->getUserByEmail($email);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $user_tahun = $this->userroleunitModel->getTahun($email);

                $data = [
                    'title' => 'Login | SIPMPP UNDIP 2022',
                    'nama' => $user['nama'],
                    'email' => $user['email'],
                    'userdata' => $user,
                    'tahun' => $user_tahun,
                ];

                return view('auth/login-unit', $data);
            } else {
                session()->setFlashdata('gagal', 'Gagal melakukan proses autentikasi. Mohon untuk mengisi password dengan benar.');

                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('gagal', 'Gagal melakukan proses autentikasi. Mohon maaf akun belum terdaftar. Silakan menghubungi admin untuk mendaftar.');

            return redirect()->to('/login');
        }
    }

    // Get Unit (Done)
    public function getUnit($email)
    {
        $data = $this->request->getPost();

        $role = $this->roleModel->getRoleid($data['role_id']);
        $tahun = $data['tahun'];


        $role_id = $role['role_id'];

        $units = $this->userroleunitModel->getUserUnitRoleTahun($email, $tahun, $role_id);
        $option = '<option selected disabled>Pilih Unit</option>';
        foreach ($units as $unit) {
            $option .= '<option value="' . $unit['unit_id'] . '">' . $unit['nama_unit'] . '</option>';
        }
        return json_encode($option);
    }

    // Get User Role (Done)
    public function getRole($email)
    {
        $data = $this->request->getPost();
        $tahun = (int)$data['tahun'];
        $role = $this->userroleunitModel->getUserRole($email, $tahun);

        $option = '<option selected disabled>Pilih Role</option>';
        foreach ($role as $r) {
            $option .= '<option value="' . $r['role_id'] . '">' . ucfirst($r['role']) . '</option>';
        }

        return json_encode($option);
    }
}
