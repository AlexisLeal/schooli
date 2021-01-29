

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
          <h4>Asignación de Alumnos y Alumnos Asignados </h4>
              <div class="card">
                <div class="card-body">
                
            
            </h4>
                <a href="<?php echo site_url("/Grupos/vergrupo/$id_grupo");?>">
                <i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i>
                </a>
                </h4>

            <hr class="linea"/>
            <div style="padding-left:50px;">
            <form action="<?php echo site_url('Asignacion/asignaralumno');?>" method="post">


              
              <table width="70%">
              <tr>
              <td width="30%">Miembros del grupo</td>
              <td width="30%">Acciones de grupo</td>
              </tr>
              <?php foreach(AsignacionGetAlumnosAsignados($id_unidad_negocio,$id_plantel) as $fila){
              if(empty($fila->id_grupo)){?>
              <tr>
              <td><input type="checkbox" name="<?php echo $fila->id?>"  value="<?php echo $fila->id?>"> <?php echo $fila->nombre;?> </td>
              <td>Disponible</td>
              <?php }elseif($fila->id_grupo != $id_grupo && !empty($fila->id_grupo)){?>
              </tr>
              <tr>
            <td><input type="checkbox" disabled="disabled"  checked name="<?php echo $fila->id?>"  value="<?php echo $fila->id?>"> <?php echo $fila->nombre;?> </td>
            <td>Esta en otro Grupo</td>
            </tr>
            <?php 
             }else{?>
           
              <tr>
              <td><input type="checkbox"  disabled="disabled"  checked> <?php echo $fila->nombre?></td>
              <td><button type="button" class="btn btn-primary btn-sm" value="<?php echo $fila->id?>" onclick="auxiliar(<?php echo $fila->id?>)" data-toggle="modal" data-target="#reasignar" data-whatever="@mdo">Resasignar alumno</button></td>
              </tr>
              <?php }?>
            <?php }?>

            </table>
            <input type="hidden" name="id_grupo" value= "<?php echo $id_grupo?>">
            <input type="hidden" name="id_unidad_negocio" value= "<?php echo $id_unidad_negocio?>">
            <input type="hidden" name="id_plantel" value= "<?php echo $id_plantel?>">
            <br/><br/>
            
            <div class="text-center">
              <input type="submit" class="btn btn-primary btn-sm" name="submitAL" value="Asignar">
            </div>
            
            </form>
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
            <p class="mt-5 mb-3 text-muted text-center"> © <span class="brain-foot">LMS INBI</span> <?php echo date("Y");?></p>
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


      <!--Codigo para la vista del boton de reeasignacion-->
      <div class="modal fade" id="reasignar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar a un grupo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('Asignacion/reasignaralumno')?>" method="POST">
          <div class="form-group">
            <?php foreach (getAllGruposReasignar() as $fila) { ?>
              <?php if($fila->id != $id_grupo){ ?>
              <input type="radio" name="id_grupo_nuevo" value="<?php echo  $fila->id?>"> <?php echo $fila->nombre?> ID_Plantel:<?php echo $fila->id_plantel ?> ID_NEGOCIO:<?php echo $fila->id_unidad_negocio?>
              <?php  }?>
              <br>

            <?php } ?>
          <div class="modal-footer">
          <input type="hidden" name="id_usuario" id="asignar" value="">
          <input type="hidden" name="id_grupo_actual" value= "<?php echo $id_grupo?>">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" name="submitRSG">Enviar</button>
      </div>
        </form>
      </div>
    
    </div>
  </div>
</div>
<script>
function auxiliar(parametro){
  //alert(parametro);
  document.getElementById("asignar").value=parametro;
}
</script>
<?php include(APPPATH.'Views/include/footer.php');?>

<script>
/*
$('#reasignar').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
*/
</script>