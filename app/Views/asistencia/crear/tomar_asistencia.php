<?php include(APPPATH.'/Views/include/header.php');?>

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





    <!--Ejemplo tabla con DataTables-->
    <div class="container">
      <div id="general">
        <div class="row">
          <div class="col-md-3">
            <?php include(APPPATH.'/Views/include/menu-izquierda.php');?>
          </div>


           
          <div class="col-md-9">

          <?php if($session->has('Notificaciones')){;?>
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Notificaciones:</strong> <?php echo $session->get('Notificaciones')?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
              <?php } $session->remove('Notificaciones');?>





          <h4>Registrar Notificación.</h4>
          
          <div class="espacioUno"></div>
        
              <div class="card">
                <div class="card-body">

                <form action="<?php echo site_url('Notificaciones/insertarnotificacion');?>" method="post" enctype="multipart/form-data">
              

                
                <div class="espacioDos"></div>



                <div class="row">
                  <div class="col">
                  Nombre
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-sm">
                  </div>
                  <div class="col">
                  Notificacion
                  <textarea class="form-control form-control-sm" name="notificacion" id="notificacion" rows="3" required=""></textarea>
                  </div>
                </div>

                <div class="espacioUno"></div>

                <div class="row">
                <div class="col">
                <label for="lblInstrucciones">Tipo de usuario</label>
                  <select class="form-control form-control-sm" name="tipo_usuario" id="tipo_usuario" required="">
                    <option value="">Seleccione una opción</option>
                    <?php 
                    foreach (getTipoUsuario() as $fila){
                    ?>
                    <option value="<?php echo $fila->id?>"><?php echo $fila->nombre?></option>
                    <?php
                    }
                    ?>
                  </select>

                </div>
                <div class="col">
                <label for="lblInstrucciones">Estatus</label>
                  <select class="form-control form-control-sm" name="estatus" id="estatus" required="">
                    <option value="">Seleccione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                    </div>
              </div>

                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                  Fecha Inicio
                  <input type="date" name="fecha_inicio" id="fecha_inicio" required class="form-control form-control-sm">
                  </div>
                  <div class="col">
                  Fecha Termina
                  <input type="date" name="fecha_termina" id="fecha_termina" required class="form-control form-control-sm">
                  </div>
                </div>
                
                <div class="espacioUno"></div>
                <div class="espacioUno"></div>





              <div class="espacioUno"></div>

              <button type="submit" name="sbNotificacion" class="btn btn-primary btn-sm">Registrar</button>
              </form>

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
      <?php include(APPPATH.'Views/include/header-js.php');?>
     
