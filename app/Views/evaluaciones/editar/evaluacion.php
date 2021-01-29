<?php include(APPPATH . '/Views/include/header.php'); 
  header("Cache-Control: no-cache, must-revalidate");
  header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); ?>
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

        <?php if ($session->has('Eliminacion')) {; ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Notificaciones del sistema:</strong> <?php echo $session->get('Eliminacion'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php }
        $session->remove('Eliminacion'); ?>

      <?php
        if($session->has('pregunta-exito')){ ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $session->get('pregunta-exito');?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span> </button>
              </div>
              <?php $session->remove('pregunta-exito'); } ?>

              <div class="espacioUno"></div>
              <div class="espacioUno"></div>
              <table>
              <tr>
                <td><a href="javascript:history.back()"><i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i></a></td>
                <td><a href="javascript:history.back()">Atras</a></td>
              </tr>
              </table>  
              <div class="espacioUno"></div>

              <div class="card">
                <div class="card-body">
                <style>
                .verde {
                  color:#28B463;
                }
                </style>
                  <table width="80%">
                    <tr>
                      <td>
                        <p class="font-weight-bold">Nombre de evaluacion:</p>
                      </td>
                      <td><?php echo $nombre; ?></td>
                    </tr>
                    <tr>
                      <td>
                        <p class="font-weight-bold">Tipo Evaluacion:</p>
                      </td>
                      <td><?php echo $tipo_evaluacion; ?></td>
                    </tr>
                    <tr>
                      <td>
                        <p class="font-weight-bold">Clave de evaluación:</p>
                      </td>
                      <td><?php echo $clave; ?></td>
                    </tr>
                    <tr>
                      <td>
                        <p class="font-weight-bold">Valor total.</p>
                      </td>
                      <td><?php echo $valorpreguntas; ?></td>
                    </tr>
                    <tr>
                      <td>
                        <p class="font-weight-bold">Agregar una pregunta.</p>
                      </td>
                      <td><a href="<?php echo site_url("Preguntas/agregar_preguntas/$idEvaluacion")?>">
                      <i class="fa fa-plus-circle verde fa-2x" aria-hidden="true"></i></a></td>
                    </tr>
                  </table>
                </div>
              </div>
              
              <div class="espacioUno"></div>

              <div class="card">
                <div class="card-body">

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
                  foreach (getPreguntas($idEvaluacion) as $fila) {
                  ?>
                    <div class="row">
                      <div class="col-md-2 text-center">
                        <?php echo $fila->num_pregunta; ?>
                      </div>
                      <div class="col-md-8">
                        <?php


                        if ($fila->tiene_imagen == 1 || $fila->tiene_audio_pregunta == 1) {
                          if ($fila->tiene_imagen == 1) {
                        ?>
                            <img src="<?php echo base_url($fila->ruta_imagen); ?>" class="img-fluid" alt="INBI"><br />
                          <?php
                          }
                          if ($fila->tiene_audio_pregunta == 1) {
                          ?>
                            <audio class="asado img-fliud" name="" id="" src="<?php echo base_url($fila->ruta_audio_pregunta); ?>" controls></audio><br />


                        <?php
                          }
                        } else {
                          echo $fila->pregunta;
                        }
                        ?>
                      </div>
                      <div class="col-md-1 text-center">
                        <?php echo $fila->valor; ?>
                      </div>
                      <div class="col-md-1 text-center">
                        <form action="<?php echo site_url('Preguntas/deletedPreguntas') ?>" id="" method="post">
                          <input type="hidden" name="idEvaluacion" id="idEvaluacion" value="<?php echo $idEvaluacion; ?>">
                          <input type="hidden" name="idtipoPregunta" id="idtipoPregunta" value="<?php echo $fila->idTipoPregunta; ?>">
                          <input type="hidden" name="idPregunta" id="idPregunta" value="<?php echo $fila->id; ?>">
                          <!-- <input type="hidden" name="num_pregunta" id="num_pregunta" value="< ?php echo $fila->num_pregunta;?>"> -->
                          <button type="submit" name="submitAP" id="submitAP"><i class="fa fa-trash-o" aria-hidden="true"></i></i></span></button>
                        </form>

                      </div>
                    </div>


                    <?php
                    //$idPregunta = $fila->num_pregunta;
                    $idPregunta = $fila->id;
                    switch ($fila->idTipoPregunta) {
                      case 1: // Pregunta abierta
                    ?>
                        <div class="row">
                          <div class="col-md-2 text-center">

                          </div>
                          <div class="col-md-8">
                            <input type="text" class="form-control" name="<?php echo "ID" . $fila->id . "_EVAL" . $fila->idEvaluacion . "_NP" . $fila->num_pregunta . "" ?>" id="<?php echo "ID" . $fila->id . "EVAL" . $fila->idEvaluacion . "NP" . $fila->num_pregunta . "" ?>">
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
                            $pregunta_multiple = getPreguntaOpcion_multiple($idEvaluacion, $idPregunta);
                            ?>
                          <style>
                          .pers {
                            margin-left: 20px;
                            font-weight: bold;
                          }
                          </style>

                            <br/>
                            <table width="100%">
                              <tr>
                                <td width="20%"> <input class="form-check-input" type="radio" required name="<?php echo 'optmulti' . $pregunta_multiple->idPregunta; ?>" id="exampleRadios2" value="1"> <?php echo "<span class='pers'>" . $pregunta_multiple->valor1 . "</span>"; ?> </td>
                                <td width="20%"> <input class="form-check-input" type="radio" required name="<?php echo 'optmulti' . $pregunta_multiple->idPregunta; ?>" id="exampleRadios2" value="2"> <?php echo "<span class='pers'>" . $pregunta_multiple->valor2 . "</span>"; ?> </td>
                                <td width="20%"> <input class="form-check-input" type="radio" required name="<?php echo 'optmulti' . $pregunta_multiple->idPregunta; ?>" id="exampleRadios2" value="3"> <?php echo "<span class='pers'>" . $pregunta_multiple->valor3 . "</span>"; ?> </td>
                                <td width="20%"> <input class="form-check-input" type="radio" required name="<?php echo 'optmulti' . $pregunta_multiple->idPregunta; ?>" id="exampleRadios2" value="4"> <?php echo "<span class='pers'>" . $pregunta_multiple->valor4 . "</span>"; ?> </td>
                              </tr>
                            </table>

                          </div>
                          <div class="col-md-2 text-center">

                          </div>
                        </div>
                      <?php
                        break;
                      case 3: //audio
                      ?>
                        <div class="row">
                          <div class="col-md-2 text-center">
                          </div>
                          <div class="col-md-8">
                            <?PHP
                            $pregunta_audio = getPreguntaOpcion_audio($idEvaluacion, $idPregunta);
                            ?>
                            <audio class="asado img-fluid" name="" id="" src="<?php echo base_url($pregunta_audio->ruta_audio); ?>" controls></audio>
                            <textarea class="form-control" name="<?php echo "ID" . $fila->id . "EVAL" . $fila->idEvaluacion . "NP" . $fila->num_pregunta . ";" ?>" id="<?php echo "ID" . $fila->id . "EVAL" . $fila->idEvaluacion . "NP" . $fila->num_pregunta . ";" ?>" rows="3"></textarea>
                          </div>
                          <div class="col-md-2 text-center">

                          </div>
                        </div>
                      <?php
                        break;

                      case 4: // video
                      ?>
                        <div class="row">
                          <div class="col-md-2 text-center">
                          </div>
                          <div class="col-md-8">
                            <?PHP
                            $pregunta_video = getPreguntaOpcion_video($idEvaluacion, $idPregunta);
                            ?>
                            <video name="" id="" class="img-fluid" src="<?php echo $pregunta_video == null ? "desconocido" : base_url($pregunta_video->ruta_video); ?>" controls>
                              Tu navegador no implementa el elemento <code>video</code>.
                            </video>
                            <textarea class="form-control" name="<?php echo "ID" . $fila->id . "EVAL" . $fila->idEvaluacion . "NP" . $fila->num_pregunta . ";" ?>" id="<?php echo "ID" . $fila->id . "EVAL" . $fila->idEvaluacion . "NP" . $fila->num_pregunta . ";" ?>" rows="3"></textarea>

                          </div>
                          <div class="col-md-2 text-center">

                          </div>
                        </div>
                      <?php
                        break;

                      case 5: // falso o verdadero
                      ?>
                        <div class="row">
                          <div class="col-md-2 text-center">

                          </div>
                          <div class="col-md-8">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="<?php echo "ID" . $fila->id . "EVAL" . $fila->idEvaluacion . "NP" . $fila->num_pregunta . ";" ?>" id="radio1" value="verdadero">
                              <label class="form-check-label" for="exampleRadios1">
                                Verdadero
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="<?php echo "ID" . $fila->id . "EVAL" . $fila->idEvaluacion . "NP" . $fila->num_pregunta . ";" ?>" id="radio2" value="falso">
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
  
                        ?>


                      <?php
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

                </div>
                </div>

                </div> <!-- Termina el Div del contenido de enmedio-->

    </div>
  </div>
</div>


<div class="espacioAmplio"></div>

<?php include("include/antes-footer.php");?>

<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/footer.php'); ?>