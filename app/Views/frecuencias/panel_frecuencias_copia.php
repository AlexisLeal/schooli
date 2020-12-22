<?php include(APPPATH . '/Views/include/header.php'); ?>

<div class="espacioDos"></div>
<header id="barra-superior">

  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <div class="text-center">
          <a href="<?php echo site_url('/Panel/index'); ?>">
            <img class="mb-4" src="<?php echo base_url('img-front/logo-brain.png'); ?>" alt="" width="52" height="52">
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
        <span class="space"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i> </span>
        <span class="space"><i class="fa fa-bell-o fa-2x" aria-hidden="true"></i></span>

        <span type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
          <span class="space">
            <i class="fa fa-user fa-2x" aria-hidden="true"></i></span>
        </span>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">Perfil</a>
          <a class="dropdown-item" href="<?php echo site_url('/Home/salir'); ?>">Salir</a>
        </div>
      </div>
    </div>
  </div>
</header>





    <!--Ejemplo tabla con DataTables-->
    <div class="container">
      <div id="general">
        <div class="row">
          <div class="col-md-2">
            <?php include(APPPATH.'/Views/include/menu-izquierda.php');?>
          </div>



          <div class="col-md-10">
          <?php include(APPPATH.'/Views/include/notificacion.php');?>


        <div class="espacioUno"></div>
        <h4>Panel de Frecuencias</h4>
        <a class="btn btn-success btn-sm" href="<?php echo site_url('/Frecuencia/agregarfrecuencia'); ?>" role="button">Registrar una Frecuencia</a>
        <div class="espacioUno"></div>



            
              <div class="card">
                <div class="card-body">
                <table class="tabla-registros" class="display" cellspacing="6" cellpadding="8">
                <thead>
                <tr>
                <th class="text-left">ID</th>
                <th class="text-left">Nombre</th>
                <th class="text-left">Descripcion</th>
                <th class="text-left">Modalidad</th>
                <th class="text-left">Lun</th>
                <th class="text-left">Mar</th>
                <th class="text-left">Mier</th>
                <th class="text-left">Jue</th>
                <th class="text-left">Vier</th>
                <th class="text-left">Sab</th>
                <th class="text-left">Dom</th>
                <th class="text-left">estatus</th>
                <th class="text-left">Ver</th>
                <th class="text-left">Editar</th>
                <th class="text-left">Asignar Valor Asistencia</th>
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
                <td>
                <a href="<?php echo site_url("/Frecuencia/editarfrecuencia/$fila->id") ?>">
                <i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i>
                </a>
                </td>
                <td class="text-center">
                <a href="<?php echo site_url("/Frecuencia/asignarValorAsistenciaFrecuencia/$fila->id") ?>">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                </a>
                </td>
                </tr>
              </thead>
              <tr>
                <?php foreach (getAllFrecuencia() as $fila) {
                  $nombreModalidad = getModalidadEspecifica($fila->id_modalidad) ?>
                  <td><?php echo $fila->id ?></td>
                  <td><?php echo $fila->nombre ?></td>
                  <td><?php echo $fila->descripcion ?></td>
                  <td><?php echo $nombreModalidad->nombre ?></td>
                  <td><?php echo $fila->lunes ?></td>
                  <td><?php echo $fila->martes ?></td>
                  <td><?php echo $fila->miercoles ?></td>
                  <td><?php echo $fila->jueves ?></td>
                  <td><?php echo $fila->viernes ?></td>
                  <td><?php echo $fila->sabado ?></td>
                  <td><?php echo $fila->domingo ?></td>
                  <td><?php echo ($fila->estatus == 1) ? "Activo" : "Inactivo" ?></td>
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
      <p class="mt-5 mb-3 text-muted text-center"> © <span class="brain-foot">Brain</span> <?php echo date("Y"); ?></p>
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

<?php include(APPPATH . 'Views/include/footer.php'); ?>