

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/script" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Plataforma de evaluaciones INBI</title>
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
        <a class="nav-link" href=""a>
      </li>
    </ul>

  </div>
</nav>
    </div>
    <div class="col-md-4 text-right"> Hola <i class="fa fa-sign-out" aria-hidden="true"></i> </a></div>
  </div>
  <!--<div class="row">
    <div class="col-md-6">.col-md-6</div>
    <div class="col-md-6">.col-md-6</div>
  </div>-->
</div>
  </header>
     



<?php
// Este contenido se mostrar si el tipo de usuario registrado es un editor
//if($_SESSION["xyz"][0]==2){
?>
      <div class="container">
        <div class="row">
          <div class="col-md-12">



<a href="panel.php">Panel.</a><br/>
<a href="evaluaciones.php">Evaluaciones.</a><br/>

<table width="80%">
<tr><th cols="2"><h1 class="font-weight-bold">Evaluación.<h1></th></tr>
<tr><td><p class="font-weight-bold">Nombre de evaluacion:</p></td><td><?php echo $nombre;?></td></tr>
<tr><td><p class="font-weight-bold">Tipo Evaluacion:</p></td><td><?php echo $tipo_evaluacion;?></td></tr>
<tr><td><p class="font-weight-bold">Clave de evaluación:</p></td><td><?php echo $clave;?></td></tr>
<tr><td><p class="font-weight-bold">Valor total.</p></td><td><?php echo $valorpreguntas;?></td></tr>
</table>

  <div class="row">
    <div class="col-md-2 text-center">
    <p class="font-weight-bold">No.</p>
    </div>
    <div class="col-md-8">
    <p class="font-weight-bold">Pregunta</p>
    </div>
    <div class="col-md-2 text-center">
    <p class="font-weight-bold">Valor</p>
    </div>        
  </div>
<?php
foreach(getPreguntas($idEvaluacion) as $fila){

?>
<div class="row">
    <div class="col-md-2 text-center">
    <?=$regPreg['num_pregunta'];?>
    </div>
    <div class="col-md-8">




    <?php
    if($fila->tiene_imagen==1 || $fila->tiene_audio_pregunta==1){
        if($fila->tiene_imagen==1){
          ?>
          <img src="<?=$fila->ruta_imagen;?>" class = "img-fluid" alt="INBI" ><br/>
          <?php
        }

        if($fila->tiene_audio_pregunt==1){
          ?>
          <audio class="asado" name="" id ="" src="<?=$fila->ruta_audio_pregunta;?>" controls></audio><br/>
          <?php
        }

    }else{
         echo $fila->pregunta;
    }
    ?>
    

    </div>
    <div class="col-md-2 text-center">
    <?=$fila->valor;?>
    </div>
</div>
<?php
$idPregunta = $fila->id;
switch ($fila->idTipoPregunta){
case 1: // Pregunta abierta
  ?>
  <div class="row">
    <div class="col-md-2 text-center">
    
    </div>
    <div class="col-md-8">
    <input type="text" class="form-control" name="<?php echo "ID".$regPreg['id']."_EVAL".$regPreg['idEvaluacion']."_NP".$regPreg['num_pregunta'].""?>"
    id="<?php echo "ID".$regPreg['id']."EVAL".$regPreg['idEvaluacion']."NP".$regPreg['num_pregunta'].""?>">
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
    $sqlOM = "select idEvaluacion,idPregunta,valor1,valor2,valor3,valor4 from pregunta_opcion_multiple where idEvaluacion=$k and idPregunta=$idPregunta";
    
    if (!$resOM = $conn->query($sqlOM)) {
      echo "Lo sentimos, este sitio web está experimentando problemas.";
      exit;
    }
    $rOM  = $resOM->fetch_assoc();
    ?>
    <table>
      <tr>
      <td><?=$rOM['valor1'];?> <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2"></td>
      <td><?=$rOM['valor2'];?> <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2"></td>
      <td><?=$rOM['valor3'];?> <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2"></td>
      <td><?=$rOM['valor4'];?> <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2"></td>
    </tr>
  </table>
    
    
    
    
    <?php
    
    
    ?>
    </div>
    <div class="col-md-2 text-center">
    
    </div>
  </div>
<?php
    break;

case 3://audio
  ?>
  <div class="row">
    <div class="col-md-2 text-center">
    
    </div>
    <div class="col-md-8">
    <?PHP
    $sqlAudio = "select idEvaluacion,idPregunta,nombre_audio,ruta_audio from pregunta_opcion_audio where idEvaluacion=$k and idPregunta=$idPregunta";
    
    if (!$resAudio = $conn->query($sqlAudio)) {
      echo "Lo sentimos, este sitio web está experimentando problemas.";
      exit;
    }

   $rAudio  = $resAudio->fetch_assoc();
    ?>
<audio class="asado" name="" id ="" src="<?=$rAudio['ruta_audio'];?>" controls></audio>

<textarea class="form-control" name="<?php echo "ID".$regPreg['id']."EVAL".$regPreg['idEvaluacion']."NP".$regPreg['num_pregunta'].";"?>" id="<?php echo "ID".$regPreg['id']."EVAL".$regPreg['idEvaluacion']."NP".$regPreg['num_pregunta'].";"?>" rows="3"></textarea>
        
   
    

    </div>
    <div class="col-md-2 text-center">
    
    </div>
  </div>
<?php
    break;

case 4:// video
  ?>
  <div class="row">
    <div class="col-md-2 text-center">

    </div>
    <div class="col-md-8">
    <?PHP
    $sqlVideo = "select idEvaluacion,idPregunta,nombre_video,ruta_video from pregunta_opcion_video where idEvaluacion=$k and idPregunta=$idPregunta";
    
    if (!$resVideo = $conn->query($sqlVideo)) {
      echo "Lo sentimos, este sitio web está experimentando problemas.";
      exit;
    }
    $rVideo  = $resVideo->fetch_assoc();
    ?>
      <video name="" id="" src="<?=$rVideo['ruta_video'];?>" controls>
        Tu navegador no implementa el elemento <code>video</code>.
      </video>
<textarea class="form-control" name="<?php echo "ID".$regPreg['id']."EVAL".$regPreg['idEvaluacion']."NP".$regPreg['num_pregunta'].";"?>" id="<?php echo "ID".$regPreg['id']."EVAL".$regPreg['idEvaluacion']."NP".$regPreg['num_pregunta'].";"?>" rows="3"></textarea>

</div>
    <div class="col-md-2 text-center">

    </div>
  </div>
<?php
    break;

case 5:// falso o verdadero
  ?>
  <div class="row">
    <div class="col-md-2 text-center">

    </div>
    <div class="col-md-8">
    <div class="form-check">
        <input class="form-check-input" type="radio" name="<?php echo "ID".$regPreg['id']."EVAL".$regPreg['idEvaluacion']."NP".$regPreg['num_pregunta'].";"?>" id="radio1" value="verdadero">
        <label class="form-check-label" for="exampleRadios1">
        Verdadero
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="<?php echo "ID".$regPreg['id']."EVAL".$regPreg['idEvaluacion']."NP".$regPreg['num_pregunta'].";"?>" id="radio2" value="falso">
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
}
?>
<?php
$inc++;
}
?>
  
          </div>
        </div>  
      </div>

<?php
  //}
?>
<br/>
<br/>
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

<br/>
<br/>
    <script src="js/jquery/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>

    

</body>
</html>