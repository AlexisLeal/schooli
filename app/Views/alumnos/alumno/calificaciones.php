<?php include(APPPATH.'/Views/include/header.php');?>

<div class="espacioDos"></div>
<header id="barra-superior">

<div class="container">
  <div class="row">
    <div class="col-md-2">
      <div class="text-center">
        <a href="<?php echo site_url('/Alumno/index'); ?>">
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
            <?php include(APPPATH.'/Views/include/menu-alumno.php');?>
          </div>



          <div class="col-md-9">
          <?php include(APPPATH.'/Views/include/notificacion.php');?>

          <div class="espacioUno"></div>
          <div class="text-right">
            <h4><?php echo $session->get('nombre')." ".$session->get('apellido')." ".$session->get('apellido_materno');?></h4>
          </div>
          <div class="espacioUno"></div>

              <div class="card">
                <div class="card-body">
                <table width="100%">
                  <tr>
                  <td>Asistencia</td><td>Examenes</td><td>Ejercicios</td><td>Calificación</td>
                  </tr>
                <?php

                 $calificacionesPreliminaresEvaluaciones = ObtenerCalificacionesPreviasdeEvaluaciones($_SESSION['id'],$idGrupo,$idCurso,$idNivel,$idCiclo,$ValordeCadaEjercio,$ValordeCadaExamen);
                 $calificacionesPreliminaresAsitencia = ObtenerCalificaionesPreviasAsistencia($_SESSION['id'],$idGrupo,$week_start,$week_end,$valorAsistDiaria);
                 
                 $calificacionPreliminarFinal =  $calificacionesPreliminaresEvaluaciones['calificaionesExamenes'] + $calificacionesPreliminaresEvaluaciones['calificacionesEjercicios'] + $calificacionesPreliminaresAsitencia;
                  
                    
                    
                    ?> 
                    <tr>
                    <td><?php echo $calificacionesPreliminaresAsitencia;?></td>
                    <td><?php echo $calificacionesPreliminaresEvaluaciones['calificaionesExamenes']; ?></td>
                    <td><?php echo $calificacionesPreliminaresEvaluaciones['calificacionesEjercicios']?></td>
                    <td><?php echo $calificacionPreliminarFinal; ?></td>
                    <tr>
                </table>              
                </div>
              </div>
          </div> <!-- Termin contenido div col-md-9-->


        </div>  <!-- Termin contenido row-->
      </div><!-- Termin contenido div id general-->
    </div><!-- Termin contenido div container-->



    <div class="espacioAmplio"></div>

    <?php include(APPPATH . 'Views/include/antes-footer.php'); ?>

<div class="espacioAmplio"></div>

<?php include(APPPATH.'Views/include/footer.php');?>