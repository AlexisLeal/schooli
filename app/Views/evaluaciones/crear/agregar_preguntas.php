
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


<?php include(APPPATH.'/Views/include/header-js.php');?>
<script src="<?php echo base_url('js/Preguntas-Validacion.js'); ?>"></script>
<?php include(APPPATH.'Views/include/footer.php');?>