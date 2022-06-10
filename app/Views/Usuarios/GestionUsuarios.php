<div class="container-fluid mb-4">   
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header"> 
                    <div class="row">
                        <div class="col-12 d-inline-flex">
                            <h3> <i class="fa fa-address-book" aria-hidden="true"></i> Usuarios </h3>        
                            <button type="button" name="btnAddUsuario" id="btnAddUsuario" class="btn btn-secondary btn-icon-split ml-auto" data-toggle="modal" data-target="#addUsuario">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="text">Agregar Usuario</span>
                            </button>
                        </div>                
                    </div>
                </div>        
                <span id="mensajeUsuario"></span>
                <div class="card-body" id="tablaUsuario" >
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Usuario -->
<form id="AddUsuarioModal" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="addUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ingrese datos del Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre de Usuario:</label>
                    <input type="text" class="form-control" name="nombreUsuario" id="nombreUsuario" required placeholder="Nombre del Usuario">
                    <span id="nombre_Usuario_error" class="text-danger">
                </div>   
                <div class="form-group">
                    <label>Correo:</label>
                    <input type="email" class="form-control" name="emailUsuario" id="emailUsuario" placeholder="correo@ejempplo.com">
                    <span id="correo_Usuario_error" class="text-danger">
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <select class="form-control" id="tipo" name="tipo">
                        <option value="1" selected>Usuario</option>
                        <option value="0">Administrador</option>
                        <option value="">Empresa..(Actualizacion)</option>
                    </select>
                    <span id="tipo_Usuario_error" class="text-danger">
                </div>  
                <div class="form-group">
                    <label for="tipo">Imagen:</label>
                    <input type="file" name="imagenFile" id="imagenFile" class="form-control" />
                    <span id="imagen_Usuario_error" class="text-danger">
                </div> 
                <div class="form-group">
                    <label for="tipo">Telefono:</label>
                    <input type="tel" name="telefono" id="telefono" class="form-control"  minlength="9" maxlength="12" />
                    <span id="telefono_Usuario_error" class="text-danger">
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                <input type="hidden" name ="hiden_id" id="hiden_id"/>
                <input type="hidden" name ="action" id="action" value="add" />
                <input type="submit" name ="submit" id="submit_buttonGU" class="btn btn-primary" value="Agregar" />
            </div>
            </div>
        </div>
    </div>
</form>

