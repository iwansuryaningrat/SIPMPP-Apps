<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\UserUnitModel;
use App\Models\UserRoleUnitModel;
use App\Models\UnitsModel;
use App\Models\RoleModel;
use App\Models\SupercodeModel;

class Auth extends BaseController
{
    protected $usersModel;
    protected $userunitModel;
    protected $userroleunitModel;
    protected $unitsModel;
    protected $roleModel;
    protected $supercodeModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->userunitModel = new UserUnitModel();
        $this->userroleunitModel = new UserRoleUnitModel();
        $this->unitsModel = new UnitsModel();
        $this->roleModel = new RoleModel();
        $this->supercodeModel = new SupercodeModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->getTahun = (int)date('Y');
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
        $unit_id = $this->request->getVar('unit');
        $tahun = $this->getTahun;

        $data = $this->userroleunitModel->getDataSpec($email, $tahun, $role, $unit_id);

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

        if ($verify == false) {
            session()->setFlashdata('error', 'Gagal melakukan proses registrasi. Mohon maaf untuk mengisi supercode dengan benar.');

            return redirect()->to('auth/register');
        } else {
            $data = [
                'nama' => $this->request->getVar('nama'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'foto' => 'default.png',
            ];

            $this->usersModel->insert($data);

            $role = $this->roleModel->getRole('admin');
            $roleuser = [
                'email' => $this->request->getVar('email'),
                'role_id' => $role['role_id'],
                'unit_id' => 'lppm',
                'tahun' => $this->getTahun,
            ];

            $this->userroleunitModel->insert($roleuser);

            session()->setFlashdata('success', 'Akun berhasil dibuat, silahkan login sebagai administrator.');

            return redirect()->to('/login');
        }
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

        $tahun = $this->getTahun;

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $user = $this->userroleunitModel->getUserUnit($email, $tahun);

                $user_role = $this->userroleunitModel->getUserRole($email, $tahun);

                // Cek apakah yg login merupakan admin
                if ($user_role[0]['role'] == 'admin' || $user_role[0]['role'] == 'pimpinan') {
                    $data = [
                        'email' => $user[0]['email'],
                        'nama' => $user[0]['nama'],
                        'foto' => $user[0]['foto'],
                        'role_id' => $user_role[0]['role_id'],
                        'role' => $user_role[0]['role'],
                        'tahun' => $this->getTahun,
                        'isLoggedIn' => true,
                    ];

                    $this->session->set($data);

                    return redirect()->to('/admin');
                } else {
                    foreach ($user_role as $role) {
                        $roles[] = $role['role'];
                    }

                    $roles = array_unique($roles);

                    $data = [
                        'title' => 'Login | SIPMPP UNDIP 2022',
                        'nama' => $user[0]['nama'],
                        'email' => $user[0]['email'],
                        'userdata' => $user,
                        'roles' => $roles,
                    ];

                    return view('auth/login-unit', $data);
                }
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
        $units = $this->userroleunitModel->getUserUnitRoleTahun($email, $this->getTahun, $data['role']);
        $option = '<option selected disabled>Pilih Unit</option>';
        foreach ($units as $unit) {
            $option .= '<option value="' . $unit['unit_id'] . '">' . $unit['nama_unit'] . '</option>';
        }
        return json_encode($option);
    }
}
