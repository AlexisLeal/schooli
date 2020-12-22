<?php include(APPPATH.'/Views/include/header.php');?>
<style>
.evalacionesSinPreguntas{
  font-size:70%;
}
</style>
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

            <?php if($session->has('EvaluacionContestadaOk')){;?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               <?php echo $session->get('EvaluacionContestadaOk')?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <?php } $session->remove('EvaluacionContestadaOk');?>

              

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
                  <?php echo $unidad_negocio;?> <br/>
                  Plantel: <?php echo $nombre_plantel;?> <br/>
                
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



                  <table width="90%" cellspacing="8" cellpadding="4">
                  <tr>
                  <td>Evaluaciónes</td>
                  </tr>
                  <tr>
                  <td>

                  <p>Las evaluaciones enlistadas son las asignadas acontinuación, pero estas evaluacion solo estan activadas 
                  segun el horario esablecido por el administrador del sistema.</p>

                   <?php 
                    $horario = AsignacionGetGrupoHorario($id_grupo);
                    
                   $hi              = $horario->hora_inicio;
                   $hf              = $horario->hora_fin;
                   $horaActual      = date("H:i");
                   $day             = date("l");
                   $goahead=0;
                   $frecuenciaGrupo = AsignacionGetGrupoFrecuencia($id_grupo);
                   
                   if($day == "Sunday" && $frecuenciaGrupo->domingo==1){ $goahead=1;}
                   if($day == "Monday" && $frecuenciaGrupo->lunes==1){ $goahead=1;}
                   if($day == "Tuesday" && $frecuenciaGrupo->martes==1){ $goahead=1; }
                   if($day == "Wednesday" && $frecuenciaGrupo->miercoles==1){ $goahead=1; }
                   if($day == "Thursday" && $frecuenciaGrupo->jueves==1){ $goahead=1; }
                   if($day == "Friday" && $frecuenciaGrupo->viernes==1){$goahead=1;}
                   if($day == "Saturday" && $frecuenciaGrupo->sabado==1){$goahead=1;}

                   $evaluacionGrupo =  getGruposEvaluacion($id_grupo);
                   ?>
                  <table width="80%" le cellspacing="2" cellpadding="3">
                  <tr><td></td><td></td><td></td></tr>

                   <?php
                   if(empty($evaluacionGrupo)){
                    echo "No tiene evaluaciones asignadas";
                   }else{
                    foreach($evaluacionGrupo as $fila){
                      $num_preg = 0;
                      $num_preg = getTotalPreguntas($fila->id);
                      if($goahead==1 && $horaActual>=$hi && $horaActual<=$hf){?>
                      <tr>
                      <td><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i></td>
                      


                      <?php
                      if($num_preg==0){
                        ?>
                        <td><button type="button" class="btn btn-success btn-sm"><?php echo $fila->nombre;?></button></td>
                        <td><span class="evalacionesSinPreguntas">Esta evaluación no tiene preguntas asignadas.</span></td>
                         
                        <?php
                      }else{
                      ?>
                      <td><a class="btn btn-success btn-sm" href="<?php echo site_url("Alumno/presentarevaluacion/$fila->id/$id_grupo"); ?>" role="button"><?php echo $fila->nombre;?></a></td>
                      <td></td>
                      
                      <?php
                      }
                      ?>
                      

                      </tr>
  
                    <?php
                      }else{?>
                      <tr>
                      <td><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i></td>
                      <td><button type="button" class="btn btn-secondary btn-sm"><?php echo $fila->nombre;?></button></td>
                      <td></td>
                      </tr>
                      <?php
                    }
                    ?>
                    


                    <?php
                    }
                  }
                   ?>                   
                  <tr>
                  <td></td>
                  <td></td>
                  </tr>
                  </table>
                  <br/><br/>
                  </td>
                  </tr>  
                
                  <tr>
                  <td>
                  Materiales
                  </td>
                  </tr>
                  <tr>
                  <td>
                  <?php

                  $recursosGrupo =  getGrupoRecursos($id_curso,$id_nivel);
                  if(empty($recursosGrupo)){
                    echo "No tiene evaluaciones asignadas";
                  }else{
                    foreach($recursosGrupo as $fila){
                      if(!empty($fila->id_grupo)){
                        switch($fila->extencion){
                          case "docx":
                            $icono = "fa-file-word-o fa-2x";
                        //<i class="fa fa-file-word-o" aria-hidden="true"></i>
                            break;
                          case "xlsx":
                            $icono = "fa-file-excel-o fa-2x";
                            //<i class="fa fa-file-excel-o" aria-hidden="true"></i>
                            break;
                          case "pdf":
                            $icono = "fa-file-pdf-o fa-2x";
                            //<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            break;
                          case "zip":
                            $icono = "fa-file-archive-o fa-2x";
                        //<i class="fa fa-file-archive-o" aria-hidden="true"></i>
                            break;
                          case "rar":
                            $icono = "fa-file-archive-o fa-2x";
                            //<i class="fa fa-file-archive-o" aria-hidden="true"></i>
                            break;
                          case "jpg":
                            $icono = "fa-file-image-o fa-2x";
                        //<i class="fa fa-file-image-o" aria-hidden="true"></i>
                            break;
                          case "png":
                            $icono = "fa-file-image-o fa-2x";
                        //<i class="fa fa-file-image-o" aria-hidden="true"></i>
                            break;
                          case "mp3":
                            $icono = "fa-file-audio-o fa-2x";
                        //<i class="fa fa-file-audio-o" aria-hidden="true"></i>
                            break;
                          case "mp4":
                            $icono = "fa-file-video-o fa-2x";
                        //<i class="fa fa-file-video-o" aria-hidden="true"></i>
                            break;
                          default:
                            $icono="fa-file fa-2x";
                      //<i class="fa fa-file" aria-hidden="true"></i>
                    }
                  
                  ?>

                  <a href="< ?php echo base_url($fila->ruta);?>"><i class="fa < ?php echo $icono;?>" aria-hidden="true"></i> <?php echo $fila->nombre;?></a>  <br/>
                
                  <?php
                  }
                   }
                  }
                   ?>
                
                
                

                  </td> 
                  </tr>
                  </table>
                  </div>
                </div>
            <?php }?>

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
            <p class="mt-5 mb-3 text-muted text-center"> © <span class="brain-foot">Brain</span> <?php echo date("Y");?></p>
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

<?php include(APPPATH.'Views/include/footer.php');?>