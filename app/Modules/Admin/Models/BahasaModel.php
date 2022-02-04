<?php
namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class BahasaModel extends Model{

    protected $table = 'tb_bahasa';
    protected $primaryKey = 'id_bahasa';
    protected $allowedFields = ['bahasa'];

}
