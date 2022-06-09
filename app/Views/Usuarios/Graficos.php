<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('visualization', "1", {
        packages: ['corechart']
    });
</script>

<section class="mb-4">

    <div class="container-fluid" id="div_tableros">

    <?php 
    if(sizeof($tableros) > 0){
    ?>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <label for="exampleFormControlSelect1">Tablero: </label>
                </div>
                <div class="col-md-8">
                    <select class="form-control" id="tableroSelect">
                        <?php foreach($tableros as $dato){?>
                            <option value='<?php echo $dato['idTablero'] ?>'><?php echo $dato['sector'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="sensores">
            <div class="row mr-2 ml-2">
                <?php 
                if(sizeof($sensores) > 0){
                    
                    foreach($sensores as $sensor){
                    
                ?>
                        <div class="col-sm-12 col-md-6 p-4">
                            <div class="row custom-cart p-3">
                                <div class="col-12 text-center">
                                    <br>
                                    <h4>Sensor de <?php echo $sensor['nombre'] ?></h4>
                                    <a id="resetBtn" onclick="" class="btn btn-primary">Reiniciar</a>
                                    <a id="resetBtn" onclick="" class="btn btn-primary">Pausar</a>
                                    <a id="resetBtn" onclick="" class="btn btn-primary">Descargar CSV</a>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="col">
                                    <div id="GoogleLineChart-<?php echo $sensor['idSensor'] ?>" style="height: 400px; width: 100%" class="sensor_id" value="<?php echo $sensor['idSensor'] ?>"></div>

                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <br>
                                    <div class="col-12">
                                        <h4>Información estadística</h4>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-5 col-sm-5">
                                            <button type="button" class="btn btn-primary btn-block">
                                                N° de mediciones hechas <span id="numDatos" class="badge badge-light"></span>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-block">
                                                Promedio <span id="promedio" class="badge badge-light"></span>
                                            </button>
                                        </div>
                                        <div class="col-5 col-sm-5">
                                            <button type="button" class="btn btn-danger btn-block">
                                                Medición máxima <span id="medidaMaxima" class="badge badge-light"></span>
                                            </button>
                                            <button type="button" class="btn btn-info btn-block">
                                                Medición mínima <span id="medidaMinima" class="badge badge-light"></span>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                
                    <?php 
                            // Fin ciclo for
                            }
                    ?>

            </div>
    
                <?php
                    // Caso: Si no existe ningún sensor asociado al tablero
                    } else {  
                ?>

                    <div class="container mt-4">
                        <div class="row justify-content-md-center">
                            <div class="col-md-7">
                                <div class="alert alert-danger" role="alert">
                                    Estimado usuario, el <i>Tablero</i> seleccionado no cuenta con ningún <i>Sensor</i> asociado.
                                </div>
                            </div>
                        </div>
                    </div>
            
                <?php 
                    }
                ?>

            
        </div>

    <?php } else {?>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-7">
                    <div class="alert alert-danger" role="alert">
                        Estimado usuario, usted no cuenta con ningún Tablero asociado, comuníquese con su <i>Administrador de Sistema</i> para resolver este problema.
                    </div>
                </div>
            </div>
        </div>
    <?php }?>

    </div>

</section>

<script language="JavaScript">
    $(document).ready(function() {

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawLineChart);

        function drawLineChart() {

            const graficos = document.querySelectorAll(
                '.sensor_id'
            );

            $.ajax({
                url: "<?php echo base_url('/initChart'); ?>",
                dataType: "json",
                method: "GET",
                success: function(data) {
                    const valores = [
                        ['fecha', 'valor'],
                    ];
                    for (x of data) {
                        let date = new Date(x.fecha);
                        let result = parseFloat(x.valor);
                        const aux = [date, result];
                        valores.push(aux);
                    }
                    var data = google.visualization.arrayToDataTable(valores);
                    var options = {
                        title: 'Gráfico de linea de los ultimos 10 datos ingresados',
                        subtitle: 'Los datos son ingresados cada 5 segundos',
                        curveType: 'function',
                        legend: {
                            position: 'bottom'
                        },
                        series: {
                            0: { color: '#00FF00' },
                        },
                        // Colors only the chart area, with opacity
                        chartArea: {
                            backgroundColor: {
                            fill: '#1F1F1F',
                            fillOpacity: 1
                            },
                        },
                    }

                    graficos.forEach(grafico => {
                        console.log(grafico.getAttribute('value'));
                        var chart = new google.visualization.LineChart(document.getElementById('GoogleLineChart-'+grafico.getAttribute('value')));
                        chart.draw(data, options);
                    });
                }
            });
            $.ajax({
                url: "<?php echo base_url('/inputs'); ?>",
                dataType: "json",
                method: "GET",
                success: function(data) {
                    $("#numDatos").text(data.numDatos);
                    $("#promedio").text(data.promedio);
                    $("#medidaMaxima").text(data.medidaMaxima);
                    $("#medidaMinima").text(data.medidaMinima);

                }
            });
        }

        $('#tableroSelect').on('change', function() {
        // alert( this.value );
            $.post(
                    "<?php echo base_url('/Tablero/Ver'); ?>",
                    {tablero: this.value},
                    function(data) {
                        // console.log(data)
                        drawLineChart();
                        $('#sensores').html(data);
                    }
            );
        });
        
        setInterval(drawLineChart, 10000);
    });

    function resetFunction() {
        $.ajax({
            url: "<?php echo base_url('/reset'); ?>",
            dataType: "json",
            method: "GET",
            success: function(data) {
                $("#numDatos").text(data.numDatos);
                $("#promedio").text(data.promedio);
                $("#medidaMaxima").text(data.medidaMaxima);
                $("#medidaMinima").text(data.medidaMinima);
            }
        });
    }

   

</script>