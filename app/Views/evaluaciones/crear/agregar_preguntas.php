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




        <a href="#">Panel.</a><br />
        <a href="#">Evaluaciones.</a><br />

        <h4>Crear preguntas de la evaluacion.</h4>


        <table width="90%">
          <tr>
            <th></th>
          </tr>
          <tr>
            <td>
              <p class="font-weight-bold">Nombre:</p>
            </td>
            <td><?php echo $nombre; ?></td>
            <td>
              <p class="font-weight-bold">Preguntas Actuales:</p>
            </td>
            <td><?php echo $totalpreguntas; ?></td>
          </tr>
          <tr>
            <td>
              <p class="font-weight-bold">Tipo de evaluación:</p>
            </td>
            <td><?php echo $tipo_evaluacion; ?></td>
            <td>
              <p class="font-weight-bold">Valor total:</p>
            </td>
            <td><?php echo empty($valorpreguntas) ? 0 : $valorpreguntas; ?></td>
          </tr>
          <tr>
            <td>
              <p class="font-weight-bold">Creado por:</p>
            </td>
            <td><?php echo $usuario_creo; ?></td>
            <td>Clave de evaluacion:</td>
            <td><?php echo $clave; ?></td>
          </tr>
          <tr>
            <td>
         
            </td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>
              <p class="font-weight-bold">idevaluacion:</p>
            </td>
            <td><?php echo $idEvaluacion; ?></td>
            <td></td>
            <td></td>
          </tr>
        </table>

        <div style="padding-top:10px;padding-right:50px;padding-bottom:10px;padding-left:50px;">

          <form action="<?php echo site_url('Preguntas/insertarPregunta'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="idEvaluacion" id="idEvaluacion" value="<?php echo $idEvaluacion; ?>">
            <input type="hidden" class="form-control" name="clave" id="clave" value="<?php echo $clave; ?>">
            <input type="hidden" class="form-control" name="valorpreguntas" id="valorpreguntas" value="<?php echo empty($valorpreguntas) ? 0 : $valorpreguntas; ?>">
            <input type="hidden" class="form-control" name="totalPreguntas" id="totalPreguntas" value="<?php echo $totalpreguntas; ?>">

            <div class="form-group">
                  <label for="lblPregunta">Pregunta</label>
                  <input type="text" class="form-control form-control-sm" name="pregunta" id="pregunta" placeholder="">
                </div>

            <div class="form-group">
              <div class="form-check">
                <input type="checkbox" class="form-check-input form-control-sm" name="activarCargarImagen" id="activarCargarImagen">
                <label class="form-check-label" for="exampleCheck1">Subir una imagen.</label>
              </div>
            </div>

            <div id="agregarImagen">

            </div>


            <div class="form-group">
              <div class="form-check">
                <input type="checkbox" class="form-check-input form-control-sm" name="activarCargarAudioPregunta" id="activarCargarAudioPregunta" onclick="cargarAudioPreguntaJS()">
                <label class="form-check-label" for="exampleCheck1">Subir un audio.</label>
              </div>
            </div>

            <div id="agregarAudioPregunta">

            </div>

            <div class="form-group">
              <label for="lblValorPregunta">Valor</label>
              <input type="text" class="form-control form-control-sm" name="valor" id="valor" placeholder="" required="">
            </div>

            <div class="form-group">
              <label for="exampleFormControlSelect1">Tipo de pregunta</label>
              <select class="form-control form-control-sm" name="tipoPregunta" id="tipoPregunta" required="">
                <option value="">Selecciona una opcion</option>
                <?php
                foreach (getTipoPreguntas() as $fila) {
                ?>
                  <option value="<?php echo $fila->id; ?>"><?php echo $fila->nombre; ?></option>
                <?php
                }
                ?>
              </select>
            </div>


            <div id="agregarCampos" class="form-group">

            </div>

            <div class="form-group">
             

              <table width="100%">
                <tr>
                  <td>
                    <div class="text-center"><button type="submit" name="registrarPregunta" class="btn btn-primary btn-sm">Guardar</button></div>
                  </td>
                  <td>
                    <div class="text-left"><button type="reset" class="btn btn-secondary btn-sm">Limpiar</button> </div>
                  </td>
                <tr>
              </table>
            </div>
          </form>

        </div>
      </div> <!-- Termina col-md-9-->
    </div> <!-- Termina row-->
  </div> <!-- Termina container -->


  <div class="espacioDos"></div>
  <div class="espacioDos"></div>
  <div class="espacioDos"></div>

  <div class="espacioDos"></div>
  <div class="espacioDos"></div>
  <div class="espacioDos"></div>

  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <p class="mt-5 mb-3 text-muted text-center"> © <span class="brain-foot">LMS INBI</span> <?php echo date("Y"); ?></p>
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


  <?php include(APPPATH . '/Views/include/header-js.php'); ?>
  <script src="<?php echo base_url('js/Preguntas-Validacion.js'); ?>"></script>
  <?php include(APPPATH . 'Views/include/footer.php'); ?>