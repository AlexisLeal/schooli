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





    <!--Ejemplo tabla con DataTables-->
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
                <h4>Grupo asignado.</h4>
                <hr class="linea"/>
                <div style="padding-left:30px">
                    <div class="card">
                      <div class="card-body">
                        <?php
                        if($id_grupo == null){
                          echo "No has sido asignado a un grupo";
                        }else{ ?>
                          Nombre del grupo:<?php echo $nombre_grupo;?> <br/>
                          Codigo de acceso: <?php echo $codigo_acceso;?> <br/>
                          Unidad Negocio: <?php echo $unidad_negocio;?> <br/>
                          Plantel: <?php echo $nombre_plantel;?> <br/>
                          Curso: <?php echo $nombre_curso;?> <br/>
                        <?php }?>
                      </div>
                    </div>
                   <br/>


                    <div class="card">
                      <div class="card-body">
                      <i class="fa fa-university" aria-hidden="true"> </i> <span class="font-weight-bold">Teachers</span>
                        <table width="90%" cellspacing="8" cellpadding="4">
                        <tr>
                        <td width="40%">
                        <?php if(isset($nombre_maestro)){?>
                        Nombre del Teacher <?php echo $nombre_maestro ?></a>
                        <?php }else{
                        echo "No tiene Teacher asignado.";
                        }?>
                        </td>
                        </tr>
                        </table>
                      </div>
                    </div>
                    <br/>



            <?php if($id_grupo != null){ ?>
            <div class="card">
                  <div class="card-body">
                  <i class="fa fa-cubes" aria-hidden="true"></i> <span class="font-weight-bold">Recursos </span><br/>




                   <?php 
                   // Obtener el horario que tiene asignado este grupo
                   $horario = AsignacionGetGrupoHorario($id_grupo);
                    
                   $hi              = $horario->hora_inicio;
                   $hf              = $horario->hora_fin;
                   
                   // Obtener fecha del servidor
                   $horaActual      = date("H:i");
                   $day             = date("l");
                   $hoy             = date("Y-m-d");


                   $goahead=0;
                   $frecuenciaGrupo = AsignacionGetGrupoFrecuencia($id_grupo);
                   
                   if($day == "Sunday" && $frecuenciaGrupo->domingo==1){ $goahead=1;}
                   if($day == "Monday" && $frecuenciaGrupo->lunes==1){ $goahead=1;}
                   if($day == "Tuesday" && $frecuenciaGrupo->martes==1){ $goahead=1; }
                   if($day == "Wednesday" && $frecuenciaGrupo->miercoles==1){ $goahead=1; }
                   if($day == "Thursday" && $frecuenciaGrupo->jueves==1){ $goahead=1; }
                   if($day == "Friday" && $frecuenciaGrupo->viernes==1){$goahead=1;}
                   if($day == "Saturday" && $frecuenciaGrupo->sabado==1){$goahead=1;}
                   
                   $id_ciclo_grupo=getCicloGrupoEspecifico($id_grupo);
                   $id_ciclo = $id_ciclo_grupo->id_ciclo;
                   $infoCiclo = getCicloEspecifico($id_ciclo);

                   $fechaInicioCiclo = $infoCiclo->fecha_inicio;
                   $fechaFinCiclo = $infoCiclo->fecha_fin;
                   $fechaHoy = date("Y-m-d");
                   if($fechaHoy >= $fechaInicioCiclo && $fechaHoy <= $fechaFinCiclo){

                   
                  
                   $liberar = ObtenerTablaCursoCiclo($id_grupo,$codigo_acceso,$id_nivel,$fechaHoy);

                   //Poner validacion de los rangos con el ciclo 
                  


                   $evaluacionGrupo =  getRecursosPorCursoNivelSession($id_curso,$id_nivel,$liberar->sesion); 
                   ?>
                  <table width="80%" le cellspacing="2" cellpadding="3">
                  <tr><td></td><td></td><td></td></tr>

                   <?php
                   if(empty($evaluacionGrupo)){
                    echo "No tien recursos";
                   }else{
                    foreach($evaluacionGrupo as $fila){
                      if($hoy >= $fechaInicioCiclo && $hoy <= $fechaFinCiclo && $goahead==1 && $horaActual>=$hi && $horaActual<=$hf){?>
                      
                      
                      

                    <?php
                    if($fila->tipo_recurso == 1){
                      if(getTotalPreguntas($fila->id_evaluacion)==0){
                        ?>
                        <tr>
                        <td><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></td>
                        <td><button type="button" class="btn btn-success btn-sm"><?php echo $fila->nombre;?></button></td>
                        <td><span class="evalacionesSinPreguntas">Esta evaluación no tiene preguntas asignadas.</span></td>
                         </tr>
                        <?php
                      }else{
                      ?>
                      <tr>
                      <td><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></td>
                      <td><a class="btn btn-success btn-sm" href="<?php echo site_url("Alumno/presentarevaluacion/$fila->id_evaluacion/$id_grupo/$id_curso/$id_nivel/$id_ciclo"); ?>" role="button"><?php echo $fila->nombre;?></a></td>
                      <td></td>
                      </tr>
                      <?php
                      }
                      ?>
                      
  
                    <?php
                     }else{
                       ?>
                      <tr>
                      <td><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></td>
                      <td><a href="<?php echo base_url($fila->ruta); ?>">
                      <?php echo $fila->nombre;?></a></td>
                      <td></td>
                      </tr>
                       <?php
                     }
                      }else{?>




                      <?php
                      }
                      ?>
                    <?php
                    }
                  }
                }
                   ?>    
             

                  </table>
                  <br/><br/>

                  </div>
                </div>
            <?php }?>


            <br/>

            <div class="card">
              <div class="card-body">
                <li class="list-group-item"><a class="" href="<?php echo site_url("Alumno/calificaciones/$id_grupo")?>">Calificaciones</a></li>
              </div>
            </div>



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

<?php include(APPPATH.'Views/include/footer.php');?>