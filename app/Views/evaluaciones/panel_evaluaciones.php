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


          <div class="espacioUno"></div>
            <h4>Panel de Evaluaciones</h4>
              <div class="espacioUno"></div>
              <div class="espacioUno"></div>
              <table>
              <tr>
                <td><a href="javascript:history.back()"><i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i></a></td>
                <td><a href="javascript:history.back()">Atras</a></td>
              </tr>
              </table>  
              <div class="espacioUno"></div>
        
              <div class="card">
                <div class="card-body">
                <?php
                if(!empty(getEvaluacion($id_evaluacion))){
                ?>
              <table class="tabla-registros" class="display" cellspacing="6" cellpadding="8">
                <thead>
              <tr>
              <th class="text-left">ID</th>
              <th class="text-left">Nombre</th>
              <th class="text-left">Tipo Evaluacion</th>
              <th class="text-left">Categoría Evaluacion</th>
              <th class="text-left">Numero de preguntas</th>
              <th class="text-left">Valor total</th>
              <th class="text-left">Ver</th>
              <th class="text-left">Agregar preguntas</th>
              </tr>
              </thead>
              <tbody>
                <?php
                }else{
                  echo "No existen evaluaciones.";
                }
                ?>
            <?php
            foreach(getEvaluacion($id_evaluacion) as $fila){
              $nombreEvaluaciones = getTipoEvaluacionEspecifico($fila->tipo_evaluacion);
              $valor = getValorTotalPreguntas($fila->id);
              $usuarioCreo = getUsuarioCreo($fila->usuario_creo);
              //MUY IMPORTANTE ESTE FUNCION 
                ?>
                <tr>
                <td><?php echo $fila->id;?></td>
                <td><?php echo $fila ->nombre;?></td>
                <td><?php echo $nombreEvaluaciones->nombre;?></td> 
                <td><?php
                if(empty($fila->idCategoriaEvaluacion)){
                  echo "vacia";
                }else{
                  echo getCategoriaEvaluacionEspecifica($fila->idCategoriaEvaluacion);
                }
               
                ?></td>
                <td><?php echo getTotalPreguntas($fila->id);?></td>
                <td><?php echo getValorTotalPreguntas($fila->id);?></td>
              <!--  <td>< ?php if($fila->estado == 1){
                  echo "Activo";
                  $estado = "Activo";
                }else{
                  echo "Inactivo";
                  $estado = "Inactivo";
                } ?></td>
              -->
                <td class="text-center">
                <!--CAMBIAR A LINK-->
                <a href="<?php echo site_url("Preguntas/verEvaluacion/$fila->id") ?>">
                <i class="fa fa-file-text-o fa-1x" aria-hidden="true"></i>
                </a>
                </td>
                
                <!--CAMBIAR A LINK -->
                <td class="text-center">
                <a href="<?php echo site_url("Preguntas/editarEvaluacion/$fila->id") ?>">
                <i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i>
                </a>
                </td>
                
                </tr>
            
              <?php
              }
              ?>
              </tbody>
              </table>


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