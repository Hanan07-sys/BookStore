<?php

namespace App\Modules\User\Controllers;
use App\Controllers\BaseController;
use App\Modules\User\Models\PenggunaModel;

class Login extends BaseController
{
    public function index()
    {

        $data =
            [
                'tittle' => 'Login'
            ];
        return view('App\Modules\User\Views\halaman\login', $data);
    }


    public function auth()
    {
        $pengguna = new PenggunaModel();
        $username = $this->request->getPost('username');
        $pass = $this->request->getPost('pass');
        $data = $pengguna->getLogin($username, md5($pass));
        if ($data) {
            $sessiondata = [
                'username' => $data->username,
                'logged_in' => TRUE,
                'role'=> $data->role,
            ];

            session()->set($sessiondata);
        } else {
            session()->setFlashdata('msg', 'Username/Password Salah.');
            return redirect()->to('/login');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
    public function registrasi()
    {
        $validation = \Config\Services::validation();
        $data =
            [
                'tittle' => 'Registrasi',
                'validation' => $validation

            ];
        return view('App\Modules\User\Views\halaman\register', $data);
    }
    public function save()
    {
        $pengguna = new PenggunaModel();
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[pengguna.username]|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi !',
                    'is_unique' => '{field} telah terdaftar !',
                    'min_length' => '{field} minimal karakter 5 !',
                ]
            ],
            'pass' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} harus diisi !',
                    'min_length' => 'Password minimal karakter 8 !',
                ]
            ],
            'confirm_pass' => [
                'rules' => 'required|matches[pass]',
                'errors' => [
                    'required' => '{field} harus diisi !',
                    'matches' => 'Password tidak sama !',
                ]
            ],
        ])) {
            return redirect()->to('/login/registrasi')->withInput();
        }
        $datasimpan = [
            'username' => $this->request->getPost('username'),
            'pass' => md5($this->request->getVar('pass')),
            'role'=> 'user'
        ];
        $pengguna->save($datasimpan);
        session()->setFlashdata('pesan', 'Anda Berhasil Terdaftar.');
        return redirect()->to('/login');
    }
}
