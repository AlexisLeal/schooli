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



        <h4>Recursos</h4>
        
        <div class="espacioUno"></div>
        
        <a class="btn btn-success btn-sm" href="<?php echo site_url('/Recursos/formrecursos'); ?>" role="button">Registrar un Recurso</a>
        <div class="espacioUno"></div>

        <div class="card">
          <div class="card-body">

            <table class="tabla-registros" width="100%" cellspacing="6" cellpadding="8">
              <thead>
                <tr>
                  <th width="5%">
                    <p class="font-weight-bold text-left">ID</p>
                  </th>
                  <th width="20%">
                    <p class="font-weight-bold text-left">Nombre:</p>
                  </th>
                  <th width="15%">
                    <p class="font-weight-bold text-center">Tipo de recurso:</p>
                  </th>
                  <th width="15%">
                    <p class="font-weight-bold text-center">Categoría.</p>
                  </th>
                  <th width="15%">
                    <p class="font-weight-bold text-center">Editar.</p>
                  </th>
                </tr>
              </thead>
              <?php
              foreach (getRecursos() as $fila) {
              ?>
                <tr>
                  <td class="text-left"><?php echo $fila->id; ?></td>
                  <td class="text-left"><?php echo $fila->nombre; ?></td>
                  <td class="text-left">
                  <?php
                  $recurso = getTipoRecursoEspecifico($fila->tipo_recurso);
                  echo $recurso->nombre;
                  ?>
                  </td>
                  <td class="text-left">
                  <?php
                  if($fila->tipo_recurso==1){
                    $categoriaEvaluacion = getCategoriaRecursoFormulario($fila->id_evaluacion);
                    echo $categoriaEvaluacion->nombreTipo."<br/>";
                    echo $categoriaEvaluacion->nombreCategoria."<br/>";
                  }
                  ?>
                  </td>
                  <td class="text-left"><a href="<?php echo site_url("Recursos/editar/$fila->id"); ?>"><i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i></a></td>
                </tr>
              <?php
              }
              ?>
            </table>
          </div>
        </div>



      </div> <!-- Termina el Div del contenido de enmedio-->




    </div>
  </div>
</div>

test
<table class="table">
  <thead>
    <tr>
    <th>
      <p class="font-weight-bold text-left">ID</p>
    </th>
    <th>
      <p class="font-weight-bold text-left">Nombre:</p>
    </th>
    <th>
      <p class="font-weight-bold text-center">Tipo de recurso:</p>
    </th>
    <th>
      <p class="font-weight-bold text-center">Categoría.</p>
    </th>
    <th>
      <p class="font-weight-bold text-center">Editar.</p>
    </th>
    </tr>
  </thead>
  <tbody>

  </tbody>
test


<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/antes-footer.php'); ?>

<div class="espacioAmplio"></div>

<?php include(APPPATH . '/Views/include/header-js.php'); ?>
<?php include(APPPATH . 'Views/include/footer.php'); ?>

