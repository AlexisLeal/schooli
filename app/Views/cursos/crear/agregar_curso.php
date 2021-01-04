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


        <?php if ($session->has('Curso')) {; ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Notificaciones del sistema:</strong> <?php echo $session->get('Curso') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php }
        $session->remove('Curso'); ?>




        <h4>Registrar curso.</h4>
        <div class="espacioUno"></div>




        <div class="card">
          <div class="card-body">

            <form action="<?php echo site_url('Cursos/insertarcurso'); ?>" method="post" enctype="multipart/form-data">

              <div class="espacioDos"></div>
              <div class="row">
                <div class="col">
                  Nombre
                  <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" required="">
                </div>
                <div class="col">
                  Estatus
                  <select class="form-control form-control-sm" name="estatus" id="estatus" required="">
                    <option value="">Seleccione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                </div>
              </div>

              <div class="espacioUno"></div>


              <div class="row">
                <div class="col">
                  Numero de niveles
                  <select class="form-control form-control-sm" name="numero_niveles" id="numero_niveles" required="">
                    <option value="">Selecciona una opción</option>
                    <?php for ($i = 1; $i <= 14; $i++) { ?>
                      <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col">
                  Total de dias laborales
                  <input type="number" name="dias" id="dias" class="form-control form-control-sm" required="" min=1>
                </div>
                <div class="col">
                  Frecuencia
                  <select class="form-control form-control-sm" name="frecuencia" id="frecuencia" required="">
                    <option value="">Selecciona una opción</option>
                    <?php foreach (CatalagoGetAllFrecuencias() as $fila) { ?>
                      <option value="<?php echo $fila->id ?>"><?php echo $fila->nombre ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col">
                  Valor Total de Ejercicios
                  <input type="number" name="valor_total_ejercicios" id="valor_total_ejercicios" class="form-control form-control-sm" required min = 0>
                </div>
                <div class="col">
                  Valor Total de Examenes 
                  <input type="number" name="valor_total_examanes" id="valor_total_examanes" class="form-control form-control-sm" required min = 0>
                </div>
                <div class="col">
                  Valor Total de la asistencia 
                  <input type="number" name="valor_total_asistencia" id="valor_total_asistencia" class="form-control form-control-sm" required min=0>
                </div>
                <div class="col">
                  Total de puntos 
                  <input type="number" name="valor_total" id="valor_total" class="form-control form-control-sm" required max = 100 disabled>
                </div>
                <div class="col">
                  Numero de ejericios
                  <input type="number" name="num_ejercicios" id="num_ejercicios" class="form-control form-control-sm" required min=0>
                </div>
                <div class="col">
                  Numero de examenes
                  <input type="number" name="num_examenes" id="num_examenes" class="form-control form-control-sm" required min=0>
                </div>
              </div>


              <div class="espacioUno"></div>

              <div class="espacioUno"></div>

              <div class="espacioUno"></div>

              <div class="espacioUno"></div>

              <div class="form-group">
                <label for="lblInstrucciones">Descripción</label>
                <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" rows="3" required=""></textarea>
              </div>

              <div class="espacioUno"></div>
              <button type="reset" class="btn btn-primary btn-sm">Limpiar</button>

              <button type="submit" name="submitCR" class="btn btn-primary btn-sm">Registrar</button>
            </form>

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
<?php include(APPPATH . 'Views/include/header-js.php'); ?>

<script>
$('#valor_total_ejercicios').keyup(function(){
  ValidacionCamposPonderacionyTotalPuntos();
  
});

$('#valor_total_examanes').keyup(function(){
  ValidacionCamposPonderacionyTotalPuntos();

 
});
$('#valor_total_asistencia').keyup(function(){
  ValidacionCamposPonderacionyTotalPuntos();

});


function ObtenerTotalPuntos(valor1,valor2,valor3){

return valor1+valor2+valor3;
}

function ValidacionCamposPonderacionyTotalPuntos(){
  if(document.getElementById('valor_total_ejercicios').value == ""){
    var ValorTotalEjercicios = 0;

  }else{
    var ValorTotalEjercicios = parseInt(document.getElementById('valor_total_ejercicios').value);

  }

  if(document.getElementById('valor_total_examanes').value == ""){
    var ValorTotalExamanes = 0;

  }else{
    var ValorTotalExamanes = parseInt(document.getElementById('valor_total_examanes').value);

  }
  if(document.getElementById('valor_total_asistencia').value == ""){
    var ValorTotalAsistencia = 0;

  }else{
    var ValorTotalAsistencia = parseInt(document.getElementById('valor_total_asistencia').value);

  }
  document.getElementById('valor_total').value = ObtenerTotalPuntos(ValorTotalEjercicios,ValorTotalExamanes,ValorTotalAsistencia);
}




</script>