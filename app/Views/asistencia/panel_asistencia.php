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





    <!--Ejemplo tabla con DataTables-->
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


Mostrar grupos asignados del Teacher.
          <div class="espacioUno"></div>
            <h4>Panel de Notificaciones</h4>
              <div class="card">
                <div class="card-body">

                <a href="<?php echo site_url('/Notificaciones/agregarnotificacion'); ?>">Crear una notificación</a> 
                <hr class="linea"/>
                <table class="tabla-registros" class="display" cellspacing="6" cellpadding="8">
                <thead>
                <tr>
                <th>ID</th><th>Nombre</th><th>Notificación</th><th>Tipo de Usuario</th><th>Estatus</th><th>Fecha inicio</th><th>Fecha Termino</th>
                </tr>
                </thead>
                
                <?php foreach(operacionesGetNotificaciones() as $fila){ ?> 
                  <tr>
                  <td><?php echo $fila->id;?></td>
                  <td><?php echo $fila->nombre;?></td>
                  <td><?php echo $fila->notificacion;?></td>
                  <td><?php echo $fila->usuario;?></td>
                  <td><?php echo $fila->estatus == 1 ? "Activo" : "Inactivo"; ?></td>
                  <td><?php echo $fila->fecha_inicio;?></td>
                  <td><?php echo $fila->fecha_termina;?></td>
                  </tr>
                <?php
                }
                ?>
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
