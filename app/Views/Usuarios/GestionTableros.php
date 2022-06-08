<div class="row justify-content-center">
    <div class="col-10 ">
        <div class="card">
            <div class="card-header"> 
                <div class="row">
                    <div class="col-12">
                        <div class="col-6 d-inline-flex">
                            <h3> <i class="fa fa-table" aria-hidden="true"></i> Tableros</h3>                    
                        </div>
                        <div class=" col-3 my-2 d-inline-flex"></div>
                            <button type="button" name="btnAddTableros" id="btnAddTableros" class="btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#addTableros">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="text">Agregar Tableros</span>
                            </button>
                        </div>
                    </div>                    
                </div>
            </div>        
            <span id="mensajeTableros"></span>
            <div class="card-body" id="tablaTablero" >
            </div>
        </div>
    </div>
</div>


<!-- Modal Agregar Tableros -->
<form id="AddTablerosModal" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="addTableros" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ingrese datos del Tableros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre de Tablero:</label>
                    <input type="text" class="form-control" name="nombreTableros" id="nombreTableros" required placeholder="Ejemplo: Nombre del Tableros">
                    <span id="nombre_Tableros_error" class="text-danger">
                </div>   
                <div class="form-group">
                    <select name="region" id="region" data-live-search="true" class="form-control select-lg"  style="width:100% !important;">
						<option value="0">-Region-</option>
						<?php foreach($region as $row):?>
							<option value="<?= $row['id'];?>"><?= $row['region'];?></option>
						<?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="comuna" id="comuna" data-live-search="true" class="form-control select-lg"  style="width:100% !important;">
						<option value="0">-Comuna-</option>
						<?php foreach($comuna as $row):?>
							<option value="<?= $row['id'];?>"><?= $row['comuna'];?></option>
						<?php endforeach;?>
					</select>
                </div>
                <div class="form-group">
                    <label>Ubicación:</label>
                    <input type="text" class="form-control" name="ubicacionTablero" id="ubicacionTablero" required placeholder="Ejemplo: Rio aconcagua #1455">
                    <span id="ubicacion_Tableros_error" class="text-danger">
                </div>
                <div class="form-group">
                    <label>Sector:</label>
                    <input type="text" class="form-control" name="sectorTablero" id="sectorTablero" required placeholder="Ejemplo: Sector 1">
                    <span id="sector_Tableros_error" class="text-danger">
                </div>
                <div class="form-group select">
                    <label>Usuario(s):</label><br>
					<select required name="usuariosSelect" id="usuariosSelect" class="selectpicker" title="usuarios(s)" 
						 multiple data-live-search="true">
						<option disabled >- Usuario(s)-</option>
						<?php foreach($usuarios as $rowC):?>
							<option  value="<?= $rowC['idUsuario'];?>"><?= $rowC['idUsuario'];?>. <?= $rowC['Nombre'];?></option>
						<?php endforeach;?>
						<input type="hidden" class="form-control form-control-user" id="listusuarios" name="listusuarios">
					</select>										
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                <input type="hidden" name ="hiden_idGT" id="hiden_idGT"/>
                <input type="hidden" name ="actionGT" id="actionGT" value="add" />
                <input type="submit" name ="submit" id="submit_buttonGT" class="btn btn-primary" value="Agregar" />
            </div>
            </div>
        </div>
    </div>
</form>

<div id="verSensores" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sensores asignados al tablero</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Mostrar los sensores asociados y quizas permitir la gestion igual???.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    $("#region").change(function() {
       		$("#region option:selected").each(function() {
            	var id = $('#region').val();
            	var select = document.getElementById("comuna"); //Seleccionamos el select

            	while (select.hasChildNodes()) {  // mientras exita un nodo child lo borra
                	select.removeChild(select.firstChild);
            	}

            	var aux = document.createElement("option"); //Creamos la opcion
            	aux.text = "-Seleccionar una comuna-"; //Metemos el texto en la opción
            	aux.value = "0";
            	select.add(aux);

            	//alert(idusuarios);
            	<?php foreach($comuna as $row):?>
	                if(id == <?= $row['region_id'];?>){
                    	var option = document.createElement("option"); //Creamos la opcion
                    	option.text = "<?= $row['comuna'];?>"; //Metemos el texto en la opción
                    	option.value = "<?= $row['id'];?>";
                    	select.add(option); //Metemos la opción en el select
                	}
            	<?php endforeach;?>
        	});
    });    
