<?php

namespace App\Modules\Admin\Controllers;
use App\Controllers\BaseController;
use App\Modules\Admin\Models\BahasaModel;


class Bahasa extends BaseController
{


    public function index()
    {
        $bahasa = new BahasaModel();
        $currentPage = $this->request->getVar('page_tb_bahasa') ? $this->request->getVar('page_tb_bahasa') : 1;
        $validation = \Config\Services::validation();
        $data =
            [
                'tittle' => 'Bahasa Novel',
                'bahasa' => $bahasa->paginate(8, 'tb_bahasa'),
                'pager' => $bahasa->pager,
                'currentPage' =>  $currentPage,
                'validation' => $validation,
            ];

        return view('App\Modules\Admin\Views\halaman\viewBahasa', $data);
    }

    public function simpanBahasa()
    {
        $bahasa = new bahasaModel();
        //validasi input
        if (!$this->validate([
            'bahasa' => [
                'rules' => 'required|is_unique[tb_bahasa.bahasa]',
                'errors' => [
                    'required' => '{field} novel harus diisi !',
                    'is_unique' => '{field} novel telah terdaftar !',
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/bahasa')->withInput()->with('validation', $validation);
        }
        $dataSimpan = [
            'bahasa' => $this->request->getPost('bahasa'),
        ];
        $bahasa->save($dataSimpan);
        session()->setFlashdata('pesan', 'Bahasa Berhasil ditambahkan.');
        $validation = \Config\Services::validation();
        return redirect()->to('/bahasa')->withInput()->with('validation', $validation);
    }
    public function deleteBahasa($id)
    {
        $bahasa = new BahasaModel();
        try {
            $bahasa->delete($id);
            session()->setFlashdata('pesan', 'data berhasil di hapus');
            return redirect()->to(base_url('/bahasa'));
        } catch (\Exception $e) {
            session()->setFlashdata('pesan', 'index masih ada, pastikan sudah habis');
            return redirect()->to(base_url('/bahasa'));
            die($e->getMessage());
        }
        return redirect()->to('/bahasa');
    }
}
