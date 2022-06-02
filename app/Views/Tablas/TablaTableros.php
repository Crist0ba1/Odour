<div class="card-body">
    <div class="table-responsive">
        <table id="tablaTableros" class="table table-striped table-bordered ">
            <thead>
                <tr>
                    <th>idTablero</th>
                    <th>Nombre</th>
                    <th>Sector</th>
                    <th>Acciones</th>
                    
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#tablaTableros').dataTable({
            "responsive": true,
            "order":[],
            "serverSide":true,
            "ajax":{
                url:"<?php echo base_url('/tableros_fetch_all')?>",
                type:"POST",            
            }
        });
    });
</script>