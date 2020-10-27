<?php include(APPPATH.'/Views/include/header.php');?>
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
        </ul>
      </div>
    </nav>

    </div>
    <div class="col-md-4 text-right"> Hola <?php echo $session->get('nombre')?> <?php echo $session->get('apellido')?>  <a href="<?php echo site_url('/Home/salir'); ?>"> <i class="fa fa-sign-out" aria-hidden="true"></i> </a></div>
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

          <a href="<?php echo site_url('/Panel/index'); ?>">Panel.</a><br/>
            <a href="<?php echo site_url('/Evaluaciones/crear_evaluacion'); ?>">Crear evaluaciones.</a><br/>
          <br/>

          Tipo de evaluaciones:<br/>
          <?php
            // Esta funcion se encuentra en la carpeta helpers en el archivo llamado operaciones
            foreach(getTipoEvaluacion() as $fila){ ?>
                 <a href="<?php echo site_url("/Evaluaciones/tipo_evaluacion/$fila->id"); ?>"><?php echo $fila->nombre ?></a>
                 <!--Recordar la diferencias entre comillas dobles y comillas simples 
                      y pasamos un parametro por get hacia el controlador que lo captura -->
                 <br>
              <?php
            }
              ?>
                <div class="float-left">
                  <h1><a href="niveles.php?"></a></h1>
                  <p>Aqui va un tipo de evaluaciones</p><br/>
                   
                      Número de evaluaciones: <span class="badge badge-info">DATOS</span>

                  
                  </div>

        </div>
      </div>
    </div>  
  </div>

<?php include(APPPATH.'Views/include/footer.php');?>