<div id="verTablerosModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tableros asignados al usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>tablero tablero tablero</p>
        <div id="mostrarTableros"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
           
           $(document).ready(function() {    
                $(document).on('click', '.verTableros',function(){
                    var id = $(this).data('id');
                    
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url('/tablerosDeUsuario')?>/"+id,
                        success: function(data) {
                            $('#verTablerosModal').modal("show"); 
                            //Cargamos finalmente el contenido deseado
                            setTimeout(function () {
                                $('#mostrarTableros').fadeIn(1000).html(data);
                            }, 1500);
                            
                        },
                        error : function(xhr, status) {
                            alert('Disculpe, existió un problema');
                        }
                    });
                    
                });
                //Añadimos la imagen de carga en el contenedor
                $('#tablaUsuario').html('<div class="d-flex justify-content-center"><img src="https://c.tenor.com/28DFFVtvNqYAAAAC/loading.gif" width="125" /><br/>Cargado tablas...</div>');
                
                $('#btnAddUsuario').click(function(){
                    $('#AddUsuarioModal')[0].reset();
                    $('#nombre_Usuario_error').text('');
                    $('#correo_Usuario_error').text('');
                    $('#tipo_Usuario_error').text('');
                    $('#imagen_Usuario_error').text('');
                    $('#telefono_Usuario_error').text('');
                    $('#action').val('add');
                    $('#addUsuario').modal("show");
                });
                
                $('#AddUsuarioModal').on('submit',function(event){
                    event.preventDefault();

                    if($('#action').val() == 'edit'){
                        $.ajax ({
                            type: "POST",
                            url: "<?php echo base_url('/editarUsuario')?>",
                            data: $(this).serialize(),
                            enctype: 'multipart/form-data',
                            beforSend: function(){
                                $('#submit_buttonGU').val('Espere...');
                                $('#submit_buttonGU').attr('disabled','disabled');
                            },
                            success: function(data){
                                if(data.error == "yes"){
                                    $('#nombre_Usuario_error').text(data.nombre_Usuario_error);
                                    $('#correo_Usuario_error').text(data.correo_Usuario_error);
                                    $('#tipo_Usuario_error').text(data.tipo_Usuario_error);
                                    $('#imagen_Usuario_error').text(data.imagen_Usuario_error);
                                    $('#telefono_Usuario_error').text(data.telefono_Usuario_error);
                                }
                                if(data.success=="yes"){                                    
                                    $('#submit_buttonGU').val('Agregar');
                                    $('#submit_buttonGU').attr('disabled',false);
                                    $('#emailUsuario').attr('readonly',false);
                                    $('#addUsuario').modal("hide");
                                    $('#mensajeUsuario').html(data.message);
                                    $('#tablaUsuarios').DataTable().ajax.reload();


                                    setTimeout(() => {
                                        $('#mensajeSensores').html('');
                                    }, 5000);
                                }
                                Console.log("PUTA LA WEA");
                            }

                        })
                    }
                    else{
                        const form = document.getElementById('AddUsuarioModal');
                        var formData = new FormData(form);
                        formData.append('nombreUsuario', $('#nombreUsuario').val());
                        formData.append('emailUsuario', $('#emailUsuario').val());
                        formData.append('tipo', $('#tipo').val());
                        formData.append('telefono', $('#telefono').val());
                        //formData.append('imagenFile', imagenFile.files[0]);
                        $.ajax ({
                            type: "POST",
                            url: "<?php echo base_url('/addUsuario')?>",
                            data: formData,
                            beforSend: function(){
                                $('#submit_buttonGU').val('Espere...');
                                $('#submit_buttonGU').attr('disabled','disabled');
                            },
                            success: function(data){
                                $('#submit_buttonGU').val('Agregar');
                                $('#submit_buttonGU').attr('disabled',false);
                                if(data.error == "yes"){
                                    $('#nombre_Usuario_error').text(data.nombre_Usuario_error);
                                    $('#correo_Usuario_error').text(data.correo_Usuario_error);
                                    $('#tipo_Usuario_error').text(data.tipo_Usuario_error);
                                    $('#imagen_Usuario_error').text(data.imagen_Usuario_error);
                                    $('#telefono_Usuario_error').text(data.telefono_Usuario_error);
                                }
                                else{
                                    $('#addUsuario').modal("hide");
                                    $('#mensajeUsuario').html(data.message);
                                    $('#tablaUsuarios').DataTable().ajax.reload();

                                    setTimeout(() => {
                                        $('#mensajeUsuario').html('');
                                    }, 5000);
                                }
                            }

                        })
                    }
                });

                $(document).on('click', '.editUsuario',function(){
                    var id = $(this).data('id');
                    $.ajax({
                        url:"<?php echo base_url('/editUsuario')?>",
                        type: "POST",                        
                        data:{id:id},
                        dataType:'Json',
                        success:function(data){
                            //alert(JSON.stringify(data));
                            $('#nombreUsuario').val(data.Nombre);
                            $('#emailUsuario').val(data.Correo);
                            $('#emailUsuario').attr('readonly','readonly');
                            $('#tipo').val(data.Tipo);
                            //$('#imagen').val(data.imagen);
                            $('#telefono').val(data.telefono);
                            $('#hiden_id').val(id);
                            $('#nombre_Usuario_error').text('');
                            $('#correo_Usuario_error').text('');
                            $('#tipo_Usuario_error').text('');
                            $('#imagen_Usuario_error').text('');
                            $('#telefono_Usuario_error').text('');
                            $('#action').val('edit');
                            $('#submit_buttonGU').val('Editar');
                            $('#addUsuario').modal("show");                            
                        },
                        error:function(){
                            alert("Error en la llamada AJAX");
                        }
                    });
                });

                $(document).on('click', '.deleteUsuario',function(){
                    var id = $(this).data('id');
                    if(confirm("Esta seguro que desea eliminar el Usuario id: "+id)){
                        $.ajax({
                            url:"<?php echo base_url('/deleteUsuario')?>",
                            type: "POST",                        
                            data:{id:id},
                            success:function(data){
                                $('#mensajeUsuario').html(data);
                                $('#tablaUsuarios').DataTable().ajax.reload();
                                setTimeout(() => {
                                    $('#mensajeUsuario').html('');
                                }, 5000);
                            },
                            error:function(){
                                alert("Error en la llamada AJAX");
                            }

                        });
                    }
                       
                });
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('/tablaUsuario')?>",
                    success: function(data) {
                        //Cargamos finalmente el contenido deseado
                        
                        setTimeout(function () {
                            $('#tablaUsuario').fadeIn(1000).html(data);
                        }, 1500);
                        
                    },
                    error : function(xhr, status) {
                        alert('Disculpe, existió un problema');
                    }
                });
                
        });    
   
</script>


