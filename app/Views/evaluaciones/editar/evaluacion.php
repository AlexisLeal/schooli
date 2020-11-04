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
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Notificaciones del sistema:</strong> Este texto es un ejemplo de notificaciones que el sistema le debe de mostrar al Administrador.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 

              <a href="panel.php">Panel.</a><br/>
              <a href="evaluaciones.php">Evaluaciones.</a><br/>
              
              <div class="espacioUno"></div>

              <table width="80%">
              <tr><td><p class="font-weight-bold">Nombre de evaluacion:</p></td><td><?php echo $nombre;?></td></tr>
              <tr><td><p class="font-weight-bold">Tipo Evaluacion:</p></td><td><?php echo $tipo_evaluacion;?></td></tr>
              <tr><td><p class="font-weight-bold">Clave de evaluación:</p></td><td><?php echo $clave;?></td></tr>
              <tr><td><p class="font-weight-bold">Valor total.</p></td><td><?php echo $valorpreguntas;?></td></tr>
              </table>
          
              <div class="row">
                <div class="col-md-2 text-center">
                <p class="font-weight-bold">No.</p>
                </div>
                <div class="col-md-8">
                <p class="font-weight-bold">Pregunta</p>
                </div>
                <div class="col-md-1 text-center">
                <p class="font-weight-bold">Valor</p>
                </div>       
                <div class="col-md-1 text-center">
                
                </div>  
              </div>

          
              <?php
              foreach(getPreguntas($idEvaluacion) as $fila){
              ?>
              <div class="row">
                  <div class="col-md-2 text-center">
                  <?php echo $fila->num_pregunta;?>
                  </div>
                  <div class="col-md-8">
                  <?php
                  echo $fila->pregunta;

                  if($fila->tiene_imagen==1 || $fila->tiene_audio_pregunta==1){
                      if($fila->tiene_imagen==1){
                        ?>
                        <img src="<?php echo base_url($fila->ruta_imagen);?>" class = "img-fluid" alt="INBI" ><br/>
                        <?php
                      }
                      if($fila->tiene_audio_pregunta==1){
                        ?>
                        <audio class="asado img-fliud" name="" id ="" src="<?php echo base_url($fila->ruta_audio_pregunta);?>" controls></audio><br/>
                        

                        <?php
                      }
                  }else{
                      
                  }
                  ?>
                  </div>
                  <div class="col-md-1 text-center">
                  <?php echo $fila->valor;?>
                  </div>
                  <div class="col-md-1 text-center">
                  <form action="<?php echo site_url('Preguntas/deletedPreguntas')?>" name="<?php echo $fila->id;?>" id="" method="post">
                  <input type="hidden" name="idEvaluacion" id="idEvaluacion" value="<?php echo $idEvaluacion;?>">
                  <input type="hidden" name="tipoPregunta" id="tipoPregunta" value="<?php echo $fila->idTipoPregunta;?>">
                  <input type="hidden" name="idPregunta" id="idPregunta" value="<?php echo $fila->id;?>">
                  <input type="hidden" name="num_pregunta" id="num_pregunta" value="<?php echo $fila->num_pregunta;?>">
                  <button type="submit" name="submitAP" id="submitAP"><i class="fa fa-trash-o" aria-hidden="true"></i></i></span></button>
                  </form>

                  </div>
              </div>




              <?php
          $idPregunta = $fila->num_pregunta;
          switch ($fila->idTipoPregunta){
          case 1: // Pregunta abierta
            ?>
            <div class="row">
              <div class="col-md-2 text-center">
              
              </div>
              <div class="col-md-8">
              <input type="text" class="form-control" name="<?php echo "ID".$fila->id."_EVAL".$fila->idEvaluacion."_NP".$fila->num_pregunta.""?>"
              id="<?php echo "ID".$fila->id."EVAL".$fila->idEvaluacion."NP".$fila->num_pregunta.""?>">
              </div>
              <div class="col-md-2 text-center">
              
              </div>
            </div>
          <?php
              break;

            case 2:
              // si es opcion multiple
              ?>
              <div class="row">
                <div class="col-md-2 text-center">
                
                </div>
                <div class="col-md-8">
                <?PHP
                $pregunta_multiple = getPreguntaOpcion_multiple($idEvaluacion,$idPregunta);
                ?>
                <table>
                  <tr>
                  <td><?php echo empty($pregunta_multiple->valor1) ? 0 : $pregunta_multiple->valor1;?> <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2"></td>
                  <td><?php echo empty($pregunta_multiple->valor2) ? 0 : $pregunta_multiple->valor2;?> <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2"></td>
                  <td><?php echo empty($pregunta_multiple->valor3) ? 0 : $pregunta_multiple->valor3;?> <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2"></td>
                  <td><?php echo empty($pregunta_multiple->valor4) ? 0 : $pregunta_multiple->valor4;?> <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2"></td>
                </tr>
              </table>
                
          </div>
          <div class="col-md-2 text-center">
          
          </div>
          </div>
          <?php
          break;
          case 3://audio
            ?>
            <div class="row">
              <div class="col-md-2 text-center">
              </div>
              <div class="col-md-8">
              <?PHP
              $pregunta_audio = getPreguntaOpcion_audio($idEvaluacion,$idPregunta);
            ?>
          <audio class="asado img-fluid" name="" id ="" src="<?php echo base_url($pregunta_audio->ruta_audio);?>" controls></audio>
          <textarea class="form-control" name="<?php echo "ID".$fila->id."EVAL".$fila->idEvaluacion."NP".$fila->num_pregunta.";"?>" id="<?php echo "ID".$fila->id."EVAL".$fila->idEvaluacion."NP".$fila->num_pregunta.";"?>" rows="3"></textarea>
            </div>
            <div class="col-md-2 text-center">
              
            </div>
            </div>
          <?php
              break;

          case 4:// video
            ?>
            <div class="row">
              <div class="col-md-2 text-center">
              </div>
              <div class="col-md-8">
              <?PHP
              $pregunta_video = getPreguntaOpcion_video($idEvaluacion,$idPregunta);
              ?>
              <video name="" id="" class = "img-fluid" src="<?php echo $pregunta_video == null ? "desconocido" :base_url($pregunta_video->ruta_video);?>" controls>
                Tu navegador no implementa el elemento <code>video</code>.
              </video>
          <textarea class="form-control" name="<?php echo "ID".$fila->id."EVAL".$fila->idEvaluacion."NP".$fila->num_pregunta.";"?>" id="<?php echo "ID".$fila->id."EVAL".$fila->idEvaluacion."NP".$fila->num_pregunta.";"?>" rows="3"></textarea>

          </div>
              <div class="col-md-2 text-center">

              </div>
            </div>
          <?php
              break;

          case 5:// falso o verdadero
            ?>
            <div class="row">
              <div class="col-md-2 text-center">

              </div>
              <div class="col-md-8">
              <div class="form-check">
                  <input class="form-check-input" type="radio" name="<?php echo "ID".$fila->id."EVAL".$fila->idEvaluacion."NP".$fila->num_pregunta.";"?>" id="radio1" value="verdadero">
                  <label class="form-check-label" for="exampleRadios1">
                  Verdadero
                  </label>
                  </div>
                  <div class="form-check">
                  <input class="form-check-input" type="radio" name="<?php echo "ID".$fila->id."EVAL".$fila->idEvaluacion."NP".$fila->num_pregunta.";"?>" id="radio2" value="falso">
                  <label class="form-check-label" for="exampleRadios2">
                  Falso
                  </label>
                  </div>


              </div>
              <div class="col-md-2 text-center">

              </div>
            </div>
          <?php
              break;
            }
            ?>
            <div class="espacioUno"></div>
            <hr class="lineaSolida">
            <div class="espacioUno"></div>
            
            <?php
            }
            ?>


        <div class="container">
        <div class="row">
            
            <div class="col-md-2 text-center">
              </div>
            
              <div class="col-md-8 text-center">
                <button class="btn btn-primary" type="submit" name="" id="">Guardar</button>
              </div>
          
              <div class="col-md-2 text-center">
              </div>
          
            </div>
        </div>


          </div> <!-- Termina el Div del contenido de enmedio-->


          <!--
          <div class="col-md-3">
           Con tenido de lado derecho. Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.
          </div>-->
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