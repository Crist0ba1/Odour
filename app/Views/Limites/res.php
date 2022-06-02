<div class="row justify-content-between">
    <div class="col">
      <a class="navbar-brand" href="<?php echo base_url('/');?>">
        <img src="<?php echo base_url('/assets/img/')?>/logo.png" class="img-fluid">
      </a>
    </div>

    <?php if(session()->get('isLoggedIn') && session()->get('tipo') == 0): ?> 
        <div class="col align-self-end">
          <ul class="navbar-nav d-flex justify-content-between">
            <li>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user-circle"></i> <?= session()->get('nombre') ?>
            </a>
            <div class="dropdown-menu" style="right: 0; left: auto;" aria-labelledby="navbarDropdown">        
              <a id="opacar" class="dropdown-item" href="<?php echo base_url('/logout');?>"><b>Cerrar sesion</b></a>
            </div>
          </li>
          </ul>
        </div>