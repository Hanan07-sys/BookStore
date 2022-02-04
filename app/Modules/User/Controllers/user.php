<?php

namespace App\Modules\User\Controllers;
use App\Controllers\BaseController;
use App\Modules\User\Models\PenggunaModel;
use App\Modules\User\Models\NovelModel;


class user extends BaseController
{   
    protected $novelModel;
    public function __construct()
    {
        $this->novelModel = new NovelModel();
    }
    public function index()
    {
        $novel = new NovelModel();
        $pengguna = new PenggunaModel(); 
        $data =
            [
                'tittle' => 'Home',
                'novel' => $novel->getNovel(),
                'pengguna'=> $pengguna->findAll()
            ];
        return view('App\Modules\User\Views\halaman\home', $data);
    }
    public function novel()
    {

        $currentPage = $this->request->getVar('page_tb_buku') ? $this->request->getVar('page_tb_buku') : 1;
        $data =
            [
                'tittle' => 'Novel',
                'novel' => $this->novelModel->paginate(3, 'tb_buku'),
                'pager' => $this->novelModel->pager,
                'currentPage' =>  $currentPage,

            ];
        return view('App\Modules\User\Views\halaman\viewNovel', $data);
    }
    public function detail($slug)
    {

        $data =
            [
                'tittle' => 'Detail Novel',
                'novel' => $this->novelModel->getSlug($slug)
            ];
        if (empty($data['novel'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Novel ' . $slug .
                ' tidak ditemukan');
        }
        return view('App\Modules\User\Views\halaman\detail', $data);
    }

}
