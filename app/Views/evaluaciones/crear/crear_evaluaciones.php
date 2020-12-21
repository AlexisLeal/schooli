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

        <div style="padding-top:10px;padding-right:50px;padding-bottom:10px;padding-left:50px;">





          <?php

          if ($session->has('existe')) {
          ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?php echo $session->get('existe'); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php
            $session->remove('existe');
          }


          if ($session->has('exito')) {
          ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?php
              echo $session->get('exito');
              ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php

            $session->remove('exito');
          }
          ?>


          <a href="<?php echo site_url('/Panel/index'); ?>">Panel</a><br />
          <a href="<?php echo site_url('/Evaluaciones/index'); ?>">Tipos de Evaluaciones </a><br />
          <a href="<?php echo site_url('/Evaluaciones/tipo_evaluacion/1'); ?>">Niveles.</a><br />
          <a href="#">Lecciones.</a><br />
          <!-- validar si hay una variable get de niveles, y colocar, de lo conttarrio
            desabilitar el nelace a Lecciones -->


          Crear una evaluación.
          <form action="<?php echo site_url('Evaluaciones/insertar_evaluacion'); ?>" method="post">
            <script>
              function limpiarNombre() {

                if (document.getElementById("existeNombreEvaluacion")) {

                  document.getElementById("existeNombreEvaluacion").style.display = "none";
                }
              }
            </script>
            <div class="form-group">
              <label for="lblNombreEvaluacion">Nombre de la evaluación.</label>
              <input type="text" class="form-control form-control-sm" name="nombreEvaluacion" id="nombreEvaluación" required="" onkeyup="limpiarNombre()">
            </div>

            <?php
            if (isset($existeNombre)) {
            ?>
              <div class="alert alert-danger" role="alert" id="existeNombreEvaluacion">El nombre ya existe.</div>
            <?php
            }
            ?>

            <div class="form-group">
              <label for="lblInstrucciones">Instrucciones</label>
              <textarea class="form-control form-control-sm" name="instrucciones" id="instrucciones" rows="3" required=""></textarea>
            </div>





            <div class="form-group">
              <label for="lblTipoEvaluacion">Tipo de evaluación</label>
              <select class="form-control form-control-sm" name="tipoEvaluacion" id="tipoEvaluacion" required="">
                <option value="">Seleccione una opción</option>
                <?php
                // Esta funcion se encuentra en la carpeta helpers en el archivo llamado operaciones
                foreach (getTipoEvaluacion() as $fila) {
                ?>
                  <option value="<?php echo $fila->id; ?>"> <?php echo $fila->nombre; ?> </option>

                <?php }
                ?>
              </select>
            </div>



            <div class="form-group">
              <label for="lblCategoriaEvaluacion">Categoría de evaluación</label>
              <select class="form-control form-control-sm" name="categoriaEvaluacion" id="categoriaEvaluacion" required="">
                <option value="">Seleccione una opción</option>
                <?php
                // Esta funcion se encuentra en la carpeta helpers en el archivo llamado operaciones
                foreach (getCategoriaEvaluacion() as $fila) {
                ?>
                  <option value="<?php echo $fila->id; ?>"> <?php echo $fila->nombre; ?> </option>

                <?php }
                ?>
              </select>
            </div>





            <div class="form-group">
              <label for="lblNivel">Nivel</label>
              <select class="form-control form-control-sm" name="nivel" id="nivel" required="">
                <option value="">Seleccione una opción</option>
                <?php
                foreach (getNivel() as $fila) {

                ?>
                  <option value="<?php echo $fila->id; ?>"> <?php echo $fila->nombre; ?> </option>

                <?php }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="lblLeccion">Lección</label>
              <select class="form-control form-control-sm" name="leccion" id="leccion" required="">
                <option value="">Seleccione una opción</option>
                <?php
                foreach (getleccion() as $fila) {

                ?>
                  <option value="<?php echo $fila->id; ?>"> <?php echo $fila->nombre; ?> </option>

                <?php }
                ?>
              </select>
            </div>




            <div class="form-group">
              <label for="lblEstado">Estado</label>
              <select class="form-control form-control-sm" name="estado" id="estado" required="">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
            <input id="idUsuario" name="idUsuario" type="hidden" value="<?php echo $session->get('id') ?>">
            <button type="submit" name="crearEvaluacion" class="btn btn-primary btn-sm">Guardar</button>
          </form>

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