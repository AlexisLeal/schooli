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
            </li>
        </ul>
      </div>
    </nav>

    </div>
    <div class="col-md-4 text-right"> Hola <?php echo $session->get('nombre')?> <?php echo $session->get('apellido')?>  <a href="<?php echo site_url('/Home/salir'); ?>"> Salir </a></div> <i class="fa fa-sign-out" aria-hidden="true"></i> </a></div>
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
  padding:15px 15px 15px 15px;
  margin:20px 20px 20px 20px;
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
          <H1>Tipo de evaluacion: <?php echo $tipo_evaluacion?></H1>

          <a href="<?php echo site_url('/Panel/index'); ?>">Panel</a><br/>
          <a href="<?php echo site_url('/Evaluaciones/crear_evaluacion'); ?>">Crear evaluaciones.</a><br/>
          <a href="<?php echo site_url('/Evaluaciones/index'); ?>">Tipo Evaluaciones </a> <br>
          <br/>
           Niveles<br/>
           <?php
                //id_evaluacion esta variable se le pasa desde el controlador
                //Estas funciones se crearon en los helpers 
                foreach(getNivel() as $fila){
                    
                ?>
                <div class="float-left">
                  <h1> <a href="<?php echo site_url("Evaluaciones/lecciones/$id_evaluacion/$fila->id");?>"><?php echo $fila->nombre?></h1>
                <br>
                       Número de evaluaciones: <span class="badge badge-info"><?php echo getTotalEvaluacion($id_evaluacion,$fila->id);?></span>


                  
                  </div>
                <?php
                }
                ?>


        </div>
      </div>
    </div>  
  </div>

  <?php include(APPPATH.'Views/include/footer.php');?>