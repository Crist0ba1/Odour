<?php
namespace App\Controllers;
use App\Models\RegionesModel;
use App\Models\ComunasModel;
use App\Models\UsuariosModel;
use App\Models\TablaModel;
use App\Models\TableroModel;
use App\Models\InputModel;
use App\Models\UsuarioTableroModel;
use App\Models\TableroSensorModel;
use App\Models\SensoresModel;

class Home extends BaseController
{

    public function login(){
        if( session()->get('isLoggedIn')){
            return redirect()->to('/inicio');
        }else{
            echo view('Login');
        }
        
    }
    public function iniciarSession(){
		helper(['form']);

		if($this-> request -> getMethod() == 'post') {

            if(isset($_POST))
            {
                $secretKey 	= '6LcI28EfAAAAAHTh3IJrzygw6qhwHOPTlSJGiszl';
                $token 		= $_POST["g-token"];
                
                $url = "https://www.google.com/recaptcha/api/siteverify";
                $data = array('secret' => $secretKey, 'response' => $token);
            
                // use key 'http' even if you send the request to https://...
                $options = array('http' => array(
                    'method'  => 'POST',
                    'header' => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => http_build_query($data)
                ));
                $context  = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                $response = json_decode($result);
                if($response->success)
                {
                    $bool = $this->validarUSuario($this->request->getVar('emailrL'),$this->request->getVar('passwordrL'));

                    if(!$bool){
                        return redirect()->to('/')->with('mensaje',"Error, credenciales de acceso invalidas");
                    } else{
                        $model = new UsuariosModel();
                        $user = $model->where('Correo', $this->request->getVar('emailrL'))->first();

                        $this-> setUserSession($user); // aqui tenemos ya al usuario que corresponde

                        if($user['Tipo']==0){//admin
                            return redirect()->to('/inicio');
                        }
                        elseif($user['Tipo']==1){//viewer
                            return redirect()->to('/inicio');
                        }
                        else{
                            echo "No deberias estar aqui";
                        }
                    }
                }
                else
                {
                    return redirect()->to('/')->with('mensaje','Error, intente mas tarde');
                }
                
                
            }

            
		}
        else{
            return redirect()->to('/')->with('mensaje','Error, intente mas tarde');
        }		
            
    }
    public function index(){
        // $modelC = new ComiteModel();
        // $data['numComites'] = $modelC->countAllResults();
        // $modelP = new PersonasModel();
        // $data['numPersonas'] = $modelP->countAllResults();
        // if( session()->get('isLoggedIn')){
        //     $data['nombre'] = session()->get('nombre');
        // }else{
        //     $data['nombre'] = "No cargo el nombre ql";
        // }
        // echo view('Header',$data);    
        // //echo view('Inicio/TablasInicio');
		// echo view('footer');
        
    }
    private function setUserSession($user){
		$data =[
			'id' => $user['idUsuario'],
			'nombre' => $user['Nombre'],
			'email' => $user['Correo'],            
			'tipo' => $user['Tipo'],
			'isLoggedIn' => true,
		];
		session()->set($data);
		
		return true;
	}
	public function logout(){
		if(!session()->get('isLoggedIn'))
			redirect()->to('/');
			
		session()->destroy();
		return redirect()->to('/');
	}
    private function validarUSuario($correo,$clave){
        $model = new UsuariosModel();
        $user = $model-> where('Correo', $correo)
            ->first();
        if(!$user)
            return false;
        
        return password_verify($clave,$user['clave']);

    }
    public function inicio(){

        $menu = 'inicio';
        $data['menu'] = $menu;
        
        if( session()->get('isLoggedIn') ){

            $idUsuario = session()->get('id');

            // Se obtiene la referencia los tableros de un usuario
            $tableroUsuarioModel = new UsuarioTableroModel();
            $tablerosUsuario = $tableroUsuarioModel->select('refTablero')->where('refUsuario', $idUsuario)->findAll();

            if (!empty($tablerosUsuario)){
                // Se limpia la respuesta en $tablerosUsuariosLimpiado[] para la clausula ->whereIn() del modelo TableroModel
                $tablerosUsuariosLimpiado = [];
                foreach ($tablerosUsuario as $tablero){
                    $tablerosUsuariosLimpiado[] = $tablero['refTablero'];
                }

                // Se obtiene los datos de los tableros de un usuario
                $tableroModel = new TableroModel();
                $tableros = $tableroModel->whereIn('idTablero', $tablerosUsuariosLimpiado)->findAll();
                
                $data['tableros'] = $tableros;

                $tableroSensor = new TableroSensorModel();
                $idSensoresPrimerTablero = $tableroSensor->where('refTablero', $tableros[0]['idTablero'])->findAll();

                if (!empty($idSensoresPrimerTablero)){
                
                    // Se limpia la respuesta en $idSensoresPrimerTablero[] para la clausula ->whereIn() del modelo SensoresModel
                    $sensoresTableroLimpiado = [];
                    foreach ($idSensoresPrimerTablero as $sensor){
                        $sensoresTableroLimpiado[] = $sensor['refSensor'];
                    }

                    $sensorModel = new SensoresModel();
                    $sensores = $sensorModel->whereIn('idSensor', $sensoresTableroLimpiado)->findAll();

                    $data['sensores'] = $sensores;

                } else {
                    $data['sensores'] = array();
                }

            } else {
                $data['tableros'] = array();
            }           
            
            echo view('Limites/Header',$data);
            echo view('Usuarios/Graficos',$data);
            echo view('Limites/Fother');

        } else {
            return redirect()->to('/');
        }

    }
    public function dashbord(){
        $menu = 'dashboard';
        $data['menu'] = $menu;
        $modelR = new RegionesModel();
		$modelCo = new ComunasModel();
        $modelU = new UsuariosModel();
        $tableroModel = new TableroModel();
        $data['region'] = $modelR->findAll();
		$data['comuna'] = $modelCo->findAll();
        $data['usuarios'] = $modelU->select('idUsuario, Nombre, Correo')->findAll();
        $data['tableros'] = $tableroModel->select('idTablero, nombreTablero')->findAll();
        echo view('Limites/Header',$data);
		echo view('Usuarios/GestionUsuarios');
        echo view('Usuarios/GestionTableros',$data);
        echo view('Usuarios/GestionSensores',$data);
		echo view('Limites/Fother');
    }
    public function initChart() {

        $db = new TablaModel();
        $db = $db->findAll();
        $products = [];
        foreach($db as $row) {
            $products[] = array(
                'fecha'   => $row['fecha'],
                'valor' => $row['valor']
            );
        }
        return json_encode($products); 
    }
    public function initChart1() {
        $db = new TablaModel();
        $db = $db->findAll();
        $products = [];
        foreach($db as $row) {
            $products['fecha'] = array(
                'fecha'   => $row['fecha'],
            );
            $products['valor'] = array(
                'valor' => $row['valor']
            );
        }
        $arrayString = "['fecha','valor']";
        foreach($db as $row) {
            $arrayString += ",['".$row['fecha']."','".$row['valor']."']";
        }
        
        return json_encode($products);           
    }
    public function registrarDatos($initCadena,$idDispositivo, $val_analog){
        //$aux = $this->initCadena();
        //if( intval($initCadena) != intval($initCadena)){
        //    return false;
        //}else{
        $db = new TablaModel();
        $data['idDispositivo'] =$idDispositivo;
        $data['valor'] = $val_analog;
        $db->insert($data);
        return true;
        //}
    }
    public function inputs(){
        $db = new TablaModel();
        $data = $db->findAll();
        $valores = array();
        $suma = 0;
        foreach ($data as $val) {
            $suma += $val['valor'];
            array_push($valores, $val['valor']);
        }

        $data1['promedio'] = $suma /count($valores);;
        $data1['medidaMaxima'] = max($valores);
        $data1['medidaMinima'] = min($valores);
        $data1['numDatos'] = $db->countAllResults();
        return json_encode($data1);
    }
    public function reset(){
        $db = new TablaModel();
        if($db->emptyTable()){
            $data['valor'] = 0;
            $db->insert($data);
            return true;
        }
        return false;
    }
    public function enviarCorreo(){
        if($this-> request -> getMethod() == 'post') {

            $nombre = $this->request->getVar('name');
            $correo = $this->request->getVar('email');
            $mensaje = $this->request->getVar('mensaje');

            $email = \Config\Services::email();

            $email->setFrom('Contacto@nucleova.com', 'Formulario');
            //$email->setTo($userData['email']);
            $email->setTo('Contacto@nucleova.com');
            $email->setSubject('Correo enviado desde la pagina, NO CONTESTAR');
            $email->setMessage('
                <p>'.$nombre.', a enviado el siguiente mensaje.<p>
                <p>'.$mensaje.'.<p>
                <p><b>Correo del emisor:</b> '.$correo.'.<p>
                
                <h3>Atentamente: EQUIPO NUCLEOVA</h3>'
            );
    
    
            if($email->send()){
                //echo "<script>alert('Se envio el correo');</script>";
            }
            else{
                //echo "<script>alert('No se envio el correo');</script>";
            }

            //return redirect()->to('/inicio');
        }
    }
    private function initCadena(){
        return date("n");
    }
}
