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
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Notificaciones del sistema:</strong> Este texto es un ejemplo de notificaciones que el sistema le debe de mostrar al Administrador.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 


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
                <a href="<?php echo site_url('Grupos/index')?>"> Panel de Recursos </a> <br/>
                <hr class="linea"/>

                <div style="padding-left:30px">
                <div class="card">
                  <div class="card-body">
                  <table width="90%">
                    <tr>
                      <td>Nombre: Grupo INBI 0007</td><td>Código de acceso: YTRE-0O95-345TG</td>
                      </tr>
                      <tr>
                      <td>Unidad Negocio: INBI</td><td>Plantel: Universidad</td>
                    </tr>
                  </table>
                  </div>
                </div>
                <br/>                             
                Materiales<br/>
                Miembros<br/>
                Libreta de calificaciones.<br/>
                <br/>

                <table width="70%">
                <tr>
                <td>
                <a href="<?php echo site_url("Asignacion/recursos/$id_grupo");?>">Asignar Recursos</a>
                </td>
                <td>
                <a href="<?php echo site_url("Asignacion/deletedRecursos/$id_grupo");?>">Eliminar Recurso</a>
                </td>
                </tr>

                <tr>
                <td>
                <a href="<?php echo site_url("Asignacion/teacher/$id_grupo");?>">Asignar Un Teacher</a>
                </td>
                <td>
                <a href="<?php echo site_url("Asignacion/deletedTeacher/$id_grupo");?>">Eliminar Teacher</a> 
                </td>
                </tr>

                <tr>
                <td>
                <a href="<?php echo site_url("Asignacion/evaluacion/$id_grupo");?>">Asignar Evaluación</a>
                </td>
                <td></td>
                </tr>

                <tr>
                <td>
                <a href="<?php echo site_url("Asignacion/alumnos/$id_grupo");?>">Asignar Alumnos</a>
                </td>
                <td>
                <a href="<?php echo site_url("Asignacion/deletedAlumno/$id_grupo");?>">Eliminar Alumno</a> 
                </td>
                </tr>
                </table>

                </div>
              </div>

              <div style="padding-left:30px">
              <?php foreach(getMateriales($id_grupo) as $fila){?>
                  nombre: <?php echo $fila->nombre; ?> <br>
                
              <?php }?>
              <br>
              <?php foreach(getMiembros($id_grupo) as $fila){?>
                nombre del alummno <?php echo $fila->nombre?> <br>
                <?php }?>
              <br>
              <?php foreach(getGruposEvaluacion($id_grupo) as $fila){?>
                nombre dela evaluacion <?php echo $fila->nombre?> <br>
                <?php }?>
                <br>
                <?php foreach(getMiembrosDisponibles() as $fila){ ?>
                Nombre de alumnos disponibles <?php echo $fila->nombre ?> <br>
                <?php } ?>
                <br>
                <?php foreach(getMiembrosOtrosGrupos($id_grupo) as $fila){ ?>
                Nombre de alumnos de otro grupos <?php echo $fila->nombre ?> No.Grupo <?php echo $fila->id_grupo?> <br>
                <?php } ?>
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