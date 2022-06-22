<div class="card-body">
    <div class="table-responsive">
        <table id="tablaTableros" class="table table-striped table-bordered ">
            <thead>
                <tr>
                    <th>Id</th>
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
            "language": {
               "url": "<?php echo base_url('/assets/datatables/es-ES.json')?>"
            },
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