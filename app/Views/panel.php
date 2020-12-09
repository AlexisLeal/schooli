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





    <!--Ejemplo tabla con DataTables-->
    <div class="container">
      <div id="general">
        <div class="row">
          <div class="col-md-3">
          <?php include('include/menu-izquierda.php');?>
          </div>
          <div class="col-md-6">
           
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Notificaciones del sistema:</strong> Este texto es un ejemplo de notificaciones que el sistema le debe de mostrar al Administrador.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
              Accesos Rapidos:<br/><br/>

              <div class="card">
                <div class="card-body">
                <table width="100%" cellspacing="12" cellpadding="12" >
                <tr>
                <td><div class="text-center"><a href="<?php echo site_url('/Evaluaciones/index'); ?>"><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i><br/>Evaluaciones.</a></div></td>
                <td><div class="text-center"><a href="<?php echo site_url('/Evaluaciones/index'); ?>"><br/>Tipos de <br/> evaluaciones:</a></div></td>
                <td><div class="text-center">
                <?php
                foreach(getTipoEvaluacion() as $fila){ ?>
                  <a href="<?php echo site_url("/Evaluaciones/tipo_evaluacion/$fila->id"); ?>"><?php echo $fila->nombre ?></a> / 
                  <?php
                  }
                  ?>
                  </div>
                </td>
                </tr>
                </table>
                </div>
              </div>

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
                    <td><div class="text-center"><a href="#"><i class="fa fa-handshake-o fa-2x" aria-hidden="true"></i></i><br/>Prospectos.</a></div></td>
                    <td><div class="text-center"><a href="<?php echo site_url('/Teachers/index'); ?>"><i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i><br/>Teachers.</a></div></td>
                    <td><div class="text-center"><a href="<?php echo site_url('/Tutores/index'); ?>"><i class="fa fa-user-secret fa-2x" aria-hidden="true"></i><br/>Tutores.</a></div></td>
                    </tr>
                    <tr>
                  </table>
                </div>
              </div>

              <div class="espacioUno"></div>
              <div class="card">
                <div class="card-body">

                    <table width="100%" cellspacing="12" cellpadding="12" >
                    <tr>
                    <td>
                      <div class="text-center">
                      <a href="#"><i class="fa fa-caret-square-o-right fa-2x" aria-hidden="true"></i><br/>Clase Demo.</a>
                      </div>
                    </td>
                    <td>
                    <div class="text-center">                      
                      <a href="<?php echo site_url('/Notificaciones/index'); ?>"><i class="fa fa-commenting-o fa-2x" aria-hidden="true"></i><br/>Notificaciones</a>
                      </div>
                    </td>
                    <td>
                    <div class="text-center">
                      <a href="#"></a>
                      </div>
                    </td>
                    </tr>
                    </table>

                </div>
              </div>
          </div>

          <div class="col-md-3">
           Con tenido de lado derecho. Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.Con tenido de lado derecho.
          </div>
        </div>  
      </div>
    </div>


      <div class="espacioDos"></div>
      <div class="espacioDos"></div>
      <div class="espacioDos"></div>
      
      <div class="espacioDos"></div>
      <div class="espacioDos"></div>
      <div class="espacioDos"></div>

      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p class="mt-5 mb-3 text-muted text-center"> © <span class="brain-foot">Brain</span> <?php echo date("Y");?></p>
          </div>
          <div class="col-md-3">
          <ul class="footer">
            <li><a href="">Aviso de privacidad</a>
            </li>
            <li><a href="">Certificado AMIPCI</a>
            </li>
            <li><a href="">Certificado Pagos en Linea.</a>
            </li>
            <li><a href="">Certificado SSL.</a>
            </li>
          </ul>            
          </div>
                   
 
          <div class="col-md-3">
          <ul class="footer">
            <li><a href="">Company</a>
            </li>
            <li><a href="">About</a>
            </li>
            <li><a href="">Blog</a>
            </li>
            <li><a href="">Careers</a>
            </li>
            <li><a href="">Press</a>
            </li>
          </ul>         
          </div>
        </div>
      </div>
      
      <div class="espacioDos"></div>
      <div class="espacioDos"></div>
      <div class="espacioDos"></div>
      
      <div class="espacioDos"></div>
      <div class="espacioDos"></div>
      <div class="espacioDos"></div>
<?php include("include/footer.php");?>