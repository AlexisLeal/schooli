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
          <?php include(APPPATH.'/Views/include/notificacion.php');?>


              <?php
              if($session->has('pregunta-exito')){ 
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <?php
                  echo $session->get('pregunta-exito');
                  ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php
                
                $session->remove('pregunta-exito'); 
              }
              ?>




 


          <div class="espacioUno"></div>
            <h4>Grupos</h4>
              <div class="card">
                <div class="card-body">

                <!--<a href="< ?php echo site_url('/Grupos/agregargrupo'); ?>">Crear un grupo</a> / --> 
                <a href="<?php echo site_url('Grupos/index')?>"> Panel de grupos </a> <br/>
                <hr class="linea"/>

                <div style="padding-left:30px">
                <div class="card">
                  <div class="card-body">
                  <table width="90%">
                    <tr>
                      <td>Nombre: <?php echo $nombre_grupo;?></td><td>Código de acceso: <?php echo $codigo_acceso;?></td>
                      </tr>
                      <tr>
                      <td>Unidad Negocio: <?php echo  $unidad_negocio;?></td><td>Plantel: <?php echo $nombre_plantel;?></td>
                    </tr>
                      <tr>
                      <td>Nivel: <?php echo  $nivel;?></td>
                    </tr>
                  </table>
                  </div>
                </div>
                
                <br/>
                

                <div class="card">
                  <div class="card-body">
                  <i class="fa fa-cubes" aria-hidden="true"></i> Materiales <br/>
                  <table width="90%" cellspacing="8" cellpadding="4">
                  <tr>
                  <td width="40%"><a href="<?php echo site_url("Asignacion/evaluacion/$id_grupo");?>">Evaluaciónes</a></td>
                  <td width="40%"></td>
                  </tr>


                  <tr>
                  <td width="40%">
                  <a href="<?php echo site_url("Asignacion/recursos/$id_grupo");?>">  Recursos y asignacion de recursos </a>
                  </td>
                  <td width="40%">
                  <a href="<?php echo site_url("Asignacion/deletedRecursos/$id_grupo");?>"> Eliminar Recursos </a>
                  </td>
                  <td width="40%">
                  <a href="<?php echo site_url("Asignacion/deletedEvaluacion/$id_grupo");?>"> Eliminar Evaluacion </a>
                  </td>
                  </tr>
                  </table>
                  
                  

                  </div>
                </div>
                
                <br/>
                

                <div class="card">
                  <div class="card-body">
                  
                  <i class="fa fa-users" aria-hidden="true"></i> Miembros
                  <table width="90%" cellspacing="8" cellpadding="4">
                  <tr>
                  <td width="40%">
                  <a href="<?php echo site_url("Asignacion/alumnos/$id_grupo/$id_unidad_negocio/$id_plantel");?>"> Lista de alumnos y asignacion de alumnos </a>
                  </td>
                  <td width="40%">
                  <a href="<?php echo site_url("Asignacion/deletedAlumno/$id_grupo");?>"> Eliminar Alumnos </a> 
                  </td>
                  </tr>
                  </table>


                  </div>
                </div>

                <br/>
                

                <div class="card">
                  <div class="card-body">
                  <i class="fa fa-university" aria-hidden="true"> </i>Teachers
                  <table width="90%" cellspacing="8" cellpadding="4">
                  <tr>
                  <td width="40%">
                  <a href="<?php echo site_url("Asignacion/teacher/$id_grupo/$id_unidad_negocio/$id_plantel");?>">Lista de Teachers y Asignación de Teacher</a>
                  </td>
                  <td width="40%">
                  <a href="<?php echo site_url("Asignacion/deletedTeacher/$id_grupo");?>">Eliminar Teacher</a> 
                  </td>
                  </tr>
                  </table>

                  </div>
                </div>

                <br/>
                

                <div class="card">
                  <div class="card-body">
                  <i class="fa fa-list-ul" aria-hidden="true"></i> <a href="#"> Libreta de calificaciones. </a>
                  </div>
                </div>


                </div>
              </div>

              <div style="padding-left:30px">
              <!--
              < ?php foreach(getMateriales($id_grupo) as $fila){?>
                  nombre: < ?php echo $fila->nombre; ?> <br>
              < ?php 
              }
              ?>
              <br>
              < ?php foreach(getMiembros($id_grupo) as $fila){?>
                nombre del alummno < ?php echo $fila->nombre?> <br>
                < ?php }?>
              
                < ?php foreach(getMiembrosDisponibles($id_unidad_negocio,$id_plantel) as $fila){ ?>
                Nombre de alumnos disponibles < ?php echo $fila->nombre ?> <br>
                < ?php } ?>
                <br>


                < ?php foreach(getMiembrosOtrosGrupos($id_grupo,$id_unidad_negocio,$id_plantel) as $fila){ ?>
                Nombre de alumnos de otro grupos < ?php echo $fila->nombre ?> No.Grupo < ?php echo $fila->id_grupo?> <br>
                < ?php } ?>
                ?>
                -->

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