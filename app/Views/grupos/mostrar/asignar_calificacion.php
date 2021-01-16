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
        <h4>Asignar calificaciones de los alumnos de esté grupo.</h4>
        <div class="card">
          <div class="card-body">

            <div style="padding-left:30px">
            <br/>
            <form action="<?php echo site_url('Calificaciones/ObtenerCalificacionesparaKardex');?>" method="post">

                <?php
               
               /*
                $curso_especifico   = getCursoEspecifico($id_curso);
                $id_frecuencia      = $curso_especifico->id_frecuencia;
                $infoFrecuencia     = getFrencueciaEspecifica($id_frecuencia);
                
                $valoresPonderacion = CatalagoObtenerPonderaciondeCurso($id_curso);
                $info_ciclo         = getCicloEspecifico($id_ciclo);
                $fechaInicio        = $info_ciclo->fecha_inicio;
                $fechaFin           = $info_ciclo->fecha_fin;

                $week_start         = strtotime(date($fechaInicio));
                $week_end           = strtotime(date($fechaFin));
                $ValordeCadaEjercio = $valoresPonderacion->valor_ejercicios/$valoresPonderacion->num_ejercicios;
                $ValordeCadaExamen = $valoresPonderacion->valor_examenes/$valoresPonderacion->num_examenes;
                $valorAsistDiaria  = $valoresPonderacion->valor_asistencia/$valoresPonderacion->total_dias_laborales;
                */

              /*  
                if(!empty($info_ciclo->fecha_inicio_excluir)){
                  $info_ciclo->fecha_inicio_excluir;
                  $info_ciclo->fecha_fin_excluir;
                }*/
                ?>
              <div class="card">
                <div class="card-body">
                <table width="100%">
                  <tr>
                  <td>Nombre estudiante</td><td>Asistencia</td><td>Examenes</td><td>Ejercicios</td><td>Calificación</td>
                  </tr>
                <?php
                foreach(getMiembros($id_grupo) as $fila){

                 $calificacionesPreliminaresEvaluaciones = ObtenerCalificacionesPreviasdeEvaluaciones($fila->id,$id_grupo,$id_curso,$id_nivel,$id_ciclo,$ValordeCadaEjercio,$ValordeCadaExamen);
                 $calificacionesPreliminaresAsitencia = ObtenerCalificaionesPreviasAsistencia($fila->id,$id_grupo,$week_start,$week_end,$valorAsistDiaria);
                 
                 $calificacionPreliminarFinal =  $calificacionesPreliminaresEvaluaciones['calificaionesExamenes'] + $calificacionesPreliminaresEvaluaciones['calificacionesEjercicios'] + $calificacionesPreliminaresAsitencia;
                  
                    
                    
                    ?>
                    <tr>
                    <td><?php echo $fila->nombre." ".$fila->apellido_paterno." ".$fila->apellido_materno;?></td>
                    <td><?php echo $calificacionesPreliminaresAsitencia;?></td>
                    <td><?php echo $calificacionesPreliminaresEvaluaciones['calificaionesExamenes']; ?></td>
                    <td><?php echo $calificacionesPreliminaresEvaluaciones['calificacionesEjercicios']?></td>
                    <td><?php echo $calificacionPreliminarFinal; ?></td>
                    <tr>
                    <?php
                }
                ?>
                </table>
                
                <div class="espacioUno"></div>
                                
                <input type="hidden" name="IdGrupo" id="IdGrupo" value="<?=$id_grupo;?>">
                <input type="hidden" name="IdCurso" id="IdCurso" value="<?=$id_curso;?>">
                <input type="hidden" name="IdNivel" id="IdNivel" value="<?=$id_nivel;?>">
                <input type="hidden" name="IdCiclo" id="IdCiclo" value="<?=$id_ciclo;?>">
                <div class="espacioDos"></div>
                <hr class="linea"/>
                  <div class="text-center">
                    <button type="submit" name="SubmitObtenerCalificaciones" class="btn btn-primary btn-sm">Aplicar calificaciónes</button>                
                  </div>
                </div>
              </div>
              </form>



              <br />


            </div>
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
      <p class="mt-5 mb-3 text-muted text-center"> © <span class="brain-foot">Brain</span> <?php echo date("Y"); ?></p>
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