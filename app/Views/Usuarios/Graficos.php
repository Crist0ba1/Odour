<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    /* google.charts.load('visualization', "1", {
        packages: ['corechart']
    });*/
</script>

<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <label for="exampleFormControlSelect1">Tablero: </label>
            </div>
            <div class="col-md-8">
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>Tablero 1</option>
                    <option>Tablero 2</option>
                    <option>Tablero 3</option>
                </select>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 p-4">
                <div class="row custom-cart p-3">
                    <div class="col-12 text-center">
                        <br>
                        <h4>Datos en tiempo real</h4>
                        <a id="resetBtn" onclick="resetFunction()" class="btn btn-primary">Empezar de nuevo</a>
                    </div>
                    <div class="col-12">
                        <div class="col">
                            <div id="GoogleLineChart" style="height: 400px; width: 100%"></div>

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

            <div class="col-sm-6 p-4">
                <div class="row custom-cart p-3">
                    <div class="col-12 text-center">
                        <br>
                        <h4>Datos en tiempo real</h4>
                        <a id="resetBtn" onclick="resetFunction()" class="btn btn-primary">Empezar de nuevo</a>
                    </div>
                    <div class="col-12">
                        <div class="col">
                            <div id="GoogleLineChart" style="height: 400px; width: 100%"></div>

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

            <div class="col-sm-6 p-4">
                <div class="row custom-cart p-3">
                    <div class="col-12 text-center">
                        <br>
                        <h4>Datos en tiempo real</h4>
                        <a id="resetBtn" onclick="resetFunction()" class="btn btn-primary">Empezar de nuevo</a>
                    </div>
                    <div class="col-12">
                        <div class="col">
                            <div id="GoogleLineChart" style="height: 400px; width: 100%"></div>

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
                                    Midición máxima <span id="medidaMaxima" class="badge badge-light"></span>
                                </button>
                                <button type="button" class="btn btn-info btn-block">
                                    Medición mínima <span id="medidaMinima" class="badge badge-light"></span>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 p-4">
                <div class="row  custom-cart p-3">
                    <div class="col-12 text-center">
                        <br>
                        <h4>Datos en tiempo real</h4>
                        <a id="resetBtn" onclick="resetFunction()" class="btn btn-primary">Empezar de nuevo</a>
                    </div>
                    <div class="col-12">
                        <div class="col">
                            <div id="GoogleLineChart" style="height: 400px; width: 100%"></div>

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
                                    Midición máxima <span id="medidaMaxima" class="badge badge-light"></span>
                                </button>
                                <button type="button" class="btn btn-info btn-block">
                                    Medición mínima <span id="medidaMinima" class="badge badge-light"></span>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script language="JavaScript">
    $(document).ready(function() {
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawLineChart);


        // Line Chart
        /*
		function drawLineChart() {
			var data = google.visualization.arrayToDataTable([
				['Fecha', 'Valor'],
					<?php
                    if (isset($products)) {
                        foreach ($products as $row) {
                            echo "['" . $row['fecha'] . "'," . $row['valor'] . "],";
                        }
                    }
                    ?>
			]);
			var options = {
				title: 'Grafico delinea',
				curveType: 'function',
				legend: {
					position: 'top'
				}
			};
			var chart = new google.visualization.LineChart(document.getElementById('GoogleLineChart'));
			chart.draw(data, options);
		}*/
        function drawLineChart() {
            $.ajax({
                url: "<?php echo base_url('/initChart'); ?>",
                dataType: "json",
                method: "GET",
                success: function(data) {
                    const valores = [
                        ['fecha', 'valor']
                    ];
                    for (x of data) {
                        let date = new Date(x.fecha);
                        let result = parseFloat(x.valor);
                        //alert(date);
                        const aux = [date, result];
                        valores.push(aux);
                    }
                    //alert(valores);
                    var data = google.visualization.arrayToDataTable(valores);
                    var options = {
                        title: 'Ultimos 10 datos ingresados',                                   
                        //width: 900, Hay que meterce con el tamaño para que el grafico se vea mas grande
                        //height: 500,
                        curveType: 'function',
                        legend: {
                            position: 'bottom'
                        },
                        series: {
                            // Gives each series an axis name that matches the Y-axis below.
                            0: {targetAxisIndex: 0},
                            },
                        vAxes: {
                            // Adds titles to each axis.
                            0: {title: 'Grados celcius'},
                        },
                    }
                    //var chart = new google.visualization.LineChart(document.getElementById('GoogleLineChart'));
                    var chart = new google.visualization.LineChart(document.getElementById('GoogleLineChart'));
                    chart.draw(data, options);
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
        setInterval(drawLineChart, 50);
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