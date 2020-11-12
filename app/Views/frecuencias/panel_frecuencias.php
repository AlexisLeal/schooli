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



          <div class="espacioUno"></div>
            <h4>Panel de Frecuencias</h4>
              <div class="card">
                <div class="card-body">
                <a href="<?php echo site_url('/Frecuencia/agregarfrecuencia'); ?>">Crea una Frecuencia</a><br/>
                <table class="tabla-registros" class="display" cellspacing="6" cellpadding="8">
                <thead>
                <tr>
                <th class="text-left">ID</th>
                <th class="text-left">Nombre</th>
                <th class="text-left">Descripcion</th>
                <th class="text-left">Modalidad</th>
                <th class="text-left">Lunes</th>
                <th class="text-left">Martes</th>
                <th class="text-left">Miercoles</th>
                <th class="text-left">Jueves</th>
                <th class="text-left">Viernes</th>
                <th class="text-left">Sabado</th>
                <th class="text-left">Domingo</th>
                <th class="text-left">estatus</th>
                <th class="text-left">Ver</th>
                <th class="text-left">Editar</th>
                </tr>
                </thead>
                  <tr>
                  <?php foreach(getAllFrecuencia() as $fila){ 
                 $nombreModalidad = getModalidadEspecifica($fila->id_modalidad) ?>
                <td><?php echo $fila->id ?></td>
                <td><?php echo $fila->nombre ?></td>
                <td><?php echo $fila->descripcion ?></td>
                <td><?php echo $nombreModalidad->nombre?></td>
                <td><?php echo $fila->lunes ?></td>
                <td><?php echo $fila->martes ?></td>
                <td><?php echo $fila->miercoles ?></td>
                <td><?php echo $fila->jueves ?></td>
                <td><?php echo $fila->viernes ?></td>
                <td><?php echo $fila->sabado ?></td>
                <td><?php echo $fila->domingo ?></td>
                <td><?php echo ($fila->estatus == 1) ? "Activo" : "Inactivo"?></td>
                <td class="text-center">
                  <a href="<?php echo site_url("/Frecuencia/verfrecuencia/$fila->id") ?>">
                  <i class="fa fa-file-text-o fa-1x" aria-hidden="true"></i>
                </td>
                <td class="text-center">
                <a href="<?php echo site_url("/Frecuencia/editarfrecuencia/$fila->id") ?>">
                <i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i>
                </a>
                </td>

                </tr>
                  <?php } ?>
                </table>




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