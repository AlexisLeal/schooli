<?php include(APPPATH . '/Views/include/header.php'); ?>

<div class="espacioDos"></div>
<header id="barra-superior">

  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <div class="text-center">
          <a href="<?php echo site_url('/Panel/index'); ?>">
            <img class="mb-4" src="<?php echo base_url('img-front/logo-brain.png'); ?>" alt="" width="52" height="52">
          </a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="text-left">
          <form>
            <input type="text" type="search" placeholder="Search" class="form-control buscador">
          </form>
        </div>
      </div>
      <div class="col-md-4 text-right">
        <span class="space"><i class="fa fa-cog fa-2x" aria-hidden="true"></i> </span>
        <span class="space"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i> </span>
        <span class="space"><i class="fa fa-bell-o fa-2x" aria-hidden="true"></i></span>

        <span type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
          <span class="space">
            <i class="fa fa-user fa-2x" aria-hidden="true"></i></span>
        </span>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">Perfil</a>
          <a class="dropdown-item" href="<?php echo site_url('/Home/salir'); ?>">Salir</a>
        </div>
      </div>
    </div>
  </div>
</header>





<!--Ejemplo tabla con DataTables-->
<div class="container">
  <div id="general">
    <div class="row">
      <div class="col-md-3">
        <?php include(APPPATH . '/Views/include/menu-izquierda.php'); ?>
      </div>



      <div class="col-md-9">
        <?php include(APPPATH . '/Views/include/notificacion.php'); ?>


        <?php if ($session->has('Curso')) {; ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Notificaciones del sistema:</strong> <?php echo $session->get('Curso') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php }
        $session->remove('Curso'); ?>




        <h4>editar curso.</h4>
        <div class="espacioUno"></div>




        <div class="card">
          <div class="card-body">

            <form action="<?php echo site_url('Cursos/editar'); ?>" method="post" enctype="multipart/form-data">

              <div class="espacioDos"></div>
              <div class="row">
                <div class="col">
                  Nombre
                  <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" value="<?php echo $nombre ?>">
                </div>
                <div class="col">
                  Estatus
                  <select class="form-control form-control-sm" name="estatus" id="estatus" required="">
                    <option value="">Seleccione una opción</option>
                    <?php if ($estatus == 1) { ?>
                      <option selected="selected" value="1">Activo</option>
                      <option value="0">Inactivo</option>
                    <?php } elseif ($estatus == 0) { ?>
                      <option selected="selected" value="0">Inactivo</option>
                      <option value="1">Activo</option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="espacioUno"></div>


              <div class="row">
                <div class="col">
                  Numero de niveles
                  <select class="form-control form-control-sm" name="numero_niveles" id="numero_niveles" required="">
                    <option value="">Selecciona una opción</option>
                    <?php for ($i = 1; $i <= 14; $i++) { ?>
                      <?php if ($numero_niveles == $i) { ?>
                        <option selected="selected" value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                      <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="col">
                  Total de dias laborales
                  <input type="number" name="dias" id="dias" class="form-control form-control-sm" required="" min=1>
                </div>
                <div class="col">


              <div class="espacioUno"></div>

              <div class="espacioUno"></div>

              <div class="espacioUno"></div>

              <div class="espacioUno"></div>



              <div class="espacioUno"></div>
              <input type="hidden" name="idCr" value="<?php echo $idCr ?>">
              <button type="submit" name="submitCR" class="btn btn-primary btn-sm">Registrar</button>
            </form>

          </div>
        </div>
      </div>




    </div>
  </div>
</div>


<div class="espacioDos"></div>
<div class="espacioDos"></div>
<div class="espacioDos"></div>

<div class="espacioDos"></div>
<div class="espacioDos"></div>
<div class="espacioDos"></div>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <p class="mt-5 mb-3 text-muted text-center"> © <span class="brain-foot">LMS INBI</span> <?php echo date("Y"); ?></p>
    </div>
    <div class="col-md-3">
      <ul class="footer">
        <li><a href="">Aviso de privacidad</a>
        </li>
        <li><a href="">Certificado AMIPCI</a>
        </li>
        <li><a href="">Certificado Pagos en Linea.</a>
        </li>
        <li><a href="">Certificado SSL.</a>
        </li>
      </ul>
    </div>


    <div class="col-md-3">
      <ul class="footer">
        <li><a href="">Company</a>
        </li>
        <li><a href="">About</a>
        </li>
        <li><a href="">Blog</a>
        </li>
        <li><a href="">Careers</a>
        </li>
        <li><a href="">Press</a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="espacioDos"></div>
<div class="espacioDos"></div>
<div class="espacioDos"></div>

<div class="espacioDos"></div>
<div class="espacioDos"></div>
<div class="espacioDos"></div>
<?php include(APPPATH . 'Views/include/footer.php'); ?>
<?php include(APPPATH . 'Views/include/header-js.php'); ?>