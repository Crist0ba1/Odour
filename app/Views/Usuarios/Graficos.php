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
                                    <a id="resetBtn" onclick="descargarCsv(this)" class="btn btn-primary" value="<?php echo $sensor['idSensor'] ?>" name="<?php echo $sensor['nombre'] ?>">Descargar CSV</a>
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
                                                N° de mediciones hechas: <span id="numDatos-<?php echo $sensor['idSensor'] ?>" class="badge badge-light"></span>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-block">
                                                Promedio: <span id="promedio-<?php echo $sensor['idSensor'] ?>" class="badge badge-light"></span>
                                            </button>
                                        </div>
                                        <div class="col-5 col-sm-5">
                                            <button type="button" class="btn btn-danger btn-block">
                                                Medición máxima: <span id="medidaMaxima-<?php echo $sensor['idSensor'] ?>" class="badge badge-light"></span>
                                            </button>
                                            <button type="button" class="btn btn-info btn-block">
                                                Medición mínima: <span id="medidaMinima-<?php echo $sensor['idSensor'] ?>" class="badge badge-light"></span>
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

        let actualResponse = null;

        google.charts.load('current', {
            'packages': ['corechart']
        });
        
        google.charts.setOnLoadCallback(drawLineChart);

        function drawLineChart() {

            const graficos = document.querySelectorAll(
                '.sensor_id'
            );

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('/getDataSensores'); ?>",
                data: {tablero: $( "#tableroSelect" ).val()},
                success: function(response) {

                    actualResponse = response;

                    graficos.forEach(grafico => {

                        // Declaracion de variables estadisticas
                        let max = null;
                        let min = null;
                        let nroMediciones = 0;
                        let promedio = 0;                    

                        const valores = [
                            ['fecha', 'mediciones'],
                        ];

                        if (typeof response[grafico.getAttribute('value').toString()] !== 'undefined') {
                            response[grafico.getAttribute('value').toString()].forEach(input => {

                                let date = new Date(input['fecha']);
                                let result = parseFloat(input['valor']);
                                const aux = [date, result];
                                valores.push(aux);

                                if (max == null){
                                    max = result;
                                } else {
                                    if (max < result){
                                        max = result;
                                    }
                                }

                                if (min == null){
                                    min = result;
                                } else {
                                    if (min > result){
                                        min = result;
                                    }
                                }

                                nroMediciones++;

                                promedio = promedio + result;

                            });

                            promedio = promedio/nroMediciones;

                            $("#numDatos-"+grafico.getAttribute('value').toString()).text(nroMediciones);
                            $("#promedio-"+grafico.getAttribute('value').toString()).text(promedio.toFixed(2));
                            $("#medidaMaxima-"+grafico.getAttribute('value').toString()).text(max);
                            $("#medidaMinima-"+grafico.getAttribute('value').toString()).text(min);

                            // console.log('Max: '+max);
                        } else {
                            valores.push(['',0]);
                        }

                        var data = google.visualization.arrayToDataTable(valores);
                        var options = {
                            title: 'Gráfico de linea de todos últimos datos ingresados',
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
                            hAxis: {
                                title: 'Tiempo',
                            },
                            vAxis: {
                                title: 'Valor',
                            },
                        }

                        var chart = new google.visualization.LineChart(document.getElementById('GoogleLineChart-'+grafico.getAttribute('value')));
                        chart.draw(data, options);
                    });
                },
                dataType: "json",
            });
        }

        setInterval(drawLineChart, 10000);

        $('#tableroSelect').on('change', function() {
            $.post(
                    "<?php echo base_url('/Tablero/Ver'); ?>",
                    {tablero: this.value},
                    function(data) {
                        $('#sensores').html(data);
                        drawLineChart();
                    }
            );
        });

        window.descargarCsv = (e) => {

            let csvContent = "data:text/csv;charset=utf-8,";
            const valores = [
                ['fecha', 'mediciones'],
            ];

            if (typeof actualResponse[e.getAttribute('value').toString()] !== 'undefined') {
                actualResponse[e.getAttribute('value').toString()].forEach(input => {

                    let date = new Date(input['fecha']);
                    let result = parseFloat(input['valor']);
                    const aux = [date, result];
                    valores.push(aux);

                });

            } else {

            }

            valores.forEach(function(rowArray) {
                let row = rowArray.join(",");
                csvContent += row + "\r\n";
            });

            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "sensor"+e.getAttribute('name').toString().replaceAll(/\s+/g, "")+"_sector"+$('#tableroSelect').find(":selected").text()+"_"+new Date().toLocaleDateString().replaceAll("/", "-")+"_"+new Date().toLocaleTimeString().replaceAll(":", "-")+".csv");
            document.body.appendChild(link); // Required for FF

            link.click();
        }       
        
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