<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\CustomerModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    use ResponseTrait;
    protected $user;
    public function __construct()
    {
        $this->user = new UserModel();
    }
    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'login' => 'required',
                'password' => 'required|min_length[6]'
            ];

            $messages = [
                'login' => [
                    'required' => 'Username atau email harus diisi'
                ],
                'password' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                // Perbaikan: Tidak perlu trim() untuk error messages
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $login = $this->request->getPost('login');
            $password = $this->request->getPost('password');

            $user = $this->findUserByUsernameOrEmail($login);

            if (!$user || !password_verify($password, $user->password)) {
                return redirect()->back()->withInput()->with('error', 'Username/email atau password salah');
            }



            // Set session data
            $session = session();
            $session->set([
                'user_id' => $user->id_users,
                'username' => $user->username,
                'email' => $this->getUserEmail($user->id_users),
                'role' => $user->role,
                'logged_in' => true
            ]);
            if ($user->role == 'customer') {
                $userInfoModel = new CustomerModel();
                $userInfo = $userInfoModel->where('id_users', $user->id_users)->first();
                $session->set([
                    'id_customer' => $userInfo->id_customer,
                ]);
            }

            // Redirect berdasarkan role
            return $this->redirectByRole($user->role);
        }
        if ($this->user->countAllResults() == 0) {
            $this->user->insert([
                'username' => 'Administrator',
                'password' => password_hash('Administrator#1', PASSWORD_DEFAULT),
                'role' => 'admin'
            ]);
        }
        return view('login');
    }

    function showRegister(): string
    {
        return view('register');
    }



    public function register(): \CodeIgniter\HTTP\ResponseInterface|string
    {

        $a = $this->request->getMethod();

        if ($this->request->getMethod() === 'POST') {
            // Validasi input
            $rules = [
                'username' => [
                    'rules' => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
                    'errors' => [
                        'required' => 'Username harus diisi',
                        'min_length' => 'Username minimal 4 karakter',
                        'max_length' => 'Username maksimal 20 karakter',
                        'is_unique' => 'Username sudah digunakan'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'Password harus diisi',
                        'min_length' => 'Password minimal 6 karakter'
                    ]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama lengkap harus diisi'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[customer.email]',
                    'errors' => [
                        'required' => 'Email harus diisi',
                        'valid_email' => 'Format email tidak valid',
                        'is_unique' => 'Email sudah terdaftar'
                    ]
                ],
                'phone' => [
                    'rules' => 'required|numeric|min_length[10]|max_length[15]',
                    'errors' => [
                        'required' => 'Nomor telepon harus diisi',
                        'numeric' => 'Harus berupa angka',
                        'min_length' => 'Minimal 10 digit',
                        'max_length' => 'Maksimal 15 digit'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required|min_length[10]',
                    'errors' => [
                        'required' => 'Alamat harus diisi',
                        'min_length' => 'Alamat minimal 10 karakter'
                    ]
                ]
            ];

            // Cek unik username manual
            $userModel = new UserModel();
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Mulai transaction
            $db = \Config\Database::connect();
            $db->transException(true)->transStart();

            try {
                // Simpan data user
                $userData = [
                    'username' => $this->request->getPost('username'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'role' => 'Customer'
                ];

                $userModel->insert($userData);
                $userId = $userModel->getInsertID();

                // Simpan data user info
                $userInfoModel = new CustomerModel();
                $userInfoData = [
                    'id_users' => $userId,
                    'nama' => $this->request->getPost('nama'),
                    'email' => $this->request->getPost('email'),
                    'phone' => $this->request->getPost('phone'),
                    'alamat' => $this->request->getPost('alamat')
                ];

                $userInfoModel->insert($userInfoData);

                $db->transComplete();

                return redirect()->to(base_url('auth/register'))->with('success', 'Registrasi berhasil! Silakan login');
            } catch (\Exception $e) {
                $db->transRollback();
                log_message('error', 'Registration error: ' . $e->getMessage());
                return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan server');
            }
        }

        // Tampilkan form registrasi
        return view('register');
    }
    protected function findUserByUsernameOrEmail($login)
    {
        $userModel = new UserModel();

        // Cari sebagai username
        $user = $userModel->where('username', $login)->first();
        if ($user) return $user;

        // Cari sebagai email
        $userInfoModel = new CustomerModel();
        $userInfo = $userInfoModel->where('email', $login)->first();
        return $userInfo ? $userModel->find($userInfo->id_users) : null;
    }

    protected function getUserEmail($userId)
    {
        return (new CustomerModel())->where('id_users', $userId)->first()->email ?? '';
    }

    protected function redirectByRole($role)
    {
        $redirectMap = [
            'admin' => '/admin/beranda',
            'customer' => '/'
        ];

        $redirectUrl = $redirectMap[strtolower($role)] ?? '/';
        return redirect()->to($redirectUrl)->with('success', 'Login berhasil!');
    }


    public function checkUser():ResponseInterface
    {
        if (session()->get('logged_in')) 
        {
            return $this->response->setJSON($_SESSION);
        }
        else{
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Belum Login',
            ])->setStatusCode(500, 'Internal Server Error');
        } 
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'))->with('success', 'Anda telah logout');
    }
}
