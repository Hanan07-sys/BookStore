<?php
namespace App\Modules\User\Models;

use CodeIgniter\Model;
class NovelModel extends Model{

    protected $table = 'tb_buku';
    protected $useTimestamp = true;
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul','slug','penulis', 'id_genre', 'sinopsis',
    'penerbit','tanggal_terbit','id_bahasa','sampul','ttd',];
    
   
    public  function getNovel()
    {
        return $this->db->table('tb_buku')
            ->join('tb_genre', 'tb_genre.id_genre=tb_buku.id_genre')
            ->join('tb_bahasa', 'tb_bahasa.id_bahasa=tb_buku.id_bahasa')
            ->get()->getResultArray();
    }
    public function getSlug($slug=false){
        if($slug==false){
            return $this->findAll();
        }
        else{
            return $this->where(['slug'=>$slug])->join('tb_genre', 'tb_genre.id_genre=tb_buku.id_genre')
            ->join('tb_bahasa', 'tb_bahasa.id_bahasa=tb_buku.id_bahasa')->first();
        }
    }
    
}
