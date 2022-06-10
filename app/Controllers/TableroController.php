<?php

namespace App\Controllers;
use App\Models\RegionesModel;
use App\Models\ComunasModel;
use App\Models\TableroModel;
use monken\TablesIgniter;
use App\Models\UsuariosModel;
use App\Models\UsuarioTableroModel;
use App\Models\InputModel;

use App\Models\SensoresModel;
use App\Models\TableroSensorModel;

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
                        $listU = explode(" ", trim($listU));;

                        $modelU = new UsuarioTableroModel();
                        foreach($listU as $user){
                            $modelU->insert([
                                'refUsuario' => $user,
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

                    if($this->request->getVar('listusuarios')){
                        $listU = $this->request->getVar('listusuarios');
                        $listU = array_map('intval', explode(" ", trim($listU)));

                        $modelU = new UsuarioTableroModel();
                        $relaciones = $modelU->where('refTablero',$id)->findAll();
                        $relacionesLimpio = array();
                        foreach($relaciones as $relacion){
                            $relacionesLimpio[] = $relacion['refUsuario'];
                        }

                        foreach($listU as $user){
                            if (!in_array($user, $relacionesLimpio)){
                                $modelU->insert([
                                    'refUsuario' => $user,
                                    'refTablero' => $id
                                ]);
                            }
                        }
                    }

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

    public function getDataSensores(){

        if( session()->get('isLoggedIn') ){
            
            $idTablero = $this->request->getVar('tablero');
            // $fechaInicio = $this->request->getVar('tablero');
            // $fechaTermino = $this->request->getVar('tablero');

            $tableroSensor = new TableroSensorModel();
            $idSensoresTablero = $tableroSensor->where('refTablero', $idTablero)->findAll();

            if (!empty($idSensoresTablero)){

                // Se limpia la respuesta en $idSensoresTablero[] para la clausula ->whereIn() del modelo SensoresModel
                $sensoresTableroLimpiado = [];
                foreach ($idSensoresTablero as $sensor){
                    $sensoresTableroLimpiado[] = $sensor['refSensor'];
                }

                $response = array();
            
                $inputModel = new InputModel();
                $inputs = $inputModel->where('refTablero', $idTablero)->orderBy('refSensor', 'ASC')->orderBy('fecha', 'ASC')->findAll();

                foreach($sensoresTableroLimpiado as $sensor){
                    foreach($inputs as $input){
                        if ($input['refSensor']==$sensor){
                            $response[$sensor][] = $input;
                        }                        
                    }
                }
                
                return json_encode($response);


            } else {

            }

        } else {
            return redirect()->to('/');
        } 

    }

    public function getTablerosHTML(){

        if( session()->get('isLoggedIn') ){

            $html = '';
            $idTablero = $this->request->getVar('tablero');

            $tableroSensor = new TableroSensorModel();
            $idSensoresTablero = $tableroSensor->where('refTablero', $idTablero)->findAll();

            if (!empty($idSensoresTablero)){
            
                // Se limpia la respuesta en $idSensoresTablero[] para la clausula ->whereIn() del modelo SensoresModel
                $sensoresTableroLimpiado = [];
                foreach ($idSensoresTablero as $sensor){
                    $sensoresTableroLimpiado[] = $sensor['refSensor'];
                }

                $sensorModel = new SensoresModel();
                $sensores = $sensorModel->whereIn('idSensor', $sensoresTableroLimpiado)->findAll();

                ?>

                <div class="row mr-2 ml-2">

                <?php

                foreach($sensores as $sensor){
                    
                ?>
                    <div class="col-sm-12 col-md-6 p-4">
                        <div class="row custom-cart p-3">
                            <div class="col-12 text-center">
                                <br>
                                <h4>Sensor de <?php echo $sensor['nombre'] ?></h4>
                                <a id="resetBtn" onclick="" class="btn btn-primary">Reiniciar</a>
                                <a id="resetBtn" onclick="" class="btn btn-primary">Pausar</a>
                                <a id="resetBtn" onclick="" class="btn btn-primary">Descargar CSV</a>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="col">
                                    <div id="GoogleLineChart-<?php echo $sensor['idSensor'] ?>" style="height: 400px; width: 100%" class="sensor_id" value="<?php echo $sensor['idSensor'] ?>"></div>

                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <br>
                                <div class="col-12">
                                    <h4>Información estadística</h4>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-5 col-sm-5">
                                        <button type="button" class="btn btn-primary btn-block">
                                            N° de mediciones hechas <span id="numDatos" class="badge badge-light"></span>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-block">
                                            Promedio <span id="promedio" class="badge badge-light"></span>
                                        </button>
                                    </div>
                                    <div class="col-5 col-sm-5">
                                        <button type="button" class="btn btn-danger btn-block">
                                            Medición máxima <span id="medidaMaxima" class="badge badge-light"></span>
                                        </button>
                                        <button type="button" class="btn btn-info btn-block">
                                            Medición mínima <span id="medidaMinima" class="badge badge-light"></span>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                    
                <?php 
                // Fin ciclo for
                }

                ?>

                </div>

                <?php

            } else {
                $html = '<div class="container mt-4">
                            <div class="row justify-content-md-center">
                                <div class="col-md-7">
                                    <div class="alert alert-danger" role="alert">
                                        Estimado usuario, el <i>Tablero</i> seleccionado no cuenta con ningún <i>Sensor</i> asociado.
                                    </div>
                                </div>
                            </div>
                        </div>';
                return $html;
            }

        } else {
            return redirect()->to('/');
        } 

    }


}
