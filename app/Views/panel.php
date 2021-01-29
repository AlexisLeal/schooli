<?php include('include/header.php');?>

<div class="espacioDos"></div>
<header id="barra-superior">

<div class="container">
  <div class="row">
    <div class="col-md-2">
      <div class="text-center">
        <a href="<?php echo site_url('/Panel/index'); ?>">
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
        <?php include('include/menu-izquierda.php');?>
      </div>
      <div class="col-md-6">
      <?php include(APPPATH.'/Views/include/notificacion.php');?>
          
      Accesos Rapidos:


        <div class="espacioUno"></div>
        <div class="card">
          <div class="card-body">
            <table width="100%" cellspacing="12" cellpadding="12" >
              <tr>
                <td><div class="text-center"><a href="<?php echo site_url('/Ciclos/index'); ?>"><i class="fa fa-circle-o-notch fa-2x" aria-hidden="true"></i><br/>Ciclos.</a></div></td>
                <td><div class="text-center"><a href="<?php echo site_url('/Grupos/index'); ?>"><i class="fa fa-users fa-2x" aria-hidden="true"></i><br/>Grupos.</a></div></td>
                <td><div class="text-center"><a href="<?php echo site_url('/Alumnos/index'); ?>"><i class="fa fa-graduation-cap fa-2x" aria-hidden="true"></i><br/>Estudiantes.</a></div></td>
              </tr>
            </table>
          </div>
        </div>
              
        <div class="espacioUno"></div>
        <div class="card">
          <div class="card-body">
            <table width="100%" cellspacing="12" cellpadding="12" >
              <tr>
                <td><div class="text-center"><a href="<?php echo site_url('/Notificaciones/index'); ?>"><i class="fa fa-commenting-o fa-2x" aria-hidden="true"></i><br/>Notificaciones</a>                </div></td>
                <td><div class="text-center"><a href="<?php echo site_url('/Teachers/index'); ?>"><i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i><br/>Teachers.</a></div></td>
                <td><div class="text-center"><a href="<?php echo site_url('/Cursos/index'); ?>"><i class="fa fa-th-large fa-2x" aria-hidden="true"></i><br/>Cursos</a>
                </div></td>
              </tr>
            </table>
          </div>
        </div>

        <div class="espacioUno"></div>

      </div>

      <div class="col-md-3">
        Con tenido de lado derecho. Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.
      </div>
    </div>  
  </div>
</div>


<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/antes-footer.php'); ?>

<div class="espacioAmplio"></div>

<?php include("include/footer.php");?>