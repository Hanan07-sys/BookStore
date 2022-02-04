<?php
namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class GenreModel extends Model{

    protected $table = 'tb_genre';
    protected $primaryKey = 'id_genre';
    protected $allowedFields = ['genre'];

}
