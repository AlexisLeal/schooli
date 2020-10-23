<?php include(APPPATH.'/Views/include/header.php');?>
<style>
#banner {
  padding-top:5px;
  background: rgb(15,98,172);
background: linear-gradient(90deg, rgba(15,98,172,1) 0%, rgba(23,149,235,1) 50%, rgba(18,106,171,1) 100%);
height:270px;
}
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
      </li>
    </ul>

  </div>
</nav>
    </div>
    <div class="col-md-4 text-right"> Hola <?php echo $session->get('nombre')?> <?php echo $session->get('apellido')?>  <a href="<?php echo site_url('/Home/salir'); ?>"> Salir </a></div>
  </div>
  <!--<div class="row">
    <div class="col-md-6">.col-md-6</div>
    <div class="col-md-6">.col-md-6</div>
  </div>-->
</div>
  </header>
     


    <div id="crear_evaluaciones">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-6">
            <!--Nombre de evaluación
            Si estara Activa
            Quien la esta creando
             unidad inbi-->
            
  <?php
  /*
  if(isset($_POST['crearEvaluacion'])){

    $nombreEvaluacion = $_POST['nombreEvaluacion'];
    $sqlExisteNombre = "select nombre from evaluaciones where nombre like '%".$nombreEvaluacion."%'";
    $resExisteNombre = $conn->query($sqlExisteNombre);
    $numReg = mysqli_num_rows($resExisteNombre);
    if($numReg>0){
      $existeNombre = 1;
    }else{
   
        $instrucciones    = $_POST['instrucciones'];
        $tipoEvaluacion   = $_POST['tipoEvaluacion'];
        $nivel            = $_POST['nivel'];
        $leccion          = $_POST['leccion'];
        $estado           = $_POST['estado'];
        $idUsuario        = $_POST['idUsuario'];
        $hoy              = date("Y-m-d H:i:s");
    
        $sqlInsert = "INSERT INTO evaluaciones(nombre,instrucciones,tipo_evaluacion,nivel,leccion,usuario_creo,usuario_modifico";
        $sqlInsert .= ",estado,fecha_creacion,fecha_ultimo_cambio) values ('".$nombreEvaluacion."',";
        $sqlInsert .= "'".$instrucciones."',$tipoEvaluacion,$nivel,$leccion,$idUsuario,$idUsuario,$estado,'".$hoy."','".$hoy."')";

        if (!$resInsert = $conn->query($sqlInsert)) {
        echo "Lo sentimos, este sitio web está experimentando problemas.";
        exit;
        }else{
        echo "La evaluacion fue registrada con éxito.";
        
        

        // Actualizar la clave  
          $sqlObtenerId   = "select id from evaluaciones where nombre='".$nombreEvaluacion."' and usuario_creo=$idUsuario and fecha_creacion='".$hoy."'";
          $ultimoId       = $conn->query($sqlObtenerId);
          $idObtenido     = $ultimoId->fetch_assoc();
          $idReal         = $idObtenido['id'];

          function RandomString($length=10){
            $source="ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            if($length>0){			
              $rstr = "";
              $source = str_split($source,1);
              for($i=1; $i<=$length; $i++){
                mt_srand((double)microtime() * 1000000);
                $num = mt_rand(1,count($source));
                $rstr .= $source[$num-1];				
              }
            }
            return $rstr;
          }

          $rand = RandomString();
          $hoySinEspacios = str_replace(' ','-HMS',$hoy);
          //$clave="EV".$idReal."-TE".$tipoEvaluacion."-FC".$hoySinEspacios."-UC".$idUsuario."-INBI".$rand;
          
          
          $hoyLimpio        = str_replace(' ','',$hoy);
          $hoyLimpio        = str_replace(':','',$hoyLimpio);
          $hoyLimpio        = str_replace('-','',$hoyLimpio);
          $nombreDirectorio ="EV".$idReal.$hoyLimpio; // este sera el nombre del directorio
          
          $clave            = $nombreDirectorio;

          $sqlUpdate           ="UPDATE evaluaciones set clave = '".$clave."',directorio_uploads='uploads/".$nombreDirectorio."' where id=$idReal";
          $actualizarClave     = $conn->query($sqlUpdate);
          // crear el directorio en donde estara los audios y videos

          if (!file_exists(dirname(__FILE__)."/uploads/".$nombreDirectorio)) {
            if (!mkdir(dirname(__FILE__)."/uploads/".$nombreDirectorio, 0777)){
              echo "no se pudo crear el directorio " . $nombreDirectorio. "<br/>";
              die('mkdir failed...');
            }
        }

        }
      }

  } 
  */
  ?>

