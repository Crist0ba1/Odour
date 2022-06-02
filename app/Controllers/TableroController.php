<?php

namespace App\Controllers;
use App\Models\RegionesModel;
use App\Models\ComunasModel;
use App\Models\TableroModel;
use monken\TablesIgniter;
use App\Models\UsuariosModel;
use App\Models\UsuarioTableroModel;
class TableroController extends BaseController
{
    public function gestionTableros(){
        $modelR = new RegionesModel();
		$modelCo = new ComunasModel();
        $modelU = new UsuariosModel();
        $data['region'] = $modelR->findAll();
		$data['comuna'] = $modelCo->findAll();
        $data['usuarios'] = $modelU->findAll();
        echo view('Limites/Header');
        echo view('Usuarios/GestionTableros',$data);
		echo view('Limites/Fother');
    }
    /********* Gestion de Tableros *********/
    public function tableros_fetch_all(){   
        $TableroModel= new TableroModel();
        $data_table = new TablesIgniter();
        $data_table ->setTable($TableroModel->noticeTable())
                    ->setSearch(['idTablero','nombreTablero','sector'])
                    ->setOrder(['idTablero','nombreTablero','sector'])
                    ->setOutput(['idTablero','nombreTablero','sector',
                    $TableroModel->buttons()]);
        return $data_table->getDatatable();
    }
    public function addTablero(){
        if($this->request->getVar('actionGT')){
            helper(['from','url']);

            $nombre_Tableros_error = "";
            $ubicacion_Tableros_error = "";
            $sector_Tableros_error = "";
            $error = "no";
            $success ="no";
            $message ="";

            $error = $this->validate([
                'nombreTableros' => 'required|min_length[2]',
                'region' => 'required',
                'comuna' => 'required',
                'ubicacionTablero' => 'required|min_length[2]',
                'sectorTablero' => 'required|min_length[2]',
                /*'imagen' => 'required'*/
            ]);
            if(!$error){
                $error = 'yes';
                $validation = \Config\Services::validation();
                if($validation->getError('nombreTableros')){
                    $nombre_Tableros_error = $validation->getError('nombreTableros');
                }
                if($validation->getError('ubicacionTablero')){
                    $ubicacion_Tableros_error = $validation->getError('ubicacionTablero');
                }
                if($validation->getError('sectorTablero')){
                    $sector_Tableros_error = $validation->getError('sectorTablero');
                }
            }
            else{
                $success = "yes";                   
                
                if($this->request->getVar('actionGT') == 'add'){
                    $tableroModel = new TableroModel();
                    $tableroModel->insert([
                        'nombreTablero' =>$this->request->getVar('nombreTableros'),
                        'regionRef' =>$this->request->getVar('region'),
                        'comunaRef' =>$this->request->getVar('comuna'),
                        'ubicacion' =>$this->request->getVar('ubicacionTablero'),
                        'sector' =>$this->request->getVar('sectorTablero'),
                    ]);
                    $tablero_id = $tableroModel->getInsertID();
                    $message = '<div class="alert alert-success"> Tablero creado con exito </div>';

                    if($this->request->getVar('listusuarios')){
                        $listU = $this->request->getVar('listusuarios');
                        $listU = $this->stringToarray($listU);

                        $modelU = new UsuarioTableroModel();
                        foreach($listU as $usser){
                            $modelU->insert([
                                'refUsuario' => $usser,
                                'refTablero' => $tablero_id
                            ]);
                        }
                    }
                }
                if($this->request->getVar('actionGT') == 'edit'){
                    
                    $tableroModel = new TableroModel();
                    $id = $this->request->getVar('hiden_idGT');
                    $data = [
                        'nombreTablero' =>$this->request->getVar('nombreTableros'),
                        'regionRef' =>$this->request->getVar('region'),
                        'comunaRef' =>$this->request->getVar('comuna'),
                        'ubicacion' =>$this->request->getVar('ubicacionTablero'),
                        'sector' =>$this->request->getVar('sectorTablero'),
                    ];
                    $tableroModel->update($id, $data);
                    $message = '<div class="alert alert-info"> Tablero editado con exito </div>';
                }

            }
            $output = array(
                'nombre_Tableros_error' => $nombre_Tableros_error,
                'ubicacion_Tableros_error' => $ubicacion_Tableros_error,
                'sector_Tableros_error' => $sector_Tableros_error,
                'error' => $error,
                'success' => $success,
                'message' => $message
            );
            echo json_encode($output);
        }
        
    }
    public function deleteTablero(){
        if($this->request->getVar('id')){
            $id = $this->request->getVar('id');
           // $tableroModel= new TableroModel();
           // $tableroModel->where('idTablero',$id)->delete();
            /* No elimina*/
            $modelUT = new UsuarioTableroModel();
            $auxDelete = $modelUT->where('refTablero',$id)->select('idUT')->findAll();
            $modelUT->orWhereIn('idUT',$auxDelete)->delete();

            //$modelUT->where('refTablero',$id)->delete($id);

            return '<div class="alert alert-danger">Tablero eliminado, falta eliminar la tabla intermedia'.json_encode($auxDelete).'</div>';
        }
        return 'error';
    }
    public function editTablero(){   

        if($this->request->getVar('id')){
            $TableroModel= new TableroModel();
            $TableroModel = $TableroModel->where('idTablero',$this->request->getVar('id'))->first();
            return json_encode($TableroModel);
        }
    }
    public function tablaTableros(){
        echo view('Tablas/TablaTableros');
    }    
    public function usuariosTableros($idTablero){
        $modelUT = new UsuarioTableroModel();
        $usuarios = $modelUT->where('refTablero',$idTablero )->select('refUsuario')->findAll();
        return json_encode($usuarios);
        //return $usuarios;
    }
    private function stringToarray($cadena){
        $cadena = rtrim($cadena);
        $array = explode(" ",$cadena);
        return $array;
    }
}
