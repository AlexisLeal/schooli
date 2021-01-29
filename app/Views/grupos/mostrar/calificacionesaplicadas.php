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
        <h4>Mostrar calificaciones.</h4>
        <div class="card">
          <div class="card-body">

            <div style="padding-left:30px">
            <br/>
            
                <?php
                $a = array();
                foreach(getValorAsistencia() as $fila){
                  $a[$fila->id]=$fila->valor;
                }

                $info_ciclo         = getCicloEspecifico($id_ciclo);
                $curso_especifico   = getCursoEspecifico($id_curso);
                $id_frecuencia      = $curso_especifico->id_frecuencia;
                $infoFrecuencia     = getFrencueciaEspecifica($id_frecuencia);
                $valoresPonderacion = CatalagoObtenerPonderaciondeCurso($id_curso);
                $fechaInicio        = $info_ciclo->fecha_inicio;
                $fechaFin           = $info_ciclo->fecha_fin;
                $week_start         = strtotime(date($fechaInicio));
                $week_end           = strtotime(date($fechaFin));

                
                if(!empty($info_ciclo->fecha_inicio_excluir)){
                  $info_ciclo->fecha_inicio_excluir;
                  $info_ciclo->fecha_fin_excluir;
                }
                ?>
              <div class="card">
                <div class="card-body">
                <?php
                
                function porcentaje($t, $porcent) {
                  if($t>=1){
                    $p="0.".$porcent;
                    return $t*floatval($p);
                  }else{
                    $p="0.".$porcent;
                    return $t*floatval($p);
                  }
                }
                foreach(getMiembros($id_grupo) as $fila){
                  echo $fila->id."<br/>";
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
                    
                    $valAsistDiaria   = $valoresPonderacion->valor_asistencia/$valoresPonderacion->total_dias_laborales;
                    $valorRetardo     = porcentaje($valAsistDiaria, 50 );
                    $sumValorRetardo  = $valorRetardo*$numeroRetardo;
                    $valorFaltaJustificada      = porcentaje($valAsistDiaria, 50 );
                    $sumCalorFaltasJustificadas = $valorFaltaJustificada*$numeroFaltaJustificada;
                    $asistencia                 = $valAsistDiaria*$numeroAsistencia;
                    $valorTotalAsistencia       = $asistencia+$sumValorRetardo+$sumCalorFaltasJustificadas;
                    
                    
                    echo $fila->nombre." ".$fila->apellido_paterno." ".$fila->apellido_materno." ---".$valorTotalAsistencia."<br/>";

                }
                ?>

                
                <div class="espacioUno"></div>
                                
                <input type="hidden" name="IdGrupo" id="IdGrupo" value="<?=$id_grupo;?>">
                <input type="hidden" name="IdCurso" id="IdCurso" value="<?=$id_curso;?>">
                <input type="hidden" name="IdNivel" id="IdNivel" value="<?=$id_nivel;?>">
                <input type="hidden" name="IdCiclo" id="IdCiclo" value="<?=$id_ciclo;?>">

                <button type="submit" name="SubmitObtenerCalificaciones" class="btn btn-primary btn-sm">Registrar</button>
                <button class="btn btn-secondary btn-sm" onclick="confirmarlimpiado()">Limpiar</button>
                
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