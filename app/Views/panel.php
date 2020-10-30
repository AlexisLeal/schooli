<?php include('include/header.php');?>

<div class="espacioDos"></div>
<header id="barra-superior">

<div class="container">
  <div class="row">
    <div class="col-md-2">
      <div class="text-center">
        <img class="mb-4" src="<?php echo base_url('img-front/logo-brain.PNG');?>" alt="" width="52" height="52">
      </div>
    </div>
    <div class="col-md-6">
      <div class="text-left">
        <!--<nav class="navbar navbar-light bg-light">
          <form class="form-inline">
            <input class="form-control mr-sm-1" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-1 my-sm-0" type="submit">Search</button>
          </form>
        </nav>-->
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

    <?php //echo $session->get('nombre')?> <?php //echo $session->get('apellido')?>  
    <!-- <a href="<?php //echo site_url('/Home/salir'); ?>"> -->
    <!-- <i class="fa fa-sign-out" aria-hidden="true"></i> </a>-->
  </div>
  </div>
</div>
</header>





    <!--Ejemplo tabla con DataTables-->
    <div class="container">
      <div id="general">
        <div class="row">
        <div class="col-md-3">
        <h2 class="titulos-menu">Sistema</h2>
        <ul class="list-group">
          <li class="list-group-item"><a href="#">Configuración Regional</a></li>
          <li class="list-group-item"><a href="#">Información Técnica</a></li>
        </ul>
          
          <hr class="linea" />


          <h2 class="titulos-menu">Catalogos</h2>

           <ul class="list-group">
             <li class="list-group-item"><a href="#">Sucursales</a></li>
             <li class="list-group-item"><a href="#">Facultades</a></li>
             <li class="list-group-item"><a href="#">Caarreras</a></li>
             <li class="list-group-item"><a href="#">Usuarios</a></li>
             <li class="list-group-item"><a href="#">Roles</a></li>
             <li class="list-group-item"><a href="#">Integraciones</a></li>
             <li class="list-group-item"><a href="#">Medios</a></li>
             <li class="list-group-item"><a href="#">Canales</a></li>
             <li class="list-group-item"><a href="#">Origenes</a></li>
             <li class="list-group-item"><a href="#">Notificaciones</a></li>
             <li class="list-group-item"><a href="#">Avisos Pop-Up</a></li>
             <li class="list-group-item"><a href="#">Black List</a></li>
             <li class="list-group-item"><a href="#">Calendario Anual</a></li>
             <li class="list-group-item"><a href="#">Horarios</a></li>
             <li class="list-group-item"><a href="#">Turnos</a></li>
             <li class="list-group-item"><a href="#">Accesos</a></li>
             <li class="list-group-item"><a href="#">Materiales</a></li>
             <li class="list-group-item"><a href="#">Tipo Materiales</a></li>
             <li class="list-group-item"><a href="#">Categoría Materiales</a></li>
             <li class="list-group-item"><a href="#">Clases Demo</a></li>
           </ul>
           <hr class="linea" />
           <h2 class="titulos-menu">Modulos</h2>
           
           <ul class="list-group">
             <li class="list-group-item"><a href="#">Evaluaciones</a></li>
             <li class="list-group-item"><a href="#">Estudiantes</a></li>
             <li class="list-group-item"><a href="#">Grupos</a></li>
             <li class="list-group-item"><a href="#">Ciclos</a></li>
             <li class="list-group-item"><a href="#">Prospectos</a></li>
             <li class="list-group-item"><a href="#">Teachers</a></li>
             <li class="list-group-item"><a href="#">Tutores</a></li>
             <li class="list-group-item"><a href="#">Clase Demo</a></li>
           </ul>
           <hr class="linea" />
           <h2 class="titulos-menu">Reportes</h2>
          
          <ul class="list-group">
             <li class="list-group-item"><a href="#">Reporte 1</a></li>
             <li class="list-group-item"><a href="#">Reporte 2</a></li>
           </ul>
           <hr class="linea" />

           <h2 class="titulos-menu">Integraciones</h2>
          <ul class="list-group">
             <li class="list-group-item"><a href="#">Estados de cuenta.</a></li>
             <li class="list-group-item"><a href="#">Pagos en esta plataforma</a></li>
           </ul>
          </div>
          <div class="col-md-6">
           
          
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Notificaciones del sistema:</strong> Este texto es un ejemplo de notificaciones que el sistema le debe de mostrar al Administrador.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
              Accesos Rapido:<br/><br/>
              <div class="espacioUno"></div>
              <table width="100%" cellspacing="12" cellpadding="12" >
              <tr>
              <td><div class="text-center"><a href="<?php echo site_url('/Evaluaciones/index'); ?>"><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i><br/>Evaluaciones.</a></div></td>
              <td><div class="text-center"><a href="<?php echo site_url('/Grupos/index'); ?>"><i class="fa fa-users fa-2x" aria-hidden="true"></i><br/>Grupos.</a></div></td>
              <td><div class="text-center"><a href="<?php echo site_url('/Alumnos/index'); ?>"><i class="fa fa-graduation-cap fa-2x" aria-hidden="true"></i><br/>Estudiantes.</a></div></td>
              </tr>
              <tr>
              <td><div class="text-center"><a href="<?php echo site_url('/Ciclos/index'); ?>"><i class="fa fa-circle-o-notch fa-2x" aria-hidden="true"></i><br/>Ciclos.</a></div></td>
              <td><div class="text-center"><a href="<?php echo site_url('/Teacher/index'); ?>"><i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i><br/>Teachers.</a></div></td>
              <td><div class="text-center"><a href="<?php echo site_url('/Tutores/index'); ?>"><i class="fa fa-user-secret fa-2x" aria-hidden="true"></i><br/>Tutores.</a></div></td>
              </tr>
              <tr>
              <td><div class="text-center"><a href="<?php echo site_url('/Ciclos/index'); ?>"><i class="fa fa-handshake-o fa-2x" aria-hidden="true"></i></i><br/>Prospectos.</a></div></td>
              <td><div class="text-center"><a href="<?php echo site_url('/Teacher/index'); ?>"><i class="fa fa-caret-square-o-right fa-2x" aria-hidden="true"></i></i><br/>Clase Demo.</a></div></td>
              <td></td>
              </tr>
              </table>

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