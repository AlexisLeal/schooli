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

        <div class="espacioUno"></div>

        <div class="card">
          <div class="card-body">
            <div class="espacioDos"></div>

            <div class="espacioDos"></div>
            <div class="row">
              <div class="col">
                Nombre
                <input type="text" id="nombre" class="form-control form-control-sm" disabled="disabled" value="<?php echo $nombre; ?>">
              </div>
            </div>
            <div class="row">
              <div class="col">
                estatus
                <input type="text" id="nombre" class="form-control form-control-sm" disabled="disabled" value="<?php echo $estatus; ?>">
              </div>

              <div class="espacioUno"></div>

              <div class="row">
                <div class="col">
                  Lunes
                  <input type="text" id="apellido_materno" class="form-control form-control-sm" disabled="disabled" value="<?php echo $lunes; ?>">
                </div>
                <div class="col">
                  Martes
                  <input type="text" id="usuario" class="form-control form-control-sm" disabled="disabled" value="<?php echo $martes; ?>">
                </div>
                <div class="col">
                  Miercoles
                  <input type="text" id="usuario" class="form-control form-control-sm" disabled="disabled" value="<?php echo $miercoles; ?>">
                </div>
                <div class="col">
                  Jueves
                  <input type="text" id="usuario" class="form-control form-control-sm" disabled="disabled" value="<?php echo $jueves; ?>">
                </div>
                <div class="col">
                  Viernes
                  <input type="text" id="usuario" class="form-control form-control-sm" disabled="disabled" value="<?php echo $viernes; ?>">
                </div>
                <div class="col">
                  Sabado
                  <input type="text" id="usuario" class="form-control form-control-sm" disabled="disabled" value="<?php echo $sabado; ?>">
                </div>
                <div class="col">
                  Domingo
                  <input type="text" id="usuario" class="form-control form-control-sm" disabled="disabled" value="<?php echo $domingo; ?>">
                </div>
              </div>

              <div class="espacioUno"></div>


              <div class="espacioUno"></div>

              <div class="espacioUno"></div>



              <div class="espacioDos"></div>
              <hr class="linea" />

              <div class="espacioDos"></div>



              <div class="espacioUno"></div>

              <div class="row">

                <div class="form-group">
                  <label for="lblInstrucciones">Comentarios</label>
                  <textarea class="form-control form-control-sm" id="comentarios" rows="3" disabled="disabled"><?php echo $descripcion; ?></textarea>
                </div>
                <div class="espacioDos"></div>
                <hr class="linea" />



                <div class="espacioUno"></div>

                <div class="espacioUno"></div>



                <div class="espacioUno"></div>




                <div class="espacioUno"></div>
                <input type="button" value="Página anterior" onClick="history.go(-1);">


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