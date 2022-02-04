<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{

    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $allowedFields = ['username', 'pass', 'role'];
    public function getLogin($username, $pass)
    {
        return $this->db->table('pengguna')
            ->getWhere([
                'username' => $username,
                'pass' => $pass
            ])->getRow();
    }
    public function getPengguna($id_pengguna){
        return $this->where(['id_pengguna'=>$id_pengguna])->first();
    }
}
