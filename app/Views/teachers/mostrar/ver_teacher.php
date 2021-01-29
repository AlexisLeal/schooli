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



<div class="container">
  <div id="general">
    <div class="row">
    <div class="col-md-3">
      <?php include(APPPATH.'/Views/include/menu-izquierda.php');?>
    </div>
     
    <div class="col-md-9">
      <?php include(APPPATH.'/Views/include/notificacion.php');?>        
      <?php if($session->has('Alumno')){;?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Notificaciones del sistema:</strong> <?php echo $session->get('Alumno')?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
            </button>
        </div> 
        <?php } $session->remove('Alumno');?>
        <h4>Datos del Alumno.</h4>
        <div class="espacioUno"></div>
        
        <div class="card">
          <div class="card-body">
            <div class="espacioDos"></div>
              Datos Generales
              <div class="espacioDos"></div>
                <div class="row">
                  <div class="col">
                    Nombre
                    <input type="text" id="nombre" class="form-control form-control-sm"disabled="disabled" value="<?php echo $nombre?>">
                  </div>
                  <div class="col">
                    Apellido Paterno
                    <input type="text" id="apellido_paterno" class="form-control form-control-sm" disabled="disabled" value="<?php echo $apeliido_paterno ?>">
                </div>
              </div>
              <div class="espacioUno"></div>
                <div class="row">
                  <div class="col">
                    Apellido Materno
                    <input type="text"  id="apellido_materno" class="form-control form-control-sm" disabled="disabled" value="<?php echo $apeliido_materno?>">
                  </div>
                  <div class="col">
                    Nombre de Usuario
                    <input type="text" id="usuario" class="form-control form-control-sm" disabled="disabled" value="<?php echo $usuario?>">
                  </div>
                </div>
                
                <div class="espacioUno"></div>
                <div class="row">
                  <div class="col">
                    Correo Electronico 
                    <input type="email" id="email" class="form-control form-control-sm" disabled="disabled" value="<?php echo $email ?>">
                  </div>
                </div>
            
                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                    Telefono Fijo
                    <input type="text" id="telefono" class="form-control form-control-sm" disabled="disabled" value="<?php echo $telefono?>">
                  </div>
                  <div class="col">
                    Telefono Movil
                    <input type="text" id="movil" class="form-control form-control-sm" disabled="disabled" value="<?php echo $movil?>">
                  </div>
                </div>
                <div class="espacioUno"></div>
                
                <div class="row">
                  <div class="col">
                    Roll
                    <input type="text" id="movil" class="form-control form-control-sm" disabled="disabled" value="<?php echo $roll?>">
                  </div>
                  <div class="col">
                  </div>
                </div>

                <div class="espacioDos"></div>
                <hr class="linea"/>
                Datos Escolares
                <div class="espacioDos"></div>
                <div class="row">
                  <div class="col">
                    Unidad de negocio
                    <input type="text" id="matricula" class="form-control form-control-sm" disabled="disabled" value="<?php echo $unidad_negocio?>">
                  </div>
                </div>

              <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                    Plantel
                    <input type="text" id="matricula" class="form-control form-control-sm" disabled="disabled" value="<?php echo $plantel?>">
                    </div>
                  <div class="col">
                  </div>
                </div>

                <div class="form-group">
                  <label for="lblInstrucciones">Comentarios</label>
                  <textarea class="form-control form-control-sm" id="comentarios" rows="3" disabled= "disabled"><?php echo $comentarios?></textarea>
                </div>
                <div class="espacioDos"></div>
                <hr class="linea"/>
                Direccion
                <div class="espacioDos"></div>
                  <div class="row">
                    <div class="col">
                    Calle
                      <input type="text" id="calle" class="form-control form-control-sm" disabled="disabled" value="<?php echo $calle?>">
                  </div>
                  <div class="col">
                    Numero Interior
                    <input type="text" id="num_interior" class="form-control form-control-sm" disabled="disabled" value="<?php echo $numero_interior?>">
                  </div>
                </div>
                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                    Numero Exterior
                    <input type="text" id="num_exterior" class="form-control form-control-sm" disabled="disabled" value="<?php echo $numero_exterior?>">
                  </div>
                  <div class="col">
                    Colonia
                    <input type="text" id="colonia" class="form-control form-control-sm" disabled="disabled" value="<?php echo $colonia?>">
                  </div>
                </div>
              <div class="espacioUno"></div>
                <div class="row">
                  <div class="col">
                    Codigo Postal
                   <input type="text" id="cp" class="form-control form-control-sm" disabled="disabled" value="<?php echo $codigo_postal?>" >
                  </div>
                <div class="col">
                  Municipio o Delegacion
                  <input type="text" id="municipio_delegacion" class="form-control form-control-sm" disabled="disabled" value="<?php echo $municipio_delegacion?>">
                </div>
              </div>

              <div class="espacioUno"></div>
                <div class="row">
                  <div class="col">
                    Estado
                    <input type="text" id="municipio_delegacion" class="form-control form-control-sm" disabled="disabled" value="<?php echo $estado?>">
                  </div>
                  <div class="col">
                    Pais
                    <input type="text" id="municipio_delegacion" class="form-control form-control-sm" disabled="disabled" value="<?php echo $pais?>">
                  </div>
                </div>
               

            <div class="espacioUno"></div>
              <input type="button" value="Página anterior" onClick="history.go(-1);">
          </div>
        </div>
      </div>
    </div>  
  </div>
</div>
    

<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/antes-footer.php'); ?>
      
<div class="espacioAmplio"></div>

<?php include(APPPATH.'Views/include/footer.php');?>
    

 