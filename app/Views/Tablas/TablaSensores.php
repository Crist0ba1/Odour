<div class="card-body">
    <div class="table-responsive">
        <table id="tablaSensores" class="table table-striped table-bordered ">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Descripcion</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                    
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#tablaSensores').dataTable({
            "responsive": true,
            "order":[],
            "serverSide":true,
            "ajax":{
                url:"<?php echo base_url('/sensores_fetch_all')?>",
                type:"POST",            
            }
        });
    });
</script>