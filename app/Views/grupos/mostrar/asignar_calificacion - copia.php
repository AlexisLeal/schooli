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

                
                $info_ciclo = getCicloEspecifico($id_ciclo);

                $curso_especifico = getCursoEspecifico($id_curso);
                $id_frecuencia = $curso_especifico->id_frecuencia;

                $infoFrecuencia = getFrencueciaEspecifica($id_frecuencia);

                $valoresPonderacion = CatalagoObtenerPonderaciondeCurso($id_curso);
                ?>

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
                
                function porcentaje($t, $porcent) {
                  if($t>=1){
                      return $t*$porcent;
                  }else{
                    $p="0.".$porcent;
                    return $t*floatval($p);
                  }
                  //return round($porcent / $t * 100);
                }

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
                    

                    $valorRetardo=porcentaje($valAsistDiaria, 50 );
                    $sumValorRetardo = $valorRetardo*$numeroRetardo;
                    
                    $valorFaltaJustificada=porcentaje($valAsistDiaria, 50 );
                    $sumCalorFaltasJustificadas=$valorFaltaJustificada*$numeroFaltaJustificada;

                    $asistencia = $valAsistDiaria*$numeroAsistencia;
                    $valorTotalAsistencia=$asistencia+$sumValorRetardo+$sumCalorFaltasJustificadas;
                    echo "la asistencia es".$valorTotalAsistencia."<br/>";                   


                }
                ?>


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


<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/antes-footer.php'); ?>

<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/footer.php'); ?>