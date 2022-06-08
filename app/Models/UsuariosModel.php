<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;


class UsuariosModel extends Model{
    protected $table      = 'usuarios';
    protected $primaryKey = 'idUsuario';

    protected $allowedFields = ['idUsuario','Nombre','Correo','clave','Tipo','imagen','telefono'];
    
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data){
        $data = $this -> passwordHash($data);
        return $data;
    }
    protected function beforeUpdate(array $data){
        $data = $this -> passwordHash($data);
        return $data;
    }  
    protected function passwordHash(array $data){
        if(isset($data['data']['clave']))
            $data['data']['clave'] = password_hash($data['data']['clave'], PASSWORD_DEFAULT,[15]);
        return $data;
        
    }    
    public function noticeTable(){
        $builder = $this->db->table('usuarios');
        return $builder;
    }
    public function buttons(){
        $acction_button = function($row){
            return '<button title="Ver tableros" type="button" name="verTableros" class="btn btn-success btn-sm verTableros"
                    data-id="'.$row['idUsuario'].'"><i class="fa fa-table"></i></button>
                    <button title="Editar usuario" type="button" name="editUsuario" class="btn btn-warning btn-sm editUsuario"
                     data-id="'.$row['idUsuario'].'"><i class="fas fa-edit"></i></button>
                     <button title="Eliminar usuario" type="button" name="deleteUsuario" class="btn btn-danger btn-sm deleteUsuario"
                     data-id="'.$row['idUsuario'].'"><i class="fas fa-times-circle"></i></button>';
        };
        return $acction_button;
    }
}