<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;


class TableroModel extends Model{
    protected $table      = 'tablero';
    protected $primaryKey = 'idTablero ';

    protected $allowedFields = ['idTablero ','nombreTablero','regionRef','comunaRef','ubicacion',
                                'sector'];

    public function noticeTable(){
        $builder = $this->db->table('tablero');
        return $builder;
    }
    public function buttons(){
        $acction_button = function($row){
            return '<button title="Ver sensores" type="button" name="verSensores" class="btn btn-success btn-sm verTableros"
                    data-id="'.$row['idTablero'].'"><i class="fa fa-dot-circle-o"></i></button>
                    <button title="Editar tablero" type="button" name="editTablero" class="btn btn-warning btn-sm editTablero"
                     data-id="'.$row['idTablero'].'"><i class="fas fa-edit"></i></button>
                     <button title="Eliminar tablero" type="button" name="deleteTablero" class="btn btn-danger btn-sm deleteTablero"
                     data-id="'.$row['idTablero'].'"><i class="fas fa-times-circle"></i></button>';
        };
        return $acction_button;
    }

}
