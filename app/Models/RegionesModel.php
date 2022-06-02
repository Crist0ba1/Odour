<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;


class RegionesModel extends Model{
    protected $table      = 'regiones';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id','region'];

}