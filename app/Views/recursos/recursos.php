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
            }
            ?>
            <div class="espacioUno"></div>
            <form action="<?php echo site_url('Recursos/agregarRecurso'); ?>" method="post" enctype="multipart/form-data">
            
            Tipo de recurso:
              <select class="form-control form-control-sm" name="tipoRecurso" onchange="eleccion();" id="tipoRecurso" required>
                <option value="">Seleccione una opción</option>
                <?php foreach(getTipoRecursos() as $fila){?>
                      <option value="<?php echo $fila->id;?>"><?php echo $fila->nombre ?></option>
                     
                      <?php }?>
               
              </select>
              <div class="espacioUno"></div>

            
            <style>
            #contenidoTipoRecurso {
              display:none;
              padding:20px 5px 20px 20px;
            }
            #contenidoTipoRecursoFormulario {
              display:none;
              padding:20px 5px 20px 20px;
            }
            </style>
              <div class="form-group">
                <div id="cargar_recurso_archivo">
                  
                  <div id="contenidoTipoRecurso">
                    Cargar un archivo:<br />
                    <input class="form-control form-control-sm" type="file" id="recurso_archivo" name="recurso_archivo">
                  </div>


                  
                  <div id="contenidoTipoRecursoFormulario">
                  <h3>Formulario</h3><br />
                  Tipo de Formulario:
                  
                  <select class="form-control form-control-sm" name="tipoFormulario" id="tipoFormulario">
                    <option value="">Seleccione una opción</option>
                    <?php foreach(getTipoFormularioRecursos() as $fila){?>
                      <option value="<?php echo $fila->id;?>"><?php echo $fila->nombre ?></option>
                     
                      <?php }?>
                  </select>

                  Tipo de applicacion:
                  <select class="form-control form-control-sm" name="tipocategoriaevaluacion" id="tipocategoriaevaluacion">
                    <option value="">Seleccione una opción</option>
                    <?php foreach(getCategoriaEvaluacionRecursos() as $fila){?>
                      <option value="<?php echo $fila->id;?>"><?php echo $fila->nombre ?></option>
                     
                      <?php }?>
                  </select>
                  


                  <div class="form-group">
                    <label for="lblNombreEvaluacion">Nombre de la evaluación.</label>
                    <input type="text" class="form-control form-control-sm" name="nombreEvaluacion" id="nombreEvaluacion">
                  </div>




                  </div>
                  <br/>
                  <div class="espacioUno"></div>
                  
                  
                  
                  
                  Curso
                  <select class="form-control form-control-sm" name="curso" id="curso" required>
                    <option value="">Seleccione una opción</option>
                    <?php foreach (CatalagoGetCursos() as $fila) { ?>
                      <option value="<?php echo $fila->id; ?>"><?php echo $fila->nombre; ?></option>
                    <?php } ?>
                  </select>



                  <div class="espacioUno"></div>
                  Asignar al la siguiente nivel:
                  <select class="form-control form-control-sm" name="nivel" id="nivel" required>
                    <option value="">Seleccione una opción</option>
                  </select>
                  <div class="espacioUno"></div>
                  Asignar a la siguiente sesión
                  <select class="form-control form-control-sm" name="sesion" id="sesion" required>
                  <option value="">Seleccione una opción</option>
                  </select>

                  <div class="espacioUno"></div>
                  <div class="form-group">
                    <label for="lblEstado">Estado</label>
                    <select class="form-control form-control-sm" name="estado" id="estado" required>
                      <option value="1">Activo</option>
                      <option value="0">Inactivo</option>
                    </select>
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





      </div> <!-- Termina el Div del contenido de enmedio-->




    </div>
  </div>
</div>


<div class="espacioAmplio"></div>

<?php include("include/antes-footer.php");?>

<div class="espacioAmplio"></div>


<?php include(APPPATH . '/Views/include/header-js.php'); ?>
<script src="<?php echo base_url('js/Recursos-Validacion.js'); ?>"></script>
<?php include(APPPATH . 'Views/include/footer.php'); ?>

<script>
$('#curso').change(function(){
 var Id_Curso = document.getElementById('curso').value;
 if(Id_Curso != ''){

  ObtenerTodosNivelesPorCurso(Id_Curso);
  ObtenerTodasSesionesPorCurso(Id_Curso);

  }
});


function ObtenerTodosNivelesPorCurso(Id_Curso){
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('Recursos/AjaxNiveles'); ?>",
    data: {Id_Curso},
    success: function(text) {
      document.getElementById("nivel").innerHTML = "";
      $('#nivel').append(text);

    }
    });

}

function ObtenerTodasSesionesPorCurso(Id_Curso){
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('Recursos/AjaxSesiones'); ?>",
    data: {Id_Curso},
    success: function(text) {
      document.getElementById("sesion").innerHTML = "";
      $('#sesion').append(text);

    }
    });
}
</script>
