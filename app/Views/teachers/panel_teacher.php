<?php include(APPPATH.'/Views/include/header.php');?>
<div class="espacioDos"></div>
<header id="barra-superior">
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <div class="text-center">
          <a href="<?php echo site_url('/Panel/index'); ?>">
            <img class="mb-4" src="<?php echo base_url('img-front/logo-brain.png');?>" alt="" width="52" height="52">
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
        <span class="space"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>  </span>
        <span class="space"><i class="fa fa-bell-o fa-2x" aria-hidden="true"></i></span>
        <span type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
        <span class="space">
          <i class="fa fa-user fa-2x" aria-hidden="true"></i></span>
        </span>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">Perfil</a>
          <a class="dropdown-item" href="<?php echo site_url('/Home/salir');?>">Salir</a>
        </div>
      </div>
    </div>
  </div>
</header>



<div class="container">
  <div id="general">
    <div class="row">
      <div class="col-md-3">
        <?php include(APPPATH.'/Views/include/menu-izquierda.php');?>
      </div>
 
      <div class="col-md-9">
        <?php include(APPPATH.'/Views/include/notificacion.php');?>
        <?php
          if($session->has('pregunta-exito')){ 
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php
              echo $session->get('pregunta-exito');
            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <?php
          $session->remove('pregunta-exito'); 
          }
        ?>

      <div class="espacioUno"></div>
        <h4>Panel de Teachers</h4>
        <a class="btn btn-success btn-sm" href="<?php echo site_url('/Teachers/agregarteacher'); ?>" role="button">Registrar un Teacher</a>
        
        <div class="espacioUno"></div>
        <div class="espacioUno"></div>
        <table>
        <tr>
          <td><a href="<?php echo site_url('/Panel/index'); ?>" ><i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i></a></td>
          <td><a href="<?php echo site_url('/Panel/index'); ?>" >  Ir al Panel</a></td>
        </tr>
        </table>  
        <div class="espacioUno"></div>

        
        <div class="card">
          <div class="card-body">
            <table class="tabla-registros" class="display" cellspacing="6" cellpadding="8">
              <thead>
                <tr>
                  <th class="text-left">ID</th>
                  <th class="text-left">Nombre</th>
                  <th class="text-left">Unidad de negocio</th>
                  <th class="text-left">Plantel</th>
                  <th class="text-left">Ver</th>
                  <th class="text-left">Editar</th>
                </tr>
              </thead>
              <?php foreach(getAllMaestros() as $fila){?>
              <tr>
                <td><?php echo $fila->id;?></td>
                <td><?php echo "$fila->nombre".' '.$fila->apellido_paterno.' '.$fila->apellido_materno;?></td>
                <td><?php echo getUnidadNegocioEspecifico($fila->idUnidadNegocio);?></td>
                <td><?php echo getPlanteEspecifico($fila->idPlantel);?></td>
                <td class="text-center">
                  <a href="<?php echo site_url("Teachers/verTeachers/$fila->id") ?>">
                  <i class="fa fa-file-text-o fa-1x" aria-hidden="true"></i>
                </td>
                <td class="text-center">
                <a href="<?php echo site_url("Teachers/editarTeachers/$fila->id") ?>">
                <i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i>
                </a>
                </td>

              </tr>

              <?php }?>
            </table>
          </div>
        </div>
      </div>
    </div>  
  </div>
</div>

<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/antes-footer.php'); ?>
      
<div class="espacioAmplio"></div>

<?php include(APPPATH.'Views/include/footer.php');?>