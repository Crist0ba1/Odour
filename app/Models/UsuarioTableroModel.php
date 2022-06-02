<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;


class UsuarioTableroModel extends Model{
    protected $table      = 'usuariotablero';
    protected $primaryKey = 'idUT';

    protected $allowedFields = ['idUT', 'refTablero','refUsuario'];

}