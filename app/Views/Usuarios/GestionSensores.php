<div class="row justify-content-center">
    <div class="col-10 ">
        <div class="card">
            <div class="card-header"> 
                <div class="row">
                    <div class="col-12">
                        <div class="col-6 d-inline-flex">
                            <h3> <i class="fa fa-dot-circle-o" aria-hidden="true"></i> Sensores</h3>                    
                        </div>
                        <div class=" col-3 my-2 d-inline-flex"></div>
                            <button type="button" name="btnAddSensores" id="btnAddSensores" class="btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#addSensores">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="text">Agregar sensores</span>
                            </button>
                        </div>
                    </div>                    
                </div>
            </div>        
            <span id="mensajeSensores"></span>
            <div class="card-body" id="tablaS" >
            </div>
        </div>
    </div>
</div>


<!-- Modal Agregar Tableros -->
<form id="AddSensoresModal" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="addSensores" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ingrese datos del sensor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre de Sensor:</label>
                    <input type="text" class="form-control" name="nombreSensor" id="nombreSensor" required placeholder="Ejemplo: Sensor de temperatura, Dht11">
                    <span id="nombre_sensor_error" class="text-danger">
                </div>   
                <div class="form-group">
                    <label>Descripcion del eje vs tiempo:</label>
                    <input type="text" class="form-control" name="tipoSensor" id="tipoSensor" required placeholder="Ejemplo: Temp grados C°">
                    <span id="tipo_sensor_error" class="text-danger">
                </div>
                <div class="form-group select">
                    <label>Tablero(s):</label><br>
					<select required name="tablerosSelect" id="tablerosSelect" class="selectpicker" title="tablero(s)" 
						 multiple data-live-search="true">
						<option disabled >- Tablero(s)-</option>
						<?php foreach($tableros as $rowC):?>
							<option  value="<?= $rowC['idTablero'];?>"><?= $rowC['idTablero'];?>. <?= $rowC['nombreTablero'];?></option>
						<?php endforeach;?>
						<input type="hidden" class="form-control form-control-user" id="listTablero" name="listTablero">
					</select>										
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                <input type="hidden" name ="hiden_idS" id="hiden_idS"/>
                <input type="hidden" name ="actionS" id="actionS" value="add" />
                <input type="submit" name ="submit" id="submit_buttonS" class="btn btn-primary" value="Agregar" />
            </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">          
           $(document).ready(function() {    
                //Añadimos la imagen de carga en el contenedor
                $('#tablaS').html('<div class="d-flex justify-content-center"><img src="https://c.tenor.com/28DFFVtvNqYAAAAC/loading.gif" width="125" /><br/>Cargado tablas...</div>');
                
                $('#btnAddSensores').click(function(){
                    $('#AddSensoresModal')[0].reset();
                    $('#nombre_sensor_error').text('');
                    $('#tipo_sensor_error').text('');
                    $('#actionS').val('add');
                    $('#submit_buttonS').val('Agregar');
                    $('#addSensores').modal("show");
                });
                
                $('#AddSensoresModal').on('submit',function(event){
                    console.log($(this).serialize())
                    event.preventDefault();
                    $.ajax ({
                        type: "POST",
                        url: "<?php echo base_url('/addSensor')?>",
                        data: $(this).serialize(),
                        dataType: "JSON",
                        beforSend: function(){
                            $('#submit_buttonS').val('Espere...');
                            $('#submit_buttonS').attr('disabled','disabled');
                        },
                        success: function(data){
                            $('#submit_buttonS').val('Agregar');
                            $('#submit_buttonS').attr('disabled',false);
                            if(data.error == "yes"){
                                $('#nombre_sensor_error').text(data.nombre_sensor_error);
                                $('#tipo_sensor_error').text(data.tipo_sensor_error);
                            }
                            if(data.success=="yes"){
                                $('#addSensores').modal("hide");
                                $('#mensajeSensores').html(data.message);
                                $('#tablaSensores').DataTable().ajax.reload();

                                setTimeout(() => {
                                    $('#mensajeSensores').html('');
                                }, 5000);
                            }else{
                                alert('Error');
                            }
                        }

                    })
                });

                $(document).on('click', '.editSensor',function(){
                    var id = $(this).data('id');
                    $.ajax({
                        url:"<?php echo base_url('/editSensor')?>",
                        type: "POST",                        
                        data:{id:id},
                        dataType:'Json',
                        success:function(data){
                            //alert(JSON.stringify(data));
                            $('#nombreSensor').val(data.nombre);                            
                            $('#tipoSensor').val(data.tipo);
                            $('#hiden_idS').val(id);
                            $('#nombre_sensor_error').text('');
                            $('#tipo_sensor_error').text('');
                            $('#actionS').val('edit');
                            $('#submit_buttonS').val('Editar')

                            $.ajax({
                                type: "GET",
                                url: "<?php echo base_url('/tablerosSensores')?>/"+id,
                                success: function(data) {
                                    var usuarios = new Array();
                                    JSON.parse(data).forEach(element => {
                                        usuarios.push(element['refTablero']);
                                    });
                                    $('select[name=tablerosSelect]').val(usuarios);
                                    $('.selectpicker').selectpicker('refresh');
                                },
                                error : function(xhr, status) {
                                    alert('Existió un problema, buscando los usuarios de este tablero');
                                }
                            });

                            $('#addSensores').modal("show");                            
                        },
                        error:function(){
                            alert("Error en la llamada AJAX");
                        }

                    });
                });

                $(document).on('click', '.deleteSensor',function(){
                    var id = $(this).data('id');
                    if(confirm("Esta seguro que desea eliminar el Tableros id: "+id)){
                        $.ajax({
                            url:"<?php echo base_url('/deleteSensor')?>",
                            type: "POST",                        
                            data:{id:id},
                            success:function(data){
                                $('#mensajeSensores').html(data);
                                $('#tablaSensores').DataTable().ajax.reload();
                                setTimeout(() => {
                                    $('#mensajeSensores').html('');
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
                    url: "<?php echo base_url('/tablaSensores')?>",
                    success: function(data) {
                        //Cargamos finalmente el contenido deseado
                        
                        setTimeout(function () {
                            $('#tablaS').fadeIn(1000).html(data);
                        }, 1500);
                        
                    },
                    error : function(xhr, status) {
                        alert('Disculpe, existió un problema');
                    }
                });

                $('#tablerosSelect').on('change', function(){
                    var selected = $(this).find("option:selected");
                    var arrSelected = [];
                    var  cat = "";
                    selected.each(function(){
                        arrSelected.push($(this).val());
                        cat+= $(this).val() +" ";
                    });
                    $('#listTablero').val(cat);
                });
                
        });    
   
</script>
