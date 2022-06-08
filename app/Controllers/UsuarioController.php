<?php

namespace App\Controllers;
use App\Models\RegionesModel;
use App\Models\ComunasModel;
use App\Models\UsuariosModel;
use App\Models\TablaModel;
use App\Models\TableroModel;
use App\Models\InputModel;

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
                'imagenFile' => 'uploaded[imagenFile]|ext_in[imagenFile,jpg,jpeg,gif,png]',
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
                $success = "yes";                   
                 /* Analicis para la imagen */
                 $imageFile1 = $this->request->getFile('imagen');
                 $img = $this->imagen($id, $imageFile1);
                 if($img==0){
                     $img = 'No disponible';
                 }
                if($this->request->getVar('action') == 'add'){
                    $UsuarioModel = new UsuariosModel();
                    $UsuarioModel->insert([
                        'Nombre' =>$this->request->getVar('nombreUsuario'),
                        'Correo' =>$this->request->getVar('emailUsuario'),
                        'clave' =>$this->request->getVar('emailUsuario'),
                        'Tipo' =>$this->request->getVar('tipo'),
                        'telefono' =>$this->request->getVar('telefono'),
                        'imagen' =>$img
                    ]);
                    $message = '<div class="alert alert-success"> Usuario creado con exito </div>';
                }
                if($this->request->getVar('action') == 'edit'){
                    
                    $UsuarioModel = new UsuariosModel();
                    $id = $this->request->getVar('hiden_id');


                    $data = [
                        'Nombre' => $this->request->getVar('nombreUsuario'),
                        //'Correo' =>$this->request->getVar('emailUsuario'),
                        'Tipo' =>$this->request->getVar('tipo'),
                        'telefono' =>$this->request->getVar('telefono'),
                        /*'imagen' =>$this->request->getVar('imagen')*/
                    ];
                    $UsuarioModel->update($id, $data);
                    $message = '<div class="alert alert-info"> Usuario editado con exito </div>';
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
                'imagen' => 'uploaded[imagen]'.'|is_image[imagen]'. '|mime_in[imagen,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                'telefono' => 'required|min_length[9]|max_length[12]', //ejemplo de telefono de casa 752 XXX XXX
            ]);
            if(!$error){
                $error = 'yes';
                $validation = \Config\Services::validation();
                if($validation->getError('nombreUsuario')){
                    $nombre_Usuario_error = $validation->getError('nombreUsuario');
                }
                if($validation->getError('imagen')){
                    $imagen_Usuario_error = $validation->getError('imagen');
                }
                if($validation->getError('tipo')){
                    $tipo_Usuario_error = $validation->getError('tipo');
                }
                if($validation->getError('telefono')){
                    $telefono_Usuario_error = $validation->getError('telefono');
                }
            }
            else{
                $success = "yes";                   
                if($this->request->getVar('action') == 'edit'){
                    
                    $UsuarioModel = new UsuariosModel();
                    $id = $this->request->getVar('hiden_id');

                    /* Analicis para la imagen */
                    $imageFile1 = $this->request->getFile('imagen');
                    $img = $this->imagen($id, $imageFile1);

                    $data = [
                        'Nombre' => $this->request->getVar('nombreUsuario'),
                        'Tipo' =>$this->request->getVar('tipo'),
                        'telefono' =>$this->request->getVar('telefono'),
                        'imagen' =>$img
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
        if(!file_exists($nombre_fichero+'/'+$id)){
            unlink($nombre_fichero+'/'+$id);
        }
        $img->move($nombre_fichero . $name);

        return $name;
    }
}
