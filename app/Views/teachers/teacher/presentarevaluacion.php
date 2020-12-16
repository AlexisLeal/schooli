<?php include(APPPATH.'/Views/include/header.php');?>

<style>
#contestarEvaluacion {
    display:none;
}

.pers {
    margin-left:20px;
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
          <div class="col-md-2">
            <?php include(APPPATH.'/Views/include/menu-alumno.php');?>
          </div>



          <div class="col-md-10">
          <?php include(APPPATH.'/Views/include/notificacion.php');?>

          <div class="espacioUno"></div>
          <div class="text-right">
            <h4><?php echo $session->get('nombre')." ".$session->get('apellido')." ".$session->get('apellido_materno');?></h4>
          </div>
          <div class="espacioUno"></div>

          
            <div class="card">
              <div class="card-body">
              <h4>Evaluación</h4>
              <hr class="linea"/>
              <div style="padding-left:20px">
              <div class="card">
              <div class="card-body">
              
              <table width="80%">
              <tr><td><p class="font-weight-bold">Nombre de evaluacion:</p></td><td><?php echo $nombre;?></td></tr>
              <tr><td><p class="font-weight-bold">Tipo Evaluacion:</p></td><td><?php echo $tipo_evaluacion;?></td></tr>
              <tr><td><p class="font-weight-bold">Clave de evaluación:</p></td><td><?php echo $clave;?></td></tr>
              <tr><td><p class="font-weight-bold">Valor total.</p></td><td><?php echo $valorpreguntas;?></td></tr>
              <tr><td>Instrucciones</td><td></td></tr>
              <tr><td colspan="2">Aquí van las indiciaciones para el estaudiante de que dando click para iniciar la evaluacion
              se tiene que completar la evaluacíon.</td></tr>
              <tr><td colspan="2">
              <div class="text-center">
              <br/><br/>
              <button name="btnIniciarEvaluacion" class="btn btn-success btn-sm" id="btnIniciarEvaluacion" onclick="mostrarEvaluacion()">Iniciar Evaluación</button>
              </div>
              </td></tr>
              </table>
            <br/>
            <br/>

<!-- Esta evaluacion tiene un estimado de tiempo para contestar (timer, definido)
cuando el usuario de click en iniciar
que no se pueda cerrar la ventana del navegadorsi el usuario dice que 
similar_textque se guarden todos los datos y luego ya se cierre el navegador
-->
            <form action="<?php echo site_url('Alumno/CalificarEvaluacion')?>" method="post">
            <div id="contestarEvaluacion" style="background-color:#cdcdcd;">
            <br/>
            <div class="text-right">
              <i class="fa fa-hourglass-start" aria-hidden="true"></i>
            </div>
            <br/>


              <div class="row">
                <div class="col-md-2 text-center">
                <p class="font-weight-bold">No.</p>
                </div>
                <div class="col-md-8">
                <p class="font-weight-bold">Pregunta</p>
                </div>
                <div class="col-md-2 text-center">
                <p class="font-weight-bold">Valor</p>
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
                  //echo $fila->pregunta;

                  if($fila->tiene_imagen==1 || $fila->tiene_audio_pregunta==1){
                      if($fila->tiene_imagen==1){
                        ?>
                        <img src="<?php echo base_url($fila->ruta_imagen);?>" class = "img-fluid" alt="Imagen" ><br/>
                        <?php
                      }
                      if($fila->tiene_audio_pregunta==1){
                        ?>
                        <audio class="asado img-fliud" name="" id ="" src="<?php echo base_url($fila->ruta_audio_pregunta);?>" controls></audio><br/>
                        

                        <?php
                      }
                  }else{
                  echo $fila->pregunta;
                  }
                  ?>
                  </div>
                  <div class="col-md-2 text-center">
                  <?php echo $fila->valor;?>
                  </div>
              </div>





              <?php
          //$idPregunta = $fila->num_pregunta;
          $idPregunta = $fila->id;
          switch ($fila->idTipoPregunta){
          case 1: // Pregunta abierta
            ?>
            <div class="row">
              <div class="col-md-2 text-center">
              
              </div>
              <div class="col-md-8">
              <input type="text" class="form-control" required name="<?php echo $fila->num_pregunta;?>"
              id="">
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
              <br/>
                <div class="col-md-2 text-center">
                
                </div>
                <div class="col-md-8">
                <?PHP
                
                $pregunta_multiple = getPreguntaOpcion_multiple($idEvaluacion,$idPregunta);
                ?>
                <br/>
                
                <table width="100%">
                  <tr>
                  <!--
                  <td width="20%"> < ?php echo empty($pregunta_multiple->valor1) ? 0 : $pregunta_multiple->valor1;?> <input class="form-check-input pers" type="radio" name="exampleRadios" id="exampleRadios2" value="option2"> </td>
                  <td width="20%"> < ?php echo empty($pregunta_multiple->valor2) ? 0 : $pregunta_multiple->valor2;?> <input class="form-check-input pers" type="radio" name="exampleRadios" id="exampleRadios2" value="option2"> </td>
                  <td width="20%"> < ?php echo empty($pregunta_multiple->valor3) ? 0 : $pregunta_multiple->valor3;?> <input class="form-check-input pers" type="radio" name="exampleRadios" id="exampleRadios2" value="option2"> </td>
                  <td width="20%"> < ?php echo empty($pregunta_multiple->valor4) ? 0 : $pregunta_multiple->valor4;?> <input class="form-check-input pers" type="radio" name="exampleRadios" id="exampleRadios2" value="option2"> </td>
                -->
                  <td width="20%"> <input class="form-check-input" type="radio" required name="<?php echo 'optmulti'.$pregunta_multiple->idPregunta;?>" id="exampleRadios2" value="1"> <?php echo "<span class='pers'>".$pregunta_multiple->valor1."</span>";?>  </td>
                  <td width="20%"> <input class="form-check-input" type="radio" required name="<?php echo 'optmulti'.$pregunta_multiple->idPregunta;?>" id="exampleRadios2" value="2"> <?php echo "<span class='pers'>".$pregunta_multiple->valor2."</span>";?>  </td>
                  <td width="20%"> <input class="form-check-input" type="radio" required name="<?php echo 'optmulti'.$pregunta_multiple->idPregunta;?>" id="exampleRadios2" value="3"> <?php echo "<span class='pers'>".$pregunta_multiple->valor3."</span>";?>  </td>
                  <td width="20%"> <input class="form-check-input" type="radio" required name="<?php echo 'optmulti'.$pregunta_multiple->idPregunta;?>" id="exampleRadios2" value="4"> <?php echo "<span class='pers'>".$pregunta_multiple->valor4."</span>";?>  </td>
                </tr>
              </table>
                
          </div>
          <div class="col-md-2 text-center">
          
          </div>
          <br/><br/>
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
          <textarea class="form-control" name="<?php echo $idPregunta;?>" id="" rows="3" required></textarea>
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
          <textarea class="form-control" required name="<?php echo $idPregunta;?>" id="" rows="3"></textarea>

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
                  <input class="form-check-input" type="radio" name="<?php echo $fila->id;?>" id="radio1" value="verdadero">
                  <label class="form-check-label" for="exampleRadios1">
                  Verdadero
                  </label>
                  </div>
                  <div class="form-check">
                  <input class="form-check-input" type="radio" name="<?php echo $fila->id;?>" id="radio2" value="falso">
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
                <input type="hidden" value="<?php echo $idEvaluacion ?>" name="idEvaluacion">
                <input type="hidden" value="<?php echo $idGrupo ?>" name="idGrupo">
                <button class="btn btn-primary" type="submit" name="SubmitRespuestas" id="btnRegEval">Enviar</button>
              </div>
          
              <div class="col-md-2 text-center">
              </div>
          
            </div>
        </div>
</div><!-- Termina el div que contiene el contenido de la evaluación que se va a contestar -->

</form>











              </div>
            </div>
            
            <!--
            <div class="card">
                <div class="card-body">

                </div>
            </div>
            -->



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

<script>
function mostrarEvaluacion(){
  let idAparecer = document.getElementById("contestarEvaluacion");


function aparecer(idAparecer,num){
  idAparecer.style.display="block";
  idAparecer.style.opacity=0;

  for(i = 1; i<=10; i++){
	let time = i * 0.1;
	let n = i * 100;
	setTimeout(function(){ idAparecer.style.opacity=time; },n); 
  }

}



let num=10;
aparecer(idAparecer,num);

  document.getElementById("btnIniciarEvaluacion").disabled=true;
}
</script>
<?php include(APPPATH.'Views/include/footer.php');?>