<?php

namespace App\Controllers;
use App\Models\RegionesModel;
use App\Models\ComunasModel;
use App\Models\UsuariosModel;
use App\Models\TablaModel;
use App\Models\TableroModel;
use App\Models\InputModel;
use App\Models\UsuarioTableroModel;
use CodeIgniter\Files\File;

use monken\TablesIgniter;
class UsuarioController extends BaseController
{
    public function dashbord(){

        echo view('Limites/Header');
		echo view('Usuarios/GestionUsuarios');
		echo view('Limites/Fother');
    }
    /********* Gestion de usuarios *********/
    public function Usuario_fetch_all(){   
        $UsuarioModel= new UsuariosModel();
        $data_table = new TablesIgniter();

        $data_table ->setTable($UsuarioModel->noticeTable())
                    //->setDefaultOrder('id', 'DESC') No    
                    ->setSearch(['idUsuario','Nombre','Correo','Tipo','imagen','telefono'])
                    ->setOrder(['idUsuario','Nombre','Correo','Tipo','imagen','telefono'])
                    ->setOutput(['idUsuario','Nombre','Correo','Tipo','imagen','telefono',
                    $UsuarioModel->buttons()]);
        return $data_table->getDatatable();
    }
    public function addUsuario(){
        if($this->request->getVar('action')){
            helper(['from','url']);

            $nombre_Usuario_error = "";
            $correo_Usuario_error = "";
            $tipo_Usuario_error = "";
            $imagen_Usuario_error = "";
            $telefono_Usuario_error = "";
            $error = "no";
            $success ="no";
            $message ="";

            $error = $this->validate([
                'nombreUsuario' => 'required|min_length[2]',
                'emailUsuario' => 'required|valid_email|is_unique[usuarios.Correo]|min_length[2]',
                'tipo' => 'required',
                'imagenFile' => 'uploaded[imagenFile]|is_image[imagenFile]|max_size[imagenFile, 4096]|mime_in[imagenFile,image/jpg,image/jpeg,image/png,image/webp]',
                'telefono' => 'required|min_length[9]|max_length[12]', //ejemplo de telefono de casa 752 XXX XXX
            ]);
            if(!$error){
                $error = 'yes';
                $validation = \Config\Services::validation();
                if($validation->getError('nombreUsuario')){
                    $nombre_Usuario_error = $validation->getError('nombreUsuario');
                }
                if($validation->getError('emailUsuario')){
                    $correo_Usuario_error = $validation->getError('emailUsuario');
                }
                if($validation->getError('tipo')){
                    $tipo_Usuario_error = $validation->getError('tipo');
                }
                if($validation->getError('imagenFile')){
                    $imagen_Usuario_error = $validation->getError('imagenFile');
                }
                if($validation->getError('telefono')){
                    $telefono_Usuario_error = $validation->getError('telefono');
                }
            }
            else{

                if($this->request->getVar('action') == 'add'){

                    // Instancia de modelo Usuario e insertado en la tabla
                    $UsuarioModel = new UsuariosModel();
                    $UsuarioModel->insert([
                        'Nombre' =>$this->request->getVar('nombreUsuario'),
                        'Correo' =>$this->request->getVar('emailUsuario'),
                        'clave' =>$this->request->getVar('emailUsuario'),
                        'Tipo' =>$this->request->getVar('tipo'),
                        'telefono' =>$this->request->getVar('telefono'),
                    ]);

                    // Captura del id de usuario insertado y hashe del nombre de la imagen
                    $insert_id = $UsuarioModel->getInsertID();
                    // Metodo para generar el nombre de la imagen hasheado
                    $imageName = 'empresa-'.$insert_id;
                    $imageNameHash = hash('md5', $imageName);

                    // Se obtiene la imagen de la request HTTP
                    $img = $this->request->getFile('imagenFile');
                    // Se obtiene extension de la imagen
                    $imgExtension = $img->guessExtension();
                    if (!$img->hasMoved()) {
                        // Nombre de imagen hasheado y con extension
                        $hashedImgName = $imageNameHash.".".$imgExtension;
                        // Movemos la imagen a la ubicacion deseada con el nombre hasheado
                        $filepath = $img->move(ROOTPATH.'\\public\\images\\empresa\\', $hashedImgName, true);
                        $data = ['uploaded_flleinfo' => new File($filepath)];
                        // Actualizacion del campo imagen del usuario en back
                        $imageData = [
                            'imagen' => $hashedImgName
                        ];
                        $UsuarioModel->update($insert_id, $imageData);
                        $success = "yes";

                    } else {
                        $message = "Error en subida de imagen.";
                    }

                    $message = '<div class="alert alert-success"> Usuario creado con exito </div>';
                    
                }
                // * ELIMINAR EN CASO DE NO OCUPARSE *
                if($this->request->getVar('action') == 'edit'){
                    
                    $UsuarioModel = new UsuariosModel();
                    $id = $this->request->getVar('hiden_id');

                    // Metodo para generar el nombre de la imagen hasheado 
                    $imageName = 'empresa-'.$insert_id;
                    $imageNameHash = hash('md5', $imageName);

                    // Se obtiene la imagen de la request HTTP
                    $img = $this->request->getFile('imagenFile');
                    // Se obtiene extension de la imagen
                    $imgExtension = $img->guessExtension();
                    // Se declara el nombre de la imagen para el update
                    $hashedImgName = '';
                    if (!$img->hasMoved()) {
                        // Nombre de imagen hasheado y con extension
                        $hashedImgName = $imageNameHash.".".$imgExtension;
                        // Movemos la imagen a la ubicacion deseada con el nombre hasheado
                        $filepath = $img->move(ROOTPATH.'\\public\\images\\empresa\\', $hashedImgName);
                        $data = ['uploaded_flleinfo' => new File($filepath)];
                        $success = "yes";

                    } else {
                        $message = "Error en subida de imagen.";
                    }

                    $data = [
                        'Nombre' => $this->request->getVar('nombreUsuario'),
                        'Correo' =>$this->request->getVar('emailUsuario'),
                        'Tipo' =>$this->request->getVar('tipo'),
                        'telefono' =>$this->request->getVar('telefono'),
                        'imagen' =>$hashedImgName
                    ];

                    $UsuarioModel->update($id, $data);
                    // $message = '<div class="alert alert-info"> Usuario editado con exito </div>';
                }

            }
            $output = array(
                'nombre_Usuario_error' => $nombre_Usuario_error,
                'correo_Usuario_error' => $correo_Usuario_error,
                'tipo_Usuario_error' => $tipo_Usuario_error,
                'imagen_Usuario_error' => $imagen_Usuario_error,
                'telefono_Usuario_error' => $telefono_Usuario_error,
                'error' => $error,
                'success' => $success,
                'message' => $message
            );
            echo json_encode($output);
        }
        
    }
    public function editarUsuario(){
        if($this->request->getVar('action')){
            helper(['from','url']);

            $nombre_Usuario_error = "";
            $tipo_Usuario_error = "";
            $imagen_Usuario_error = "";
            $telefono_Usuario_error = "";
            $error = "no";
            $success ="no";
            $message ="";

            $error = $this->validate([
                'nombreUsuario' => 'required|min_length[2]',
                'tipo' => 'required|max_length[2]',
                'imagenFile' => 'uploaded[imagenFile]|is_image[imagenFile]|max_size[imagenFile, 4096]|mime_in[imagenFile,image/jpg,image/jpeg,image/png,image/webp]',
                'telefono' => 'required|min_length[9]|max_length[12]', //ejemplo de telefono de casa 752 XXX XXX
            ]);
            if(!$error){
                $error = 'yes';
                $validation = \Config\Services::validation();
                if($validation->getError('nombreUsuario')){
                    $nombre_Usuario_error = $validation->getError('nombreUsuario');
                }
                if($validation->getError('imagenFile')){
                    $imagen_Usuario_error = $validation->getError('imagenFile');
                }
                if($validation->getError('tipo')){
                    $tipo_Usuario_error = $validation->getError('tipo');
                }
                if($validation->getError('telefono')){
                    $telefono_Usuario_error = $validation->getError('telefono');
                }
            }
            else{
                $error ="no";
                $success = "yes";                   
                if($this->request->getVar('action') == 'edit'){
                    
                    $UsuarioModel = new UsuariosModel();
                    $id = $this->request->getVar('hiden_id');

                    // Metodo para generar el nombre de la imagen hasheado 
                    $imageName = 'empresa-'.$id;
                    $imageNameHash = hash('md5', $imageName);

                    // Se obtiene la imagen de la request HTTP
                    $img = $this->request->getFile('imagenFile');
                    // Se obtiene extension de la imagen
                    $imgExtension = $img->guessExtension();
                    // Se declara el nombre de la imagen para el update
                    $hashedImgName = '';
                    if (!$img->hasMoved()) {
                        // Nombre de imagen hasheado y con extension
                        $hashedImgName = $imageNameHash.".".$imgExtension;
                        // Movemos la imagen a la ubicacion deseada con el nombre hasheado
                        $filepath = $img->move(ROOTPATH.'\\public\\images\\empresa\\', $hashedImgName, true);
                        $data = ['uploaded_flleinfo' => new File($filepath)];
                        $success = "yes";

                    } else {
                        $message = "Error en subida de imagen.";
                    }

                    $data = [
                        'Nombre' => $this->request->getVar('nombreUsuario'),
                        'Tipo' =>$this->request->getVar('tipo'),
                        'telefono' =>$this->request->getVar('telefono'),
                        'imagen' =>$hashedImgName
                    ];
                    $UsuarioModel->update($id, $data);
                    $message = '<div class="alert alert-info"> Usuario editado con exito </div>';

                }

            }
            $output = array(
                'nombre_Usuario_error' => $nombre_Usuario_error,
                'tipo_Usuario_error' => $tipo_Usuario_error,
                'imagen_Usuario_error' => $imagen_Usuario_error,
                'telefono_Usuario_error' => $telefono_Usuario_error,
                'error' => $error,
                'success' => $success,
                'message' => $message
            );
            echo json_encode($output);
        }
        
    }
    public function deleteUsuario(){
        if($this->request->getVar('id')){
            $id = $this->request->getVar('id');
            $UsuarioModel= new UsuariosModel();
            $UsuarioModel->where('idUsuario',$id)->delete($id);
            return '<div class="alert alert-danger">Usuario eliminado</div>';
        }
        return 'error';
    }
    public function editUsuario(){   

        if($this->request->getVar('id')){
            $usserModel= new UsuariosModel();
            $usuarioData = $usserModel->where('idUsuario',$this->request->getVar('id'))->first();
            return json_encode($usuarioData);
        }
    }
    public function tablaUsuario(){
        echo view('Tablas/TablaUsuarios');
    }
    
    private function imagen($id, $img){
        $nombre_fichero = './public/assets/imgUsser/';
        if(!file_exists($nombre_fichero)){
             mkdir($nombre_fichero, 0777, true);             
         }
        $name = $id+'.'+$img->getClientMimeType(); 
        if(!file_exists($nombre_fichero+$id)){
            unlink($nombre_fichero+$id);
        }
        $img->move($nombre_fichero . $name);

        return "putaLaWea";
    }

    public function tablerosDeUsuario($id){
        $UTmodel = new UsuarioTableroModel();
        $tablerosDeUsuario = $UTmodel->where('refUsuario',$id)->select('refTablero')->findAll();
        return json_encode($tablerosDeUsuario);
        $modalTablero = new TableroModel();
        $infotableros = $modalTablero->where('idTablero',$tablerosDeUsuario)->findAll();
        return json_encode($infotableros);
    }
}