</script>
<script type="text/javascript">          
           $(document).ready(function() {   
               
                $(document).on('click', '.verTableros',function(){
                    $('#verSensores').modal("show");  
                });
                //Añadimos la imagen de carga en el contenedor
                $('#tablaTablero').html('<div class="d-flex justify-content-center"><img src="https://c.tenor.com/28DFFVtvNqYAAAAC/loading.gif" width="125" /><br/>Cargado tablas...</div>');
                
                $('#btnAddTableros').click(function(){
                    $('#AddTablerosModal')[0].reset();
                    $('#nombre_Tableros_error').text('');
                    $('#ubicacion_Tableros_error').text('');
                    $('#sector_Tableros_error').text('');
                    $('#actionGT').val('add');
                    $('#addTableros').modal("show");
                    
                });
                
                $('#AddTablerosModal').on('submit',function(event){
                    event.preventDefault();
                    $.ajax ({
                        type: "POST",
                        url: "<?php echo base_url('/addTableros')?>",
                        data: $(this).serialize(),
                        dataType: "JSON",
                        beforSend: function(){
                            $('#submit_buttonGT').val('Espere...');
                            $('#submit_buttonGT').attr('disabled','disabled');
                        },
                        success: function(data){
                            $('#submit_buttonGT').val('Agregar');
                            $('#submit_buttonGT').attr('disabled',false);
                            if(data.error == "yes"){
                                $('#nombre_Tableros_error').text(data.nombre_Tableros_error);
                                $('#ubicacion_Tableros_error').text(data.ubicacion_Tableros_error);
                                $('#tipo_Tableros_error').text(data.tipo_Tableros_error);
                                $('#sector_Tableros_error').text(data.sector_Tableros_error);
                            }
                            if(data.success=="yes"){
                                $('#addTableros').modal("hide");
                                $('#mensajeTableros').html(data.message);
                                $('#tablaTableros').DataTable().ajax.reload();

                                setTimeout(() => {
                                    $('#mensajeTableros').html('');
                                }, 5000);
                            }else{
                                alert('Error');
                            }
                        }

                    })
                });

                $(document).on('click', '.editTablero',function(){
                    var id = $(this).data('id');
                    $.ajax({
                        url:"<?php echo base_url('/editTablero')?>",
                        type: "POST",                        
                        data:{id:id},
                        dataType:'Json',
                        success:function(data){
                            //alert(JSON.stringify(data));
                            $('#nombreTableros').val(data.nombreTablero);                            
                            $('#region').val(data.regionRef).change();
                            $('#comuna').val(data.comunaRef).change();
                            $('#ubicacionTablero').val(data.ubicacion);
                            $('#sectorTablero').val(data.sector);
                            //$('#imagen').val(data.imagen);
                            $('#hiden_idGT').val(id);
                            $('#nombre_Tableros_error').text('');
                            $('#ubicacion_Tableros_error').text('');
                            $('#tipo_Tableros_error').text('');
                            $('#imagen_Tableros_error').text('');
                            $('#actionGT').val('edit');
                            $('#submit_buttonGT').attr('Value','Editar')

                            $.ajax({
                                type: "GET",
                                url: "<?php echo base_url('/usuariosTableros')?>/"+id,
                                success: function(data) {
                                    var usuarios = new Array();
                                    JSON.parse(data).forEach(element => {
                                        usuarios.push(element['refUsuario']);
                                    });
                                    $('select[name=usuariosSelect]').val(usuarios);
                                    $('.selectpicker').selectpicker('refresh');
                                },
                                error : function(xhr, status) {
                                    alert('Existió un problema, buscando los usuarios de este tablero');
                                }
                            });
                            $('#addTableros').modal("show");                            
                        },
                        error:function(){
                            alert("Error en la llamada AJAX");
                        }

                    });
                });

                $(document).on('click', '.deleteTablero',function(){
                    var id = $(this).data('id');
                    if(confirm("Esta seguro que desea eliminar el Tableros id: "+id)){
                        $.ajax({
                            url:"<?php echo base_url('/deleteTablero')?>",
                            type: "POST",                        
                            data:{id:id},
                            success:function(data){
                                $('#mensajeTableros').html(data);
                                $('#tablaTableros').DataTable().ajax.reload();
                                setTimeout(() => {
                                    $('#mensajeTableros').html('');
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
                    url: "<?php echo base_url('/tablaTableros')?>",
                    success: function(data) {
                        //Cargamos finalmente el contenido deseado
                        
                        setTimeout(function () {
                            $('#tablaTablero').fadeIn(1000).html(data);
                        }, 1500);
                        
                    },
                    error : function(xhr, status) {
                        alert('Disculpe, existió un problema');
                    }
                });

                $('#usuariosSelect').on('change', function(){
                    var selected = $(this).find("option:selected");
                    var arrSelected = [];
                    var  cat = "";
                    selected.each(function(){
                        arrSelected.push($(this).val());
                        cat+= $(this).val() +" ";
                    });
                    $('#listusuarios').val(cat);
                });

        });    
   
</script>


