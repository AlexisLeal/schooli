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
            <?php include(APPPATH.'/Views/include/menu-alumno.php');?>
          </div>



          <div class="col-md-9">
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Notificaciones del sistema:</strong> Este texto es un ejemplo de notificaciones que el sistema le debe de mostrar al Administrador.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 

          <div class="espacioUno"></div>
          <div class="text-right">
            <h4><?php echo $session->get('nombre')." ".$session->get('apellido')." ".$session->get('apellido_materno');?></h4>
          </div>
          <div class="espacioUno"></div>

          
              <div class="card">
                <div class="card-body">
                Grupo asignado.<br/>
                <hr class="linea"/>
                <div style="padding-left:30px">
                <div class="card">
                <div class="card-body">


                
                <?php
                if($id_grupo == null){
                  echo "No has sido asignado a un grupo";
                }else{ ?>
                  Nombre del grupo:<?php echo $nombre_grupo;?> <br/>
                  Codigo de acceso: <?php echo $codigo_acceso;?> <br/>
                  <?php echo $unidad_negocio;?> <br/>
                  Plantel: <?php echo $nombre_plantel;?> <br/>
                
                <?php }?>

              </div>
            </div>
            <br/>

            <div class="card">
                  <div class="card-body">
                  <i class="fa fa-university" aria-hidden="true"> </i> Teachers
                  <table width="90%" cellspacing="8" cellpadding="4">
                  <tr>
                  <td width="40%">
                <?php if(isset($nombre_maestro)){?>
                  Nombre del Teacher <?php echo $nombre_maestro ?>
                <?php }?>
                  </td>
                  </tr>
                  </table>
                  </div>
                </div>

            <br/>
            <?php if($id_grupo != null){ ?>
            <div class="card">
                  <div class="card-body">
                  <i class="fa fa-cubes" aria-hidden="true"></i> Recursos <br/>
                  <table width="90%" cellspacing="8" cellpadding="4">
                  <tr>
                  <td>Evaluaciónes</td>
            <?php foreach(getGruposEvaluacion($id_grupo) as $fila){?>
               <tr> Nombre <?php echo $fila->nombre?> </tr>  
                <?php }?>
                  <td width="40%"></td>
                  </tr>
                  <tr>
                  <td width="40%">
                  Materiales
            <?php foreach(getGrupoRecursos($id_grupo) as $fila){?>
              <?php if(!empty($fila->id_grupo)){?>
                  <tr> Nombre: <?php echo $fila->nombre;?></tr>
              <?php } ?>
            <?php }?>
                  </td> 
                  </tr>
                  </table>
                  </div>
                </div>
            <?php }?>

            </div>
          </div>

          </div>
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

<?php include(APPPATH.'Views/include/footer.php');?>