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



        <h4>Recursos</h4>
        <div class="espacioUno"></div>
        <div class="row">
          <div class="col-md-6">
            <?php
            if ($session->has('mensaje-recurso')) {
            ?>
              <div class="alert <?php echo $session->get('tipo-mensaje'); ?> alert-dismissible fade show" role="alert">
                <?php echo $session->get('mensaje-recurso'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
              $session->remove('mensaje-recurso');
              $session->remove('mensaje-mensaje');
            }
            ?>
            <div class="espacioUno"></div>
            Cargar un archivo:<br />
            <form action="<?php echo site_url('Recursos/agregarRecurso'); ?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <div id="cargar_recurso_archivo">
                  <input class="form-control form-control-sm" type="file" id="recurso_archivo" name="recurso_archivo" required="">
                  <div class="espacioUno"></div>
                  curso
                  <select class="form-control form-control-sm" name="curso" id="curso" required="">
                    <option value="">Seleccione una opción</option>
                    <?php foreach (CatalagoGetCursos() as $fila) { ?>
                      <option value="<?php echo $fila->id; ?>"><?php echo $fila->nombre; ?></option>
                    <?php } ?>
                  </select>
                  <div class="espacioUno"></div>
                  Nivel
                  <select class="form-control form-control-sm" name="nivel" id="nivel" required="">
                    <option value="">Seleccione una opción</option>
                    <?php foreach (getNivel() as $fila) { ?>
                      <option value="<?php echo $fila->id; ?>"><?php echo $fila->nombre; ?></option>
                    <?php } ?>
                  </select>
                  <div class="espacioUno"></div>
                  Leccion
                  <select class="form-control form-control-sm" name="leccion" id="leccion" required="">
                    <option value="">Seleccione una opción</option>
                    <?php foreach (getleccion() as $fila) { ?>
                      <option value="<?php echo $fila->id; ?>"><?php echo $fila->nombre; ?></option>
                    <?php } ?>
                  </select>

                  <div class="espacioUno"></div>
                  <div class="form-group">
                    <label for="lblInstrucciones">Instrucciones</label>
                    <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" rows="3" required=""></textarea>
                  </div>
                  <button type="submit" name="registrarRecurso" class="btn btn-primary btn-sm">Subir</button>
                </div>
              </div>
            </form>
            <div class="espacioUno"></div>
          </div>
          <div class="col-md-6">

          </div>
        </div>

        Listado de recursos
        <div class="espacioUno"></div>

        <div class="card">
          <div class="card-body">

            <table class="tabla-registros" width="100%" cellspacing="6" cellpadding="8">
              <thead>
                <tr>
                  <th>
                    <p class="font-weight-bold text-center">ID</p>
                  </th>
                  <th>
                    <p class="font-weight-bold text-center">Nombre:</p>
                  </th>
                  <th>
                    <p class="font-weight-bold text-center">Extension:</p>
                  </th>
                  <th>
                    <p class="font-weight-bold text-center">Tipo de archivo.</p>
                  </th>
                  <th>
                    <p class="font-weight-bold text-center">Descripcion:</p>
                  </th>
                </tr>
              </thead>
              <?php
              foreach (getRecursos() as $fila) {
              ?>
                <tr>
                  <td class="text-left"><?php echo $fila->id; ?></td>
                  <td class="text-left"><?php echo $fila->nombre; ?></td>
                  <td class="text-left"><?php echo $fila->extencion; ?></td>
                  <td class="text-left"><?php echo $fila->tipo_archivo; ?></td>
                  <td class="text-left"><?php echo $fila->descripcion; ?></td>
                </tr>
              <?php
              }
              ?>
            </table>
          </div>
        </div>



      </div> <!-- Termina el Div del contenido de enmedio-->




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

<?php include(APPPATH . '/Views/include/header-js.php'); ?>
<script src="<?php echo base_url('js/Recursos-Validacion.js'); ?>"></script>
<?php include(APPPATH . 'Views/include/footer.php'); ?>