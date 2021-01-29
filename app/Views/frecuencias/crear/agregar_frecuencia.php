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



        <?php if ($session->has('Frecuencia')) {; ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong></strong> <?php echo $session->get('Frecuencia') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php }
        $session->remove('Frecuencia'); ?>





        <h4>Registrar Frecuencia.</h4>

        <div class="espacioUno"></div>

        <div class="card">
          <div class="card-body">

            <form action="<?php echo site_url('Frecuencia/insertarfrecuencia');?>" method="post" enctype="multipart/form-data">

              <div class="espacioDos"></div>
              <div class="row">
                <div class="col">
                  Nombre
                  <input type="text" name="nombre" id="nombre" class="form-control form-control-sm">
                </div>
                <div class="col">
                </div>
              </div>

              <div class="espacioUno"></div>

              <div class="form-group">
                <label for="lblInstrucciones">Descripción</label>
                <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" rows="3" required=""></textarea>
              </div>

              <div class="espacioUno"></div>

              <div class="row">
                <div class="col" style="padding-left:200px;">
                  <table cellpadding="10" cellspacing="10">
                    <tr>
                      <td><input type="checkbox" class="form-check-input form-control-sm" name="lunes" id="lunes" value="1">Lunes</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="form-check-input form-control-sm" name="martes" id="martes" value="1">Martes</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="form-check-input form-control-sm" name="miercoles" id="miercoles" value="1">Miercoles</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="form-check-input form-control-sm" name="jueves" id="jueves" value="1">Jueves</td>
                    </tr>
                  </table>
                </div>
                <div class="col" style="padding-left:10px;">

                  <table cellpadding="10" cellspacing="10">
                    <tr>
                      <td><input type="checkbox" class="form-check-input form-control-sm" name="viernes" id="viernes" value="1">Viernes</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="form-check-input form-control-sm" name="sabado" id="sabado" value="1">Sabado</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="form-check-input form-control-sm" name="domingo" id="domingo" value="1">Domingo</td>
                    </tr>
                  </table>

                </div>
              </div>

              <div class="espacioUno"></div>
              <div class="espacioUno"></div>

              <div class="row">

                <div class="col">
                  Estatus
                  <select class="form-control form-control-sm" name="estatus" id="estatus" required="">
                    <option value="">Seleccione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                </div>
                <div class="col">
                </div>
              </div>





              <div class="espacioUno"></div>
              <button type="reset" class="btn btn-primary btn-sm">Limpiar</button>

              <button type="submit" name="submitFR" class="btn btn-primary btn-sm">Registrar</button>
            </form>

          </div>
        </div>
      </div>




    </div>
  </div>
</div>


<div class="espacioAmplio"></div>

<?php include("include/antes-footer.php");?>

<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/footer.php'); ?>
<?php include(APPPATH . 'Views/include/header-js.php'); ?>