<a href="<?php echo site_url('/Panel/index'); ?>">Panel</a><br/>
<a href="<?php echo site_url('/Evaluaciones/index'); ?>">Tipos de Evaluaciones </a><br/>
<a href=""> Niveles </a><br/>
<a href=""> Lecciones </a><br/>

Crear una evaluación.
  <form action="<?php echo site_url('Evaluaciones/insertar_evaluaciion');?>" method="post">
<script>
function limpiarNombre(){

  if(document.getElementById("existeNombreEvaluacion")){
    
    document.getElementById("existeNombreEvaluacion").style.display = "none";
  }
}
</script>  
  <div class="form-group">
    <label for="lblNombreEvaluacion">Nombre de la evaluación.</label>
    <input type="text" class="form-control" name="nombreEvaluacion" id="nombreEvaluación" required="" onkeyup="limpiarNombre()">
  </div>
 
<?php
if(isset($existeNombre)){
?>
  <div class="alert alert-danger" role="alert" id="existeNombreEvaluacion">El nombre ya existe.</div>
<?php
}
?>

  <div class="form-group">
    <label for="lblInstrucciones">Instrucciones</label>
    <textarea class="form-control" name="instrucciones" id="instrucciones" rows="3" required=""></textarea>
  </div>

  <div class="form-group">
    <label for="lblTipoEvaluacion">Tipo de evaluación</label>
    <select class="form-control" name="tipoEvaluacion" id="tipoEvaluacion" required="">
    <option value="">Seleccione una opción</option>
    <?php
            // Esta funcion se encuentra en la carpeta helpers en el archivo llamado operaciones
          $tipo = getTipoEvaluacion();
            foreach($tipo as $fila){
           ?>
              <option value="<?php echo $fila->id;?>"> <?php echo $fila->nombre;?> </option>         
          
        <?php } 
        ?>
    </select>
  </div>





  <div class="form-group">
  <label for="lblNivel">Nivel</label>
    <select class="form-control" name="nivel" id="nivel" required="">
      <option value="">Seleccione una opción</option>
      <?php
          $tipo = getNivel();
            foreach($tipo as $fila){
        
              ?>
              <option value="<?php echo $fila->id;?>"> <?php echo $fila->nombre;?> </option>         
          
        <?php } 
        ?>
    </select>
  </div>
  <div class="form-group">
  <label for="lblLeccion">Lección</label>
    <select class="form-control" name="leccion" id="leccion" required="">
      <option value="">Seleccione una opción</option>
      <?php
          $tipo = getleccion();
            foreach($tipo as $fila){
        
              ?>
              <option value="<?php echo $fila->id;?>"> <?php echo $fila->nombre;?> </option>         
          
        <?php } 
        ?>
    </select>
  </div>




  <div class="form-group">
    <label for="lblEstado">Estado</label>
    <select class="form-control" name="estado" id="estado" required="">
      <option value="1">Activo</option>
      <option value="0">Inactivo</option>
    </select>
  </div>
  <input id="idUsuario" name="idUsuario" type="hidden" value="<?php echo $session->get('id')?>">
  <button type="submit" name="crearEvaluacion" class="btn btn-primary">Guardar</button>
</form>
  
  
          </div>
          <div class="col-md-3">
          
          </div>                    
        </div>  
      </div>
    </div>
 <?php include(APPPATH.'Views/include/footer.php');?>