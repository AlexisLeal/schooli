
<?php include(APPPATH.'/Views/include/header.php');?>


<style>

</style>
  </head>
  <body>



<header>
<div class="container">
  <div class="row">
    <div class="col-md-4"><img class="mb-4" src="img/logo-nueva-version.jpg" alt="" width="112" height="112"></div>
    <div class="col-md-4">
    
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="">
      </li>
    </ul>

  </div>
</nav>
    </div>
    <div class="col-md-4 text-right"> Hola <?php echo $session->get('nombre')?> <?php echo $session->get('apellido')?>  <a href="<?php echo site_url('/Home/salir'); ?>"> Salir  <i class="fa fa-sign-out" aria-hidden="true"></i> </a></div>
  </div>
  <!--<div class="row">
    <div class="col-md-6">.col-md-6</div>
    <div class="col-md-6">.col-md-6</div>
  </div>-->
</div>
  </header>
     


  <div class="container">
  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
<?php
// Este contenido se mostrar si el tipo de usuario registrado es un editor
// no funciona para editores solo para administrador 
// if($_SESSION["xyz"][0]==2){ // es un editor por eso puede crear las preguntas de la evaluación.

?>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <a href="panel.php">Panel.</a><br/>
          <a href="evaluaciones.php">Evaluaciones.</a><br/>

            Crear preguntas de la evaluacion.<br/>
            <br/>
          
  <table width="90%">
  <tr>
  <th></th>
  </tr>
  <tr><td><p class="font-weight-bold">Nombre:</p></td><td><?php echo $nombre;?></td><td><p class="font-weight-bold">Preguntas Actuales:</p></td><td><?php echo $totalpreguntas;?></td></tr>
  <tr><td><p class="font-weight-bold">Tipo de evaluación:</p></td><td><?php echo $tipo_evaluacion;?></td><td><p class="font-weight-bold">Valor total:</p></td><td><?php echo empty($valorpreguntas) ? 0 : $valorpreguntas;?></td></tr>
  <tr><td><p class="font-weight-bold">Creado por:</p></td><td><?php echo $usuario_creo;?></td><td>Clave de evaluacion:</td><td><?php echo $clave;?></td></tr>
  <tr><td><p class="font-weight-bold">Estado:</p></td><td><?php echo $estado?></td><td></td><td></td></tr>
  </table>

          </div>
        </div>  
      </div>

<?php
  //}
?>

    </div>
    <div class="col-md-2">
    </div>
  </div>
  </div>


<div class="container">
  <div class="row">
    <div class="col-md-2">
    
    </div>
    <div class="col-md-8">
    <form action="insertar-pregunta.php" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="idEvaluacion" id="idEvaluacion" value="idEvaluacion;?>">
    <input type="hidden" class="form-control" name="clave" id="clave" value="clave;?>">
    <input type="hidden" class="form-control" name="num_pregunta" id="num_pregunta" value="<num_pregunta;?>">
    <div class="form-group">
      <label for="lblPregunta">Pregunta</label>
      <input type="text" class="form-control" name="pregunta" id="pregunta" placeholder="" required="">
    </div>

    <!--
      poner un checkbos y cuando lo seleccionenen que se habilite una caja para poner un upload y cargar una imagen.
    -->

    <div class="form-group">
      <div class="form-check">
      <input type="checkbox" class="form-check-input" name="activarCargarImagen" id="activarCargarImagen">
      <label class="form-check-label" for="exampleCheck1">Subir una imagen.</label>
      </div>
    </div>
    
    <div id="agregarImagen">

    </div>


    <div class="form-group">
      <div class="form-check">
      <input type="checkbox" class="form-check-input" name="activarCargarAudioPregunta" id="activarCargarAudioPregunta" onclick="cargarAudioPreguntaJS()">
      <label class="form-check-label" for="exampleCheck1">Subir un audio.</label>
      </div>
    </div>
    
    <div id="agregarAudioPregunta">

    </div>

    <br/><br/>
    <div class="form-group">
      <label for="lblValorPregunta">Valor</label>
      <input type="text" class="form-control" name="valor" id="valor" placeholder="" required="">
    </div>

      <!-- Inicia funciones Java Script, para mostrar contenido dependiendo de el tipo de pregunta  -->

      <!-- Termina funciones Java Script -->
      
      <div class="form-group">
        <label for="exampleFormControlSelect1">Tipo de pregunta</label>
        <select class="form-control" name="tipoPregunta" id="tipoPregunta" onchange="tPregunta()" required="">
        <option value="">Selecciona una opcion</option>
        <?php
       foreach(getTipoPreguntas() as $fila){
        ?>
        <option value="<?php echo $fila->id; ?>"><?php echo $fila->nombre;?></option>
        <?php
        }
        ?>
        </select>
      </div>


      <div id="agregarCampos" class="form-group">
      <!-- Aqui vamos a poner los campos generados dependiendo de lo que elija el usuario -->
      </div>

      <div class="form-group">
      <button type="submit" name="registrarPregunta" class="btn btn-primary">Guardar</button>
      </div>

      </form>
      </div>
      <div class="col-md-2">
      
    </div>
  </div>
