<!-- https://uigradients.com/#Lunada -->
<style type="text/css" media="screen">
    #fother{    
		background-color: #020659;
    }
	.blanco{
		color: #ffffff;
	}
</style>
<footer class="footer">
      <div class="footer_top">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 col-lg-4">
                            <div class="footer_widget"><img src="<?php echo base_url('/assets/img/logoBlanco.png')?>" class="img-fluid">
                                <div class="footer_logo">
                                    <a href="#">
                                    </a>
                                </div>
                                <p>
                                        Modelación, planes de gestión y diseño de soluciones definitivas para el control de olores.
                                </p>
                                <div class="socail_links">
                                    <ul>
                                        <li>
                                            <a href="https://www.facebook.com/Odour-Solution-105247457834146/?modal=admin_todo_tour" target="_blank">
                                                <i class="fa fa-facebook-square"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/odoursolution" target="_blank">
                                                <i class="fa fa-twitter-square"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="http://instagram.com/odoursolution/?hl=es-la" target="_blank">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                  <div>.</div>
                                  <div style="color: #C7C7C7">Visite nuestra página web <a href="http://www.os-ingenieria.cl" target="new">&nbsp;<img src="<?php echo base_url('/assets/img/logo_ossmall.png')?>" class="img-fluid"></a></div>
</div>
    
                            </div>
                        </div>
                        <div class="col-xl-2 offset-xl-1 col-md-6 col-lg-3">
                                                       <div class="footer_widget">
                                <h3 class="footer_title">
                                        Productos
                                </h3>
                                <ul>
                                    <li><a href="biofiltros.html" target="_self">Biofiltros</a></li>
                                    <li><a href="biotrickling.html" target="_self">Biotrickling</a></li>
                                    <li><a href="carbonactivado.html" target="_self">Carbón Activado</a></li>
                                    <li><a href="scrubber.html" target="_self">Scrubber</a></li>
                                    <li><a href="servicios.html" target="_self">Servicios</a></li>
                                </ul>
    
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                        Mapa Sitio
                                </h3>
                                <ul>
                                    <li><a href="index.html" target="_self">Inicio</a></li>
                                    <li><a href="empresa.html" target="_self">Empresa</a></li>
                                    <li><a href="productos.html" target="_self">Productos</a></li>
                                    <li><a href="noticias.html" target="_self">Noticias</a></li>
                                    <li><a href="profesionales.html" target="_self">Profesionales</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-3">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                        Contacto
                                </h3>
                                <p>
                                    Santiago, Chile <br>
                                    Oficina 1: Av. Nueva Providencia 1881, oficina 201, Providencia<br>
<br>
Oficina 2: Balmaceda 514, oficina 201, Buin <br>
                                    <br>
Celular +56 9 42944220 <br>
                                    contacto@odoursolution.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
</footer>

	<script type="text/javascript">
		<?php if(session()->has('verModal')):?>
			/*<?php if(session()->get('verModal')== "1" && !session()->get('isLoggedIn')):?>
				$(document).ready(function() {  
				$('#landingMsj').modal('show');
				});
				<?php session()->set('verModal',"0");?>
			<?php endif;?>*/
			<?php if(session()->get('verModal')== "2" && session()->get('isLoggedIn')):?>
				$(document).ready(function() {  
				//$('#mensajeUbicacion').modal('show');
				});
				<?php session()->set('verModal',"0");?>
			<?php endif;?>
		<?php endif;?>



    </script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    

</body>
</html>