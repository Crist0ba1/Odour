<?php

namespace App\Controllers;

use App\Models\TableroModel;
use App\Models\SensoresModel;
use App\Models\TableroSensorModel;
use monken\TablesIgniter;

class SensoresController extends BaseController
{
    public function gestionSensores(){

        echo view('Limites/Header');
        echo view('Usuarios/GestionSensores');
		echo view('Limites/Fother');
    }
    /********* Gestion de Tableros *********/
    public function sensores_fetch_all(){   
        $TableroModel= new SensoresModel();
        $data_table = new TablesIgniter();
        $data_table ->setTable($TableroModel->noticeTable())
                    ->setSearch(['idSensor','nombre','tipo'])
                    ->setOrder(['idSensor','nombre','tipo'])
                    ->setOutput(['idSensor','nombre','tipo',
                    $TableroModel->buttons()]);
        return $data_table->getDatatable();
    }
    public function addSensor(){
        if($this->request->getVar('actionS')){
            helper(['from','url']);

            $nombre_sensor_error = "";
            $tipo_sensor_error = "";
            $error = "no";
            $success ="no";
            $message ="";

            $error = $this->validate([
                'nombreSensor' => 'required|min_length[2]',
                'tipoSensor' => 'required|min_length[2]'
            ]);
            if(!$error){
                $error = 'yes';
                $validation = \Config\Services::validation();
                if($validation->getError('nombreSensor')){
                    $nombre_sensor_error = $validation->getError('nombreSensor');
                }
                if($validation->getError('tipoSensor')){
                    $tipo_sensor_error = $validation->getError('tipoSensor');
                }
            }
            else{
                $success = "yes";                   
                
                if($this->request->getVar('actionS') == 'add'){
                    
                    $SensoresModel = new SensoresModel();
                    $SensoresModel->insert([
                        'nombre' =>$this->request->getVar('nombreSensor'),
                        'tipo' =>$this->request->getVar('tipoSensor'),
                    ]);
                    $sensor_id = $SensoresModel->getInsertID();
                    $message = '<div class="alert alert-success"> Sensor creado con éxito. </div>';

                    if($this->request->getVar('listTablero')){
                        $listT = $this->request->getVar('listTablero');
                        $tableros = explode(" ", trim($listT));
                        $modelST = new TableroSensorModel();
                        foreach($tableros as $tablero){
                            $modelST->insert([
                                'refTablero' => $tablero,
                                'refSensor' => $sensor_id
                            ]);
                        }
                    }
                }
                if($this->request->getVar('actionS') == 'edit'){
                    
                    $SensoresModel = new SensoresModel();
                    $id = $this->request->getVar('hiden_idS');
                    $data = [
                        'nombre' =>$this->request->getVar('nombreSensor'),
                        'tipo' =>$this->request->getVar('tipoSensor'),                        
                    ];
                    $SensoresModel->update($id, $data);
                    $message = '<div class="alert alert-info"> Sensor editado con exito </div>';

                    if($this->request->getVar('listTablero')){
                        $listT = $this->request->getVar('listTablero');
                        $tableros = explode(" ", trim($listT));

                        $modelST = new TableroSensorModel();
                        $relaciones = $modelST->where('refSensor',$id)->findAll();
                        $relacionesLimpio = array();
                        foreach($relaciones as $relacion){
                            $relacionesLimpio[] = $relacion['refTablero'];
                        }

                        foreach($tableros as $tablero){
                            if (!in_array($tablero, $relacionesLimpio)){
                                $modelST->insert([
                                    'refTablero' => $tablero,
                                    'refSensor' => $id
                                ]);
                            }
                        }
                    }
                }

            }
            $output = array(
                'nombre_sensor_error' => $nombre_sensor_error,
                'tipo_sensor_error' => $tipo_sensor_error,
                'error' => $error,
                'success' => $success,
                'message' => $message,
            );
            echo json_encode($output);
        }
        
    }
    public function deleteSensor(){
        if($this->request->getVar('id')){
            $id = $this->request->getVar('id');
            $SensoresModel= new SensoresModel();
            $SensoresModel->where('idSensor ',$id)->delete($id);
            return '<div class="alert alert-danger">Sensor eliminado</div>';
        }
        return 'error';
    }
    public function editSensor(){   

        if($this->request->getVar('id')){
            $SensoresModel= new SensoresModel();
            $SensoresModel = $SensoresModel->where('idSensor',$this->request->getVar('id'))->first();
            return json_encode($SensoresModel);
        }
    }
    public function tablaSensores(){
        echo view('Tablas/TablaSensores');
    }    

    public function tablerosSensores($idSensor){
        $tableroSensor = new TableroSensorModel();
        $tableros = $tableroSensor->where('refSensor',$idSensor)->select('refTablero')->findAll();
        return json_encode($tableros);
    }
}