</div>

<!--Esta linea sera temporal-->

    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
<<<<<<< Updated upstream
=======
    <script>
  
//var lista = document.getElementById("tipoPregunta");
//var valorSeleccionado = lista.options[lista.selectedIndex].value;
//var textoSeleccionado = lista.options[lista.selectedIndex].text;
// Ya tenemos el valor seleccionado, ahora vamos a mostrar los input necesarios.


// Validacion para habialitar un upload y cargar una imagen.
$("#activarCargarAudioPregunta" ).click(function() {
  // detectar si esta seleccionado o deseleccionado
  let elemento = document.getElementById("activarCargarAudioPregunta");
  // si esta cheked
  if( elemento.checked ) {
    $('#agregarAudioPregunta').append('<div class="form-group">\
          Cargar imagen <input class="form-control" type="file" id="archivo_audio_pregunta" onclick="test()" name="archivo_audio_pregunta" required="">\
          </div>');    
  }else{
    document.getElementById("agregarAudioPregunta").innerHTML = "";
  }
});

function test(){
  alert ("Despues de cargar un archivo");
}


// Validacion para habialitar un upload y cargar una imagen.
$("#activarCargarImagen" ).click(function() {
  // detectar si esta seleccionado o deseleccionado
  let elemento = document.getElementById("activarCargarImagen");
  // si esta cheked
  if( elemento.checked ) {
    $('#agregarImagen').append('<div class="form-group">\
          Cargar imagen <input class="form-control" type="file" id="archivo_imagen" name="archivo_imagen" required="">\
          </div>');    
  }else{
    document.getElementById("agregarImagen").innerHTML = "";
  }
});




// Comienza la logica para agregar los diferentes tipos de campos
$("#tipoPregunta").on ('change', function(e) {
var valor        = $(this).val();
var idEvaluacion = 1;
function removerDiv(){
$agregarCampos.parent('div').remove();
}
switch(valor) {
case "1":
document.getElementById("agregarCampos").innerHTML = "";
break;
case "2":
// Pregunta opcion multiple
  var numCampos = 5;
  var i=1;      
  document.getElementById("agregarCampos").innerHTML = "";
  if(document.querySelector('#agregarCampos').childElementCount < 1){ 
  while (i < numCampos) {
    var nombreCampo = idEvaluacion + '-' + valor + '-' + i;  
    $('#agregarCampos').append('<div class="form-group mb-2">\
          Opcion '+ i +' <input class="form-control" type="text" id="opcion_'+i+'" name="opcion_'+i+'" required="">\
          </div>\
          <div class="form-group mb-2">\
          <input class="form-check-input" type="radio" name="opcion_correcta" id="'+i+'" value="'+i+'">\
          <label class="form-check-label" for="exampleRadios1">\
          Opción correcta <br/><br/><br/>\
          </label>\
          </div>\
          ');
      i++;
    }
  }
break;
case "3":
// Audio
document.getElementById("agregarCampos").innerHTML = "";
if(document.querySelector('#agregarCampos').childElementCount < 1){ 
var nombreCampo = idEvaluacion + '-' + valor;
$('#agregarCampos').append('<div class="form-group">\
          Cargar audio <input class="form-control" type="file" id="archivo_audio" name="archivo_audio" required="">\
          </div>');
}    
break;
case "4":
// Video
document.getElementById("agregarCampos").innerHTML = "";
if(document.querySelector('#agregarCampos').childElementCount < 1){ 
var nombreCampo = idEvaluacion + '-' + valor;
$('#agregarCampos').append('<div class="form-group">\
          Cargar video <input  class="form-control" type="file" id="archivo_video" name="archivo_video" required="">\
          </div>');
}
break;
case "5":
// Falso o Verdadero
document.getElementById("agregarCampos").innerHTML = "";
break;
}

});

</script>
>>>>>>> Stashed changes


<?php include(APPPATH.'/Views/include/header-js.php');?>
<script src="<?php echo base_url('js/Preguntas-Validacion.js'); ?>"></script>
<?php include(APPPATH.'Views/include/footer.php');?>