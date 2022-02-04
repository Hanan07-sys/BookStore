<?php
namespace App\Modules\Admin\Controllers;
use App\Controllers\BaseController;
use App\Modules\Admin\Models\GenreModel;



class Genre extends BaseController
{
    public function index()
    {

        $genre = new GenreModel();
        $currentPage = $this->request->getVar('page_tb_genre') ? $this->request->getVar('page_tb_genre') : 1;
        $validation = \Config\Services::validation();
        $data =
            [

                'tittle' => 'Genre Novel',
                'genre' => $genre->paginate(8, 'tb_genre'),
                'pager' => $genre->pager,
                'currentPage' =>  $currentPage,
                'validation' => $validation,
            ];

        return view('App\Modules\Admin\Views\halaman\viewGenre', $data);
    }
    
    public function simpanGenre()
    {
        $genre = new GenreModel();
        //validasi input
        if (!$this->validate([
            'genre' => [
                'rules' => 'required|is_unique[tb_genre.genre]',
                'errors' => [
                    'required' => '{field} novel harus diisi !',
                    'is_unique' => '{field} novel telah terdaftar !',
                ]
            ]
        ])) {
            return redirect()->to('/genre')->withInput();
        }
        $dataSimpan = [
            'genre' => $this->request->getPost('genre'),
        ];
        $genre->save($dataSimpan);
        session()->setFlashdata('pesan', 'Genre Berhasil ditambahkan.');
        return redirect()->to('/genre')->withInput();
    }
    public function deleteGenre($id)
    {
        $genre = new GenreModel();
        try {
            $genre->delete($id);
            session()->setFlashdata('pesan', 'data berhasil di hapus');
            return redirect()->to(base_url('/genre'));
        } catch (\Exception $e) {
            session()->setFlashdata('pesan', 'index masih ada, pastikan sudah habis');
            return redirect()->to(base_url('/genre'));
            die($e->getMessage());
        }
        return redirect()->to('/genre');
    }
}
