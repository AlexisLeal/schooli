<?php include('include/header.php');?>
 <head>
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
    </ul>

  </div>
</nav>
    </div>
    <div class="col-md-4 text-right"> Hola <?php echo $session->get('nombre')?> <?php echo $session->get('apellido')?>  <a href="inc/salir.php"> <i class="fa fa-sign-out" aria-hidden="true"></i> </a></div>
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

      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <table width="100%">
          <tr>
          <td><div class="text-center"><a href="<?php echo site_url('/Evaluaciones/index'); ?>"><i class="fa fa-file-text-o fa-3x" aria-hidden="true"></i><br/>Evaluaciones.</a></div></td>
          <td><div class="text-center"><a href="<?php echo site_url('/Grupos/index'); ?>"><i class="fa fa-users fa-3x" aria-hidden="true"></i><br/>Grupos.</a></div></td>
          <td><div class="text-center"><a href="<?php echo site_url('/Alumnos/index'); ?>"><i class="fa fa-user fa-3x" aria-hidden="true"></i><br/>Alumnos.</a></div></td>
          </tr>
          <tr>
          <td><div class="text-center"><a href="<?php echo site_url('/Ciclos/index'); ?>"><i class="fa fa-circle-o-notch fa-3x" aria-hidden="true"></i><br/>Ciclos.</a></div></td>
          <td><div class="text-center"><a href="<?php echo site_url('/Teacher/index'); ?>"><i class="fa fa-user-circle-o fa-3x" aria-hidden="true"></i><br/>Teachers.</a></div></td>
          <td><div class="text-center"><a href="<?php echo site_url('/Tutores/index'); ?>"><i class="fa fa-user-secret fa-3x" aria-hidden="true"></i><br/>Tutores.</a></div></td>
          </tr>
          </table>

          </div>
        </div>

       
      </div>

    
<?php include("include/footer.php");?>