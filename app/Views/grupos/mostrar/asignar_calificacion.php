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

                /** Obtener los valores de la asistencia */
                $a = array();
                foreach(getValorAsistencia() as $fila){
                  $a[$fila->id]=$fila->valor;
                }

                /*** Obtener los dias que dura el  ciclo fecha de inicio, fecha final y fecha inicio exclusion y fecha final exclusion (Parametro id_ciclo*/
                $info_ciclo = getCicloEspecifico($id_ciclo);
                //echo "Nombre del ciclo:".$info_ciclo->nombre."<br/>";
                /*
                echo "fecha inicio del ciclo:".$info_ciclo->fecha_inicio."<br/>";
                echo "fecha final del ciclo:".$info_ciclo->fecha_fin."<br/>";
                echo "fecha inicio exclusion del ciclo:".$info_ciclo->fecha_inicio_excluir."<br/>";
                echo "fecha final exclusion del ciclo:".$info_ciclo->fecha_fin_excluir."<br/>";*/

                /** Obtener datos de la frecuencia,el id de la frecuenci esta en la tabla del curso Ok*/
                $curso_especifico = getCursoEspecifico($id_curso);
                $id_frecuencia = $curso_especifico->id_frecuencia;
                /*echo "id de la frecuencia es".$id_frecuencia."<br/>";*/

                /*** Obtenemos los datos de la frecuencia */
                $infoFrecuencia = getFrencueciaEspecifica($id_frecuencia);
                /*
                echo "id de frecuenciaaaaaaa:".$infoFrecuencia->id."<br/>";
                echo "nombre:".$infoFrecuencia->nombre."<br/>";
                echo "id modalidad:".$infoFrecuencia->id_modalidad."<br/>";
                echo "lunes:".$infoFrecuencia->lunes."<br/>";
                echo "martes:".$infoFrecuencia->martes."<br/>";
                echo "miercoles:".$infoFrecuencia->miercoles."<br/>";
                echo "jueves:".$infoFrecuencia->jueves."<br/>";
                echo "viernes:".$infoFrecuencia->viernes."<br/>";
                echo "sabado:".$infoFrecuencia->sabado."<br/>";
                echo "domingo :".$infoFrecuencia->domingo."<br/>";
                echo "estatus:".$infoFrecuencia->estatus."<br/>";*/

                /*** Obtenemos valores de la ponderación */
                $valoresPonderacion = CatalagoObtenerPonderaciondeCurso($id_curso);
                ?>
                <!--
                <table>
                <tr>
                  <td>Ponderacion</td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                  <td>Total de dias laborales:</td><td>< ?php echo $valoresPonderacion->total_dias_laborales;?></td>
                  <td>Número de exámenes:</td><td>< ?php echo $valoresPonderacion->num_examenes;?></td>
                  <td>Número de ejercicios:</td><td>< ?php echo $valoresPonderacion->num_ejercicios;?></td>
                </tr>
                <tr>
                  <td>Valor de asistencia:</td><td>< ?php echo $valoresPonderacion->valor_asistencia;?></td>
                  <td>Valor de ejercicios:</td><td>< ?php echo $valoresPonderacion->valor_ejercicios;?></td>
                  <td>Valor de examenes:</td><td>< ?php echo $valoresPonderacion->valor_examenes;?></td>
                </tr>
                </table>-->
              <br/>
              <br/>

            <?php
            // Obtener los dias de con el paraemtro especificado(se validar con los datos del ciclo)
            $fechaInicio = $info_ciclo->fecha_inicio;
            $fechaFin    = $info_ciclo->fecha_fin;

            $week_start = strtotime(date($fechaInicio));
            $week_end = strtotime(date($fechaFin));

            // validar si hay dias que se van a excluir
            if(!empty($info_ciclo->fecha_inicio_excluir)){
              // si hay fechas a excluir
              $info_ciclo->fecha_inicio_excluir;
              $info_ciclo->fecha_fin_excluir;
            }
            ?>

              <div class="card">
                <div class="card-body">
                <?php
                
                

                // Obtener los alumnos que pertenecen a este grupo OK
                foreach(getMiembros($id_grupo) as $fila){
                  $total = 0; 
                  $numeroAsistencia       = 0;
                  $numeroFalta            = 0;
                  $numeroRetardo          = 0;
                  $numeroFaltaJustificada = 0;
                    foreach(getAsistenciaGrupo($fila->id,$id_grupo) as $fila2){                        
                        for($i=$week_start; $i<=$week_end; $i+=86400){
                          if(date("Y-m-d", $i)==$fila2->fecha_asistencia){
                            $total+=$a[$fila2->valor_asistencia];
                            
                            if($fila2->valor_asistencia==1){
                              $numeroAsistencia++;
                            }
                            if($fila2->valor_asistencia==2){
                              $numeroFalta++;
                            }
                            if($fila2->valor_asistencia==3){
                              $numeroRetardo++;
                            }
                            if($fila2->valor_asistencia==4){
                              $numeroFaltaJustificada++;
                            }     

                          }
                        }
                    }
                    echo $fila->nombre." ".$fila->apellido_paterno." ".$fila->apellido_materno." ---".$total."<br/>";
                    $valAsistDiaria = $valoresPonderacion->total_dias_laborales/$valoresPonderacion->valor_asistencia;
                    echo "Valor de la asistencia diaria es ".$valAsistDiaria."<br/>";
                    $asistencia = $valAsistDiaria*$numeroAsistencia;
                    echo "la asistencia es".$asistencia."<br/>";
                    
                    $retardo = $numeroRetardo; 
                    


                }
                ?>

                <!-- Para obtener la asitencia se debe obtener dias totales del curso entre el valor total, 
                // y ese resultado multipllicarlo por lo dias que asisitio -->
                
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