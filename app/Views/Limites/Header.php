<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">

	<title>Odour</title>

	<meta name="description" content="Odour Solutions">

  <link rel="icon" href="<?php echo base_url('/assets/img/logo.png')?>">

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('/assets/img/favicon.png')?>" >

  <link rel="stylesheet" href="<?php echo base_url('/css/custom.css')?>">  

  <link rel="stylesheet" href="<?php echo base_url('/css/style.css')?>">

  <!-- bootstrap css -->
  <link rel="stylesheet" href="<?php echo base_url('/css/bootstrap.min.css')?>">

  <!-- JS, Popper.js, and jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
  
  <script src="https://kit.fontawesome.com/c818a46c29.js" crossorigin="anonymous"></script>
  
  <!-- DataTables -->

  <link rel="stylesheet" href="<?php echo base_url('/assets/datatables/jquery.dataTables.min.css')?>">


  <script type="text/javascript" charset="utf8" src="<?php echo base_url('/assets/datatables/jquery.dataTables.min.js')?>"></script>

  <!-- <script src="https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"></script> -->
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
  <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script> -->
 

  <!-- Selec -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.15/dist/css/bootstrap-select.min.css">
  
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.15/dist/js/bootstrap-select.min.js"></script>

</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark custom-nav mb-4">
  <a class="navbar-brand ml-5" href="<?php echo base_url('/inicio')?>">
    <img src="<?php echo base_url('/assets/img/logoBlanco.png')?>" class="img-fluid" style="max-width:130px">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>   

<?php if(session()->get('isLoggedIn') && session()->get('tipo') == 0): ?> 
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">

      <li class="nav-item <?php if(isset($menu)){if($menu=="inicio"){echo "active";}} ?> mr-3">
        <a class="nav-link" href="<?php echo base_url('inicio')?>">Inicio<span class="sr-only"></span></a>
      </li>

      <li class="nav-item <?php if(isset($menu)){if($menu=="dashboard"){echo "active";}} ?> mr-3">
        <a class="nav-link" href="<?php echo base_url('dashbord')?>">Gestión<span class="sr-only"></span></a>
      </li>
      <li class="nav-item dropdown mr-5">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user-circle"></i>&nbsp;<?= session()->get('nombre') ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo base_url('/logout');?>">Cerrar sesión</a>
        </div>
      </li>
    </ul>
  </div>

<?php elseif(session()->get('isLoggedIn') && session()->get('tipo') == 1): ?>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">

      <li class="nav-item <?php if(isset($menu)){if($menu=="inicio"){echo "active";}} ?> mr-3">
        <a class="nav-link" href="<?php echo base_url('inicio')?>">Inicio<span class="sr-only"></span></a>
      </li>
      <li class="nav-item dropdown <?php if (isset($imagenEmpresa)){echo "mr-3";} else {echo "mr-5";}?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user-circle"></i>&nbsp;<?= session()->get('nombre') ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo base_url('/logout');?>">Cerrar sesión</a>
        </div>
      </li>
    </ul>
  </div>
  <?php if (isset($imagenEmpresa)){
      // nota arreglar mr-3 a mr-5 de elemento superior si no existe imagen
      // Se inserta imagen
  ?>

    <a class="navbar-brand ml-auto mr-5" href="#">
      <img src="<?php echo base_url('/images/empresa/'.$imagenEmpresa);?>" class="img-fluid" style="max-width:90px">
    </a>

  <?php
    }
  ?>

<?php else:?>  
      <!--  
        <div class="col align-self-end">
          <ul class="navbar-nav d-flex justify-content-between">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('/login');?>"><b>Iniciar sesion</b> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('/registrar'); ?>"><b>Registrarce</b></a>
            </li>
          </ul>
        </div> 
      -->
<?php endif;?> 
  


</nav>

<script>

</script>