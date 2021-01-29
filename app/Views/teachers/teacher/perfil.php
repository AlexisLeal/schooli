<?php include(APPPATH.'/Views/include/header.php');?>

<div class="espacioDos"></div>
<header id="barra-superior">

<div class="container">
  <div class="row">
    <div class="col-md-2">
      <div class="text-center">
        <a href="<?php echo site_url('/Alumno/index'); ?>">
          <img class="mb-4" src="<?php echo base_url('img-front/logo-brain.png');?>" alt="" width="52" height="52">
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
    <span class="space"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>  </span>
    <span class="space"><i class="fa fa-bell-o fa-2x" aria-hidden="true"></i></span>

  <span type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
  <span class="space">
  <i class="fa fa-user fa-2x" aria-hidden="true"></i></span>
  </span>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Perfil</a>
    <a class="dropdown-item" href="<?php echo site_url('/Home/salir');?>">Salir</a>
  </div>
  </div>
  </div>
</div>
</header>




<div class="container">
  <div id="general">
    <div class="row">
      <div class="col-md-3">
        <?php include(APPPATH.'/Views/include/menu-alumno.php');?>
      </div>


      <div class="col-md-9">
        <?php include(APPPATH.'/Views/include/notificacion.php');?>
        <div class="espacioUno"></div>
        <div class="text-right">
          <h4><?php echo $session->get('nombre')." ".$session->get('apellido')." ".$session->get('apellido_materno');?></h4>
        </div>
        <div class="espacioUno"></div>

        <div class="card">
          <div class="card-body">
            <table>
              <tr><td>Email</td><td><?php echo $email;?></td></tr>
              <tr><td>Estado</td><td><?php echo $estado;?></td></tr>
              <tr><td>Telefono</td><td><?php echo $telefono;?></td></tr>
              <tr><td>Movil</td><td><?php echo $movil;?></td></tr>
              <tr><td>Matricula</td><td><?php echo $matricula;?></td></tr>
              <tr><td>Plantel</td><td><?php echo $plantel;?></td></tr>
              <tr><td>Unidad de negocio</td><td><?php echo $unidad_negocio;?></td></tr>
              <tr><td>Calle</td><td><?php echo $calle;?></td></tr>
              <tr><td>Numero Interior</td><td><?php echo $numero_interior;?></td></tr>
              <tr><td>Número Exterior</td><td><?php echo $numero_exterior;?></td></tr>
              <tr><td>Colonia</td><td><?php echo $colonia;?></td></tr>
              <tr><td>Codigo Postal</td><td><?php echo $codigo_postal;?></td></tr>
              <tr><td>Municipio</td><td><?php echo $municipio_delegacion;?></td></tr>
              <tr><td>Pais</td><td><?php echo $pais;?></td></tr>
            </table>
              
          </div>
        </div>
      </div> <!-- Termin contenido div col-md-9-->
    </div>  <!-- Termin contenido row-->
  </div><!-- Termin contenido div id general-->
</div><!-- Termin contenido div container-->

<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/antes-footer.php'); ?>
      
<div class="espacioAmplio"></div>
<?php include(APPPATH.'Views/include/footer.php');?>