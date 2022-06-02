<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;


class ComunasModel extends Model{
    protected $table      = 'comunas';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id','comuna', 'region_id'];

}