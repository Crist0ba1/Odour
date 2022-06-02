<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;


class SensoresModel extends Model{
    protected $table      = 'sensores';
    protected $primaryKey = 'idSensor ';

    protected $allowedFields = ['idSensor ','nombre','tipo'];
    
    public function noticeTable(){
        $builder = $this->db->table('sensores');
        return $builder;
    }
    public function buttons(){
        $acction_button = function($row){
            return '<button type="button" name="editSensor" class="btn btn-warning btn-sm editSensor"
                     data-id="'.$row['idSensor'].'"><i class="fas fa-edit"></i></button>
                     <button type="button" name="deleteSensor" class="btn btn-danger btn-sm deleteSensor"
                     data-id="'.$row['idSensor'].'"><i class="fas fa-times-circle"></i></button>';
        };
        return $acction_button;
    }
    
}