<?php include(APPPATH.'/Views/include/header.php');?>
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
    <div class="col-md-4 text-right"> Hola <?php echo $session->get('nombre')?> <?php echo $session->get('apellido')?>  <a href="<?php echo site_url('/Home/salir'); ?>"> Salir <i class="fa fa-sign-out" aria-hidden="true"></i> </a></div>
  </div>
</div>
  </header>





     
    <!--Ejemplo tabla con DataTables-->
    <div id="banner">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            
          </div>
        </div>  
      </div>
    </div>


<?php
// aqui se esta obteniendo el valor del id de la tabla de usuarios
// Este contenido se mostrar si el tipo de usuario registrado es un editor
?>
<style>
.float-left {
  float:left;
  padding-right:15px;
  margin-right:15px;

}

.float-left h1 {
  color:#000;
  font-weight:bold;
  text-align:center;

}
.float-left p {
  color:#cdcdcd;
  font-style:italic;
  display:inline;
}

</style>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <div class="table-responsive">
          <?php
          // id_nivel y id_nivel son datos que se pasan desde el contrador llamado lecciones()
          //Se hace asi por que en el contralador iba hacer muchos if par poner un simple nombre 
            $nombreEvaluaciones = getTipoEvaluacionEspecifico($id_evaluaciones);
            $nombreNivel = getnivelEspecifico($id_nivel);
          ?>
          <H1>Tipo de evaluacion: <?php echo $nombreEvaluaciones->nombre ?></H1>
          <H2>Nivel: <?php echo $nombreNivel->nombre ?></H2>






          <a href="<?php echo site_url('/Panel/index'); ?>">Panel</a><br/>
          <a href="<?php echo site_url('/Evaluaciones/crear_evaluacion'); ?>">Crear evaluaciones.</a><br/>
          <a href="<?php echo site_url('/Evaluaciones/index'); ?>">Tipo Evaluaciones </a> <br>
          <a href="<?php echo site_url("/Evaluaciones/tipo_evaluacion/$nombreEvaluaciones->id"); ?>">Niveles.</a><br/>
          <br/>
            Lecciones:<br/>

                <?php
                foreach(getleccion() as $fila){
                    //fila -> id = al id de leccion 
               
                ?>
                <div class="float-left">
                <!-- Enviar id de evaluacion(Sistema,exci, ect.), nivel y de leccion -->
                  <h1><a href="<?php echo site_url("/Evaluaciones/panel_evaluaciones/$id_evaluaciones/$id_nivel/$fila->id");?>">
                  <?php echo $fila->nombre?></a>
                  </h1>
                  <p>"DESCRIPCION"</p><br>
                Número de evaluaciones:<span class="badge badge-info"><?php echo getTotalEvaluacionLeccion($id_evaluaciones,$id_nivel,$fila->id);?></span>

                  </div>
                <?php
                }
                ?>

        </div>
      </div>
    </div>  
  </div>

  
  <?php include(APPPATH.'Views/include/footer.php');?>