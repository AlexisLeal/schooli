<?php include(APPPATH.'/Views/include/header.php');?>

<div class="espacioDos"></div>
<header id="barra-superior">

<div class="container">
  <div class="row">
    <div class="col-md-2">
      <div class="text-center">
        <a href="<?php echo site_url('/Teacher/index'); ?>">
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
      <div class="col-md-2">
        <?php include(APPPATH.'/Views/include/menu-teacher.php');?>
      </div>

      <div class="col-md-10">
        <?php include(APPPATH.'/Views/include/notificacion.php');?>
        <div class="espacioUno"></div>
        <div class="text-right">
          <h4><?php echo $session->get('nombre')." ".$session->get('apellido')." ".$session->get('apellido_materno');?></h4>
        </div>
        <div class="espacioUno"></div>


        <?php if($session->has('Asistencia')){;?>
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <?php echo $session->get('Asistencia')?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> 
        <?php } $session->remove('Asistencia');?>

      <div class="card">
        <div class="card-body">
          <h4>Contenido del Grupo.</h4>
          <hr class="linea"/>
            <div style="padding-left:2px">
              <div class="card">
                <div class="card-body">
                  <a href="<?php echo site_url("/Teacher/alumnosasignados/$id_grupo/$id_unidad_negocio/$id_plantel")?>">Alumnos asignados esté Grupo.</a><br/>
                  <a href="<?php echo site_url("/Teacher/recursosasignados/$id_grupo")?>">Recursos asignados a esté Grupo</a><br/>
                <a href="<?php echo site_url("/Teacher/asistencia/$id_grupo/$id_unidad_negocio/$id_plantel")?>">Asistencia</a><br/>
                </div>
              </div>
            
              <div class="espacioUno"></div>
              <div class="espacioDos"></div>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </div>
</div>


<div class="espacioAmplio"></div>

<?php include("include/antes-footer.php");?>
      
<div class="espacioAmplio"></div>

<?php include(APPPATH.'Views/include/footer.php');?>