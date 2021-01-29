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

<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>



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
        <div class="espacioUno"></div>
        <table>
        <tr>
          <td><a href="<?php echo site_url('/Cursos/index'); ?>" ><i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i></a></td>
          <td><a href="<?php echo site_url('/Cursos/index'); ?>" >  Atras</a></td>
        </tr>
        </table>  
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
              <br/>
                <div class="col">
                <br/>
                Numero de semanas
                  <input type="number" id="NumeroSemanas" class="form-control form-control-sm" min = "1" value="0" require>
                  </div>
                
                  <div class="col">
                  <br/>
                  Número de ejericios
                  <input type="number" name="num_ejercicios" id="num_ejercicios" class="form-control form-control-sm" required min="1">
                </div>
              </div>

              <div class="espacioUno"></div>


              <div class="row">
                <div class="col">
                <br/>
                  Numero de niveles
                  <select class="form-control form-control-sm" name="numero_niveles" id="numero_niveles" required="">
                    <option value="">Selecciona una opción</option>
                    <?php for ($i = 1; $i <= 14; $i++) { ?>
                      <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col">
                <br/>
                  Sesiones
                  <input type="text" name="dias" id="dias" class="form-control form-control-sm" onkeydown="return false" value="0" required>
                </div>
              </div>


              <div class="row">
                <div class="col">
                <br/>
                  Frecuencia
                  <select class="form-control form-control-sm" name="frecuencia" id="frecuencia" required="">
                    <option value="">Selecciona una opción</option>
                    <?php foreach (CatalagoGetAllFrecuencias() as $fila) { ?>
                      <option value="<?php echo $fila->id ?>"><?php echo $fila->nombre ?></option>
                    <?php } ?>
                  </select>
                  <br/>
                  </div>
                  <div class="col">
                  <br/>
                  Dias de Frencuencia
                  <input type="text"  id="diasdeFrecuencia" class="form-control form-control-sm" readonly>
                </div>
              </div>




              <div class="row">
                <div class="col">
                <br/>
                  Valor total ejercicios
                  <input type="number" name="valor_total_ejercicios" onblur="validaMonto('valor_total_ejercicios');" id="valor_total_ejercicios" class="form-control form-control-sm" required min = "0">
                </div>
                <div class="col">
                <br/>
                  Valor total examenes 
                  <input type="number" name="valor_total_examanes" onblur="validaMonto('valor_total_examanes');" id="valor_total_examanes" class="form-control form-control-sm" required min = "0">
                </div>
              </div>

              <div class="row">
                <div class="col">
                <br/>
                  Valor Total asistencia 
                  <input type="number" name="valor_total_asistencia" onblur="validaMonto('valor_total_asistencia');" id="valor_total_asistencia" class="form-control form-control-sm" required min="0">
                </div>
                <div class="col">
                <br/>
                  Total de puntos 
                  <input type="number" name="valor_total" id="valor_total" class="form-control form-control-sm" onkeydown="return false" max = "100"  min = "100" required>
                  <br/>
                </div>
              </div>
<script>
function validaMonto(id){
  var valor_total_ejercicios = document.getElementById("valor_total_ejercicios").value;
  var valor_total_examanes   = document.getElementById("valor_total_examanes").value;
  var valor_total_asistencia = document.getElementById("valor_total_asistencia").value;
  var total;
  
  var uno = parseInt(valor_total_ejercicios,0)
  var dos = parseInt(valor_total_examanes,0)
  var tres = parseInt(valor_total_asistencia,0);
  //alert(typeof(valor_total_ejercicios));

  total = uno+dos+tres;
  if(total > 100){
    alert("No debe de exceder de 100 puntos" +  total);
    document.getElementById(id).value="";
    document.getElementById("valor_total").value="";
    document.getElementById(id).onfocus;
  }
  
}
</script>


              
              
              <div class="row">
                <div class="col">
                <br/>
                  Número de examenes
                  <input type="number" name="num_examenes" id="num_examenes" class="form-control form-control-sm" required min="1" >
                </div>
                <div class="col">
                </div>
              </div>


              <div class="espacioUno"></div>



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


<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/antes-footer.php'); ?>

<div class="espacioAmplio"></div>

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
$('#NumeroSemanas').keyup(function(){
  var NumeroSesiones = document.getElementById('NumeroSemanas').value;
  var IdFrecuencia = document.getElementById('frecuencia').value;
  if(IdFrecuencia == ''){
    IdFrecuencia = 0;
  }
  if(NumeroSesiones == ''){
    NumeroSesiones = 0;
  }
  ObtenerNumerodeSessiones(NumeroSesiones,IdFrecuencia);
  
});

$('#frecuencia').change(function(){
  var NumeroSesiones = document.getElementById('NumeroSemanas').value;
  var IdFrecuencia = document.getElementById('frecuencia').value;
  if(IdFrecuencia == ''){
    IdFrecuencia = 0;
  }
  if(NumeroSesiones == ''){
    NumeroSesiones = 0;
  }
   ObtenerNumerodeSessiones(NumeroSesiones,IdFrecuencia);
   ObtenerNumerodeDiasdeFrecuencia(IdFrecuencia);

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

function  ObtenerNumerodeSessiones(NumeroSesiones,IdFrecuencia){
  $.ajax({
    type: "POST",
        url: "<?php echo site_url('Cursos/AjaxObtenerNumeroSesiones'); ?>",
        data: {
          NumeroSesiones,
          IdFrecuencia
        },
        success: function(response) {
          document.getElementById('dias').value = parseInt(response);
        }

  });

}

function ValidaciondePuntosdePonderacion(){
  mensaje = "";
  if(this.value > 100 || this.value < 100){
    mensaje = "El total de puntos tiene que ser igual a 100";

  }
  this.setCustomValidity(mensaje);
}

var totalPuntos = document.querySelector("#valor_total");

totalPuntos.addEventListener("invalid", ValidaciondePuntosdePonderacion);
totalPuntos.addEventListener("input", ValidaciondePuntosdePonderacion);

function ObtenerNumerodeDiasdeFrecuencia(IdFrecuencia){
  $.ajax({
    type: "POST",
        url: "<?php echo site_url('Cursos/AjaxObtenerNumerodeDiasdeFrecuencia'); ?>",
        data: {
          IdFrecuencia
        },
        success: function(response) {
          document.getElementById('diasdeFrecuencia').value = parseInt(response);
        }

  });


}


</script>