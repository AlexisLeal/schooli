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
        <h4>Recursos asignados a esté curso.</h4>
        
        <div class="espacioUno"></div>


        <div class="card">
          <div class="card-body">

          <?php foreach (getRecursosPorCurso($id_curso) as $fila) { ?>
              <div class="niveles" style="width:230px;height:100px;background-image:url('<?php echo base_url($fila->nombre) ?>');float:left;margin-left:10px;margin-right:10px;margin-bottom:10px;padding-top:5px;padding-bottom:5px;padding-left:10px;">
              <?php
              if($fila->tipo_recurso==1){
                ?>
                <a href="<?php echo site_url("/Evaluaciones/panel_evaluaciones/$fila->id_evaluacion"); ?>"><?php echo $fila->nombre;?></a>
                <?php
              }else{
                ?>
              <a href="<?php echo base_url($fila->ruta)?>" target="_blank"> <?php echo $fila->nombre;?></a>
              <?php
              }
              ?>
              </div>
            <?php
            }
            ?>




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