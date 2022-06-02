<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;


class TablaModel extends Model{
    protected $table      = 'tabla';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id','idDispositivo','valor','fecha'];
    
    
}