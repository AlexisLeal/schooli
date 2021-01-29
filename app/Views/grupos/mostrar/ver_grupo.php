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


        <?php
        if ($session->has('pregunta-exito')) {
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
        <h4>Grupos</h4>
        <div class="card">
          <div class="card-body">

            <!--<a href="< ?php echo site_url('/Grupos/agregargrupo'); ?>">Crear un grupo</a> / -->
            
            <div class="espacioUno"></div>
            <div class="espacioUno"></div>
            <table>
            <tr>
              <td><a href="<?php echo site_url('/Grupos/index'); ?>" ><i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i></a></td>
              <td><a href="<?php echo site_url('/Grupos/index'); ?>" >Panel de grupos</a></td>
            </tr>
            </table>  
            <div class="espacioUno"></div>

            <div style="padding-left:30px">
              <div class="card">
                <div class="card-body">
                  <table width="90%">
                    <tr>
                      <td>Nombre: <?php echo $nombre_grupo; ?></td>
                      <td>Código de acceso: <?php echo $codigo_acceso; ?></td>
                    </tr>
                    <tr>
                      <td>Unidad Negocio: <?php echo  $unidad_negocio; ?></td>
                      <td>Plantel: <?php echo $nombre_plantel; ?></td>
                    </tr>
                    <tr>
                      <td>Nivel: <?php echo  $nivel; ?></td>
                    </tr>
                  </table>
                </div>
              </div>

              <br/>


              <div class="card">
                <div class="card-body">
                  <i class="fa fa-cubes" aria-hidden="true"></i> Materiales <br />
                  <table width="90%" cellspacing="8" cellpadding="4">
                    <tr>
                      <td width="40%">
                        <a href="<?php echo site_url("Asignacion/sesiones/$id_grupo/$id_curso/$id_nivel"); ?>"> Ver sesiones </a>
                      </td>
                      <td width="40%">
                        <a href="<?php echo site_url("Asignacion/deletedEvaluacion/$id_grupo"); ?>"> Eliminar Evaluacion </a>
                      </td>
                    </tr>
                  </table>

                </div>
              </div>

              <br/>


              <div class="card">
                <div class="card-body">

                  <i class="fa fa-users" aria-hidden="true"></i> Miembros
                  <table width="90%" cellspacing="8" cellpadding="4">
                    <tr>
                      <td width="40%">
                        <a href="<?php echo site_url("Asignacion/alumnos/$id_grupo/$id_unidad_negocio/$id_plantel"); ?>"> Lista de alumnos y asignacion de alumnos </a>
                      </td>
                      <td width="40%">
                        <a href="<?php echo site_url("Asignacion/deletedAlumno/$id_grupo"); ?>"> Eliminar Alumnos </a>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>

              <br />

              <div class="card">
                <div class="card-body">
                  <i class="fa fa-id-card-o" aria-hidden="true"></i><a href="#"> Kardex </a>
                  <table width="90%" cellspacing="8" cellpadding="4">
                    <tr>
                      <td width="40%">
                        <a href="<?php echo site_url("Asignacion/asignarcalificaciones/$id_grupo/$id_curso/$id_ciclo/$id_nivel"); ?>"> Asistencia y calificaciones </a>
                      </td>
                      <td width="40%">
                        <a href="<?php echo site_url("Calificaciones/CalificacionesAplicadas/$id_grupo/$id_nivel"); ?>"> Calificaciones aplicadas </a>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>

              <br/>


              <div class="card">
                <div class="card-body">
                  <i class="fa fa-university" aria-hidden="true"> </i>Teachers
                  <table width="90%" cellspacing="8" cellpadding="4">
                    <tr>
                      <td width="40%">
                        <a href="<?php echo site_url("Asignacion/teacher/$id_grupo/$id_unidad_negocio/$id_plantel"); ?>">Lista de Teachers y Asignación de Teacher</a>
                      </td>
                      <td width="40%">
                        <a href="<?php echo site_url("Asignacion/deletedTeacher/$id_grupo"); ?>">Eliminar Teacher</a>
                      </td>
                    </tr>
                  </table>

                </div>
              </div>

              <br/>

              <div class="card">
                <div class="card-body">
                  <i class="fa fa-list-ul" aria-hidden="true"></i> <a href="#"> Libreta de calificaciones. </a>
                </div>
              </div>

              <br/>

            </div>
          </div>

          <div style="padding-left:30px">
            <!--
              < ?php foreach(getMateriales($id_grupo) as $fila){?>
                  nombre: < ?php echo $fila->nombre; ?> <br>
              < ?php 
              }
              ?>
              <br>
              < ?php foreach(getMiembros($id_grupo) as $fila){?>
                nombre del alummno < ?php echo $fila->nombre?> <br>
                < ?php }?>
              
                < ?php foreach(getMiembrosDisponibles($id_unidad_negocio,$id_plantel) as $fila){ ?>
                Nombre de alumnos disponibles < ?php echo $fila->nombre ?> <br>
                < ?php } ?>
                <br>

                < ?php foreach(getMiembrosOtrosGrupos($id_grupo,$id_unidad_negocio,$id_plantel) as $fila){ ?>
                Nombre de alumnos de otro grupos < ?php echo $fila->nombre ?> No.Grupo < ?php echo $fila->id_grupo?> <br>
                < ?php } ?>
                ?>
                -->
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