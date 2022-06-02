<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;


class InputModel extends Model{
    protected $table      = 'input';
    protected $primaryKey = 'idInput';

    protected $allowedFields = ['idInput','refSensor','valor','fecha'];

    public function noticeTable(){
        $builder = $this->db->table('tablero');
        return $builder;
    }
    public function buttons(){
        $acction_button = function($row){
            return '<!--button type="button" name="editTablero" class="btn btn-warning btn-sm editTablero"
                     data-id="'.$row['idInput'].'"><i class="fas fa-edit"></i></button-->
                     <button type="button" name="deleteTablero" class="btn btn-danger btn-sm deleteTablero"
                     data-id="'.$row['idInput'].'"><i class="fas fa-times-circle"></i></button>';
        };
        return $acction_button;
    }
    
    
}