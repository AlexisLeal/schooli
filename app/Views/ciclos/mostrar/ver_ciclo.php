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

        <h4>Ver un ciclo.</h4>
        <div class="espacioUno"></div>




        <div class="card">
          <div class="card-body">



            <div class="espacioDos"></div>
            <div class="row">
              <div class="col">
                Nombre
                <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" disabled="disabled" value="<?php echo $nombre ?>">
              </div>
              <div class="col">
                Estatus
                <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" disabled="disabled" value="<?php echo $estatus ?>">

              </div>
            </div>

            <div class="espacioUno"></div>


            <div class="row">
              <div class="col">
                Fecha de inicio
                <input type="text" name="fechaInicio" id="fechaInicio" class="form-control form-control-sm" disabled="disabled" value="<?php echo $fechaInicio ?>">

              </div>
              <div class="col">
                Fecha Fin
                <input type="text" name="fechaFIn" id="fechaFIn" class="form-control form-control-sm" disabled="disabled" value="<?php echo $fechaFin ?>">
              </div>
            </div>


            <div class="espacioUno"></div>

            <div class="form-group">
              <label for="lblInstrucciones">Descripción</label>
              <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" rows="3" disabled="disabled"><?php echo $comentarios ?></textarea>
            </div>

            <div class="espacioUno"></div>
            </form>

          </div>
        </div>
      </div>




    </div>
  </div>
</div>


<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/antes-footer.php'); ?>

<div class="espacioAmplio"></div>
<?php include(APPPATH . 'Views/include/footer.php'); ?>
<?php include(APPPATH . 'Views/include/header-js.php'); ?>