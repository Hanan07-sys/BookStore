<?php
namespace App\Modules\Admin\Controllers;
use App\Controllers\BaseController;
use App\Modules\Admin\Models\PenggunaModel;


class Pengguna extends BaseController
{



    public function index()
    {
        $pengguna = new PenggunaModel();
        $currentPage = $this->request->getVar('page_pengguna') ? $this->request->getVar('page_pengguna') : 1;
        $data =
            [
                'tittle' => 'Pengguna',
                'pengguna' => $pengguna->paginate(5, 'pengguna'),
                'pager' => $pengguna->pager,
                'currentPage' =>  $currentPage,
            ];
        return view('App\Modules\Admin\Views\halaman\Pengguna', $data);
    }
    public function createPengguna()
    {
        $validation = \Config\Services::validation();
        $data =
            [
                'tittle' => 'Registrasi',
                'validation' => $validation

            ];
        return view('App\Modules\Admin\Views\halaman\createPengguna', $data);
    }
    public function createAdmin()
    {
        $validation = \Config\Services::validation();
        $data =
            [
                'tittle' => 'Registrasi Admin',
                'validation' => $validation

            ];
        return view('App\Modules\Admin\Views\halaman\createAdmin', $data);
    }
    public function simpanPengguna()
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
            return redirect()->to('/pengguna/createPengguna')->withInput();
        }
        $datasimpan = [
            'username' => $this->request->getPost('username'),
            'pass' => md5($this->request->getVar('pass')),
            'role' => 'user'
        ];
        $pengguna->save($datasimpan);
        session()->setFlashdata('pesan', 'Berhasil Terdaftar.');
        return redirect()->to('/pengguna');
    }
    public function simpanAdmin()
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
            return redirect()->to('/pengguna/createAdmin')->withInput();
        }
        $datasimpan = [
            'username' => $this->request->getPost('username'),
            'pass' => md5($this->request->getVar('pass')),
            'role' => 'admin'
        ];
        $pengguna->save($datasimpan);
        session()->setFlashdata('pesan', 'Admin Berhasil Terdaftar.');
        return redirect()->to('/pengguna');
    }
    public function deletePengguna($id_pengguna)
    {
        $penggunaModel = new PenggunaModel();
        $pengguna = $penggunaModel->getPengguna($id_pengguna);
        if ($pengguna['role'] == 'user') {
            $penggunaModel->delete($id_pengguna);
            session()->setFlashdata('pesan', 'data berhasil di hapus');
        } else {
            session()->setFlashdata('msg', 'Admin tidak bisa di hapus');
        }
        return redirect()->to('/pengguna');
    }
    public function editPengguna($id_pengguna)
    {
        $penggunaModel = new PenggunaModel();
        $validation = \Config\Services::validation();
        $pengguna = $penggunaModel->getPengguna($id_pengguna);
        if ($pengguna['role'] == 'user') {
            $data =
                [
                    'tittle' => 'Edit Pengguna',
                    'pengguna' => $penggunaModel->getPengguna($id_pengguna),
                    'validation' => $validation,
                ];
            return view('App\Modules\Admin\Views\halaman\editPengguna', $data);
        } else {
            session()->setFlashdata('msg', 'Admin tidak bisa di Ubah');
            return redirect()->to('/pengguna');
        }
    }
    public function updatePengguna($id_pengguna)
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
            return redirect()->to('/pengguna/editPengguna')->withInput();
        }
        $datasimpan = [
            'id_pengguna' => $id_pengguna,
            'username' => $this->request->getPost('username'),
            'pass' => md5($this->request->getVar('pass')),
            'role' => 'user'
        ];
        $pengguna->save($datasimpan);
        session()->setFlashdata('pesan', 'Berhasil Diubah.');
        return redirect()->to('/pengguna');
    }
}
