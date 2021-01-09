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
                <?php
                /*** Obtenemos valores de la ponderación */
                $valoresPonderacion = CatalagoObtenerPonderaciondeCurso($id_curso);
                ?>
                <table>
                <tr>
                  <td>Ponderacion</td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                  <td>Total de dias laborales:</td><td><?php echo $valoresPonderacion->total_dias_laborales;?></td>
                  <td>Número de exámenes:</td><td><?php echo $valoresPonderacion->num_examenes;?></td>
                  <td>Número de ejercicios:</td><td><?php echo $valoresPonderacion->num_ejercicios;?></td>
                </tr>
                <tr>
                  <td>Valor de asistencia:</td><td><?php echo $valoresPonderacion->valor_asistencia;?></td>
                  <td>Valor de ejercicios:</td><td><?php echo $valoresPonderacion->valor_ejercicios;?></td>
                  <td>Valor de examenes:</td><td><?php echo $valoresPonderacion->valor_examenes;?></td>
                </tr>
                </table>
              <br/>
              <br/>

              <div class="card">
                <div class="card-body">    
                
                <!-- Obtener los alumnos que pertenecen a este grupo -->
                <?php
                
                foreach(getMiembros($id_grupo) as $fila){
                  echo $fila->nombre." ".$fila->apellido_paterno." ".$fila->apellido_materno;
                  foreach(getAsistenciaGrupo($fila->id,$id_grupo) as $fila2){
                    echo "Numero de semana:".$fila2->numero_de_semana." Fecha asistencia:".$fila2->fecha_asistencia." Valor Asistencia:".$fila2->valor_asistencia."<br/>";
                  }
                  // Obtener la asitencia mediante una funcion que consulte la tabla asistencia_grupo
                }
                ?>
                <!-- Para obtener la asitencia se debe obtener dias totales del curso entre el valor total, y ese resultado multipllicarlo por lo dias que asisitio -->
                <!-- Funcion para obtener la asistencia del alumno de este curso -->

                <!-- Para obtener los examenes se debe obtener el valor total de los examanes entre la cantidad de examenes, y ese resultado se multiplica por la cantidad de la calificacion del examen -->
                <!-- Para obtener los ejercicios se debe obtener el valor total de los ejercicio entre la cantidad de ejercicios, y ese resultado se multiplica por la cantidad de la calificacion del ejercicio -->

                </div>
              </div>




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