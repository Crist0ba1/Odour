<div class="card-body">
    <div class="table-responsive">
        <table id="tablaUsuarios" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Tipo</th>
                    <th>Imagen</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#tablaUsuarios').dataTable({
            "language": {
               "url": "<?php echo base_url('/assets/datatables/es-ES.json')?>"
            },
            "responsive": true,
            "order":[],
            "serverSide":true,
            "ajax":{
                url:"<?php echo base_url('/Usuario_fetch_all')?>",
                type:"POST",            
            }
        });
    });
</script>