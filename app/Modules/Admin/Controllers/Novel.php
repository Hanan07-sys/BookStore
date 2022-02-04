<?php
namespace App\Modules\Admin\Controllers;
use App\Controllers\BaseController;
use App\Modules\Admin\Models\BahasaModel;
use App\Modules\Admin\Models\GenreModel;
use App\Modules\Admin\Models\NovelModel;


class Novel extends BaseController
{
    protected $novelModel;
    public function __construct()
    {
        $this->novelModel = new NovelModel();
    }
    public function index()
    {

        $genre = new GenreModel();
        $bahasa = new BahasaModel();
        $data['genre'] = $genre->findAll();
        $data['bahasa'] = $bahasa->findAll();
        $data =
            [
                'tittle' => 'Novel',
                'novel' => $this->novelModel->findAll(),

            ];
        return view('App\Modules\Admin\Views\halaman\viewNovel', $data);
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
        return view('App\Modules\Admin\Views\halaman\detail', $data);
    }

    public function create()
    {
        $genre = new GenreModel();
        $bahasa = new BahasaModel();
        $validation = \Config\Services::validation();
        $data =
            [
                'tittle' => 'Form Novel',
                'genre' => $genre->findAll(),
                'bahasa' => $bahasa->findAll(),
                'validation' => $validation,
            ];
        return view('App\Modules\Admin\Views\halaman\create', $data);
    }
    
    public function save()
    {
        //validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[tb_buku.judul]',
                'errors' => [
                    'required' => '{field} novel harus diisi !',
                    'is_unique' => '{field} novel telah terdaftar !',
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} novel harus diisi !',
                ]
            ],
            'sinopsis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} novel harus diisi !',
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} novel harus diisi !',
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Size terlalu besar !',
                    'is_image' => 'Harus berupa gambar !',
                    'mime_in' => 'Harus berupa gambar !'
                ]
            ],
            'ttd' => [
                'rules' => 'max_size[ttd,5120]|ext_in[ttd,pdf,docx]',
                'errors' => [
                    'max_size' => 'Size terlalu besar !',
                    'ext_in' => 'Harus berupa pdf/doc !',
                ]
            ]
        ])) {
            return redirect()->to('/novel/create')->withInput();
        }
        //file
        $sampul = $this->request->getFile('sampul');
        //validasi gambar null
        if ($sampul->getError() == 4) {
            $namaSampul = 'default.png';
        } else {
            //random nama file
            $namaSampul = 'sampul_' . $sampul->getRandomName();
            //ke folder img
            $sampul->move('img', $namaSampul);
        }
        //berkas
        $berkas = $this->request->getFile('ttd');
        //validasi gambar null
        if ($berkas->getError() == 4) {
            $namaBerkas = '-';
        } else {
            //random nama file
            $namaBerkas = 'berkas_' . $berkas->getRandomName();
            //ke folder img
            $berkas->move('berkas', $namaBerkas);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $dataSimpan = [
            'judul' => $this->request->getPost('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getPost('penulis'),
            'id_genre' => $this->request->getPost('genre'),
            'sinopsis' => $this->request->getPost('sinopsis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'tanggal_terbit' => $this->request->getPost('tanggal_terbit'),
            'id_bahasa' => $this->request->getPost('bahasa'),
            'sampul' => $namaSampul,
            'ttd' => $namaBerkas,
        ];
        $this->novelModel->save($dataSimpan);
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan.');
        return redirect()->to('/novel');
    }
    public function delete($id)
    {
        //cari file gambar
        $novel = $this->novelModel->find($id);

        //validasi selain gambar default 
        if ($novel['sampul'] != 'default.png') {
            //hapus file gambar selain default
            unlink('img/' . $novel['sampul']);
        }
        
        unlink('berkas/' . $novel['ttd']);
        //hapus file gambar
        $this->novelModel->delete($id);

        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('/novel');
    }
    public function edit($slug)
    {
        $genre = new GenreModel();
        $bahasa = new BahasaModel();
        $validation = \Config\Services::validation();
        $data =
            [
                'tittle' => 'Form Ubah Novel',
                'genre' => $genre->findAll(),
                'bahasa' => $bahasa->findAll(),
                'novel' => $this->novelModel->getSlug($slug),
                'validation' => $validation,
            ];
        // dd($data);
        return view('App\Modules\Admin\Views\halaman\edit', $data);
    }

    public function update($id)
    {
        //validasi input
        $novelOld = $this->novelModel->getSlug($this->request->getVar('slug'));
        if ($novelOld['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_buku.judul]';
        }
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} novel harus diisi !',
                    'is_unique' => '{field} novel telah terdaftar !',
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} novel harus diisi !',
                ]
            ],
            'sinopsis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} novel harus diisi !',
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} novel harus diisi !',
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Size terlalu besar !',
                    'is_image' => 'Harus berupa gambar !',
                    'mime_in' => 'Harus berupa gambar !'
                ]
            ],
            'ttd' => [
                'rules' => 'max_size[ttd,5120]|ext_in[ttd,pdf,doc]',
                'errors' => [
                    'max_size' => 'Size terlalu besar !',
                    'ext_in' => 'Harus berupa pdf/doc !',
                ]
            ]
        ])) {
            return redirect()->to('/novel/edit/' . $this->request->getVar('slug'))->withInput();
        }
        //update file
        $fileSampul = $this->request->getFile('sampul');
        //validasi perubahan gambar
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            //random nama file
            $namaSampul = $fileSampul->getRandomName();

            //pindah folder file
            $fileSampul->move('img', $namaSampul);
            //hapus file gambar
            unlink('img/' . $this->request->getVar('sampulLama'));
        }
        //berkas
        $berkas = $this->request->getFile('ttd');
        //validasi gambar null
        if ($berkas->getError() == 4) {
            $namaBerkas = '-';
        } else {
            //random nama file
            $namaBerkas = 'berkas_' . $berkas->getRandomName();
            //ke folder img
            $berkas->move('berkas', $namaBerkas);
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $dataSimpan = [
            'id' => $id,
            'judul' => $this->request->getPost('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getPost('penulis'),
            'id_genre' => $this->request->getPost('genre'),
            'sinopsis' => $this->request->getPost('sinopsis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'tanggal_terbit' => $this->request->getPost('tanggal_terbit'),
            'id_bahasa' => $this->request->getPost('bahasa'),
            'sampul' => $namaSampul,
            'ttd' => $namaBerkas,
        ];
        $this->novelModel->save($dataSimpan);
        session()->setFlashdata('pesan', 'Data Berhasil diubah.');
        return redirect()->to('/novel');
    }
 
    
}
