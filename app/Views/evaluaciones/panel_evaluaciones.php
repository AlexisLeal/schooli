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




          <a href="<?php echo site_url('/Panel/index'); ?>">Panel principal</a> / <a href="<?php echo site_url('/Evaluaciones/index'); ?>">Tipo Evaluaciones </a> /
          <a href="<?php echo site_url('/Evaluaciones/tipo_evaluacion/1'); ?>">Niveles.</a> / <a href="<?php echo site_url("/Evaluaciones/lecciones/$id_evaluacion/$id_nivel"); ?>">Lecciones.</a><br/>

          <a href="<?php echo site_url('/Evaluaciones/crear_evaluacion'); ?>">Crear evaluaciones.</a><br/>
          
          Evaluación: Nivel : <?php echo $id_nivel;?> / Lección: <?php echo $id_leccion;?><br/>





          <div class="espacioUno"></div>
        
              <div class="card">
                <div class="card-body">
                <?php
                if(!empty(getEvaluacion($id_evaluacion,$id_nivel,$id_leccion))){
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
              <th class="text-left">Estado</th>
              <th class="text-left">Ver</th>
              <th class="text-left">Editar</th>
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
              //Dejarsala asi no moverle 
              $nombreEvaluaciones = getTipoEvaluacionEspecifico($id_evaluacion);
              //obtiene si es sistema o exci 
              //la variable id_evaluacion hace referencia al id del tipo de evaluacion 
            //Estos paremetros nos lo pasen el contralador
            //Esto puede cambiar 
            foreach(getEvaluacion($id_evaluacion,$id_nivel,$id_leccion) as $fila){
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
                <td><?php echo getValorTotalPreguntas($fila->id);;?></td>
                <td><?php if($fila->estado == 1){
                  echo "Activo";
                  $estado = "Activo";
                }else{
                  echo "Inactivo";
                  $estado = "Inactivo";
                } ?></td>

                <td class="text-center">
                <!--CAMBIAR A LINK-->
                <a href="<?php echo site_url("Preguntas/verEvaluacion/$fila->id") ?>">
                <i class="fa fa-file-text-o fa-1x" aria-hidden="true"></i>
                </a>
                <!--
                <form action="< ?php echo site_url('Preguntas/verEvaluacion')?>" name="ver_evaluacion" id="" method="post">
                <input type="hidden" name="id_e" id="id_e" value="< ?php echo $fila->id;?>">
                <input type="hidden" name="nombre" id="nombre" value="< ?php echo $fila ->nombre;?>">
                <input type="hidden" name="nombre_tipo_evaluacion" id="nombre_tipo_evaluacion" value="< ?php echo $nombreEvaluaciones;?>">                                
                <input type="hidden" name="clave" id="clave" value="< ?php echo $fila ->clave;?>">
                <input type="hidden" name="valorpreguntas" id="du" value="< ?php echo $valor;?>">
                <input type="hidden" name="totalpreguntas" id="du" value="< ?php echo getTotalPreguntas($fila->id);?>">
                <input type="hidden" name="idtipoevaluacion" value="< ?php echo $id_evaluacion;?>">
                <input type="hidden" name="nivel" value="< ?php echo $id_nivel;?>">
                <input type="hidden" name="leccion"  value="< ?php echo $id_leccion;?>">
                <button type="submit" name="submitAP" id="submitAP"><i class="fa fa-file-text-o" aria-hidden="true"></a></i></span></button>
                </form>
                -->
                </td>
                
                <!--CAMBIAR A LINK -->
                <td class="text-center">
                <a href="<?php echo site_url("Preguntas/editarEvaluacion/$fila->id") ?>">
                <i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i>
                </a>
              <!--  <form action="< ?php echo site_url('Preguntas/editarEvaluacion')?>" name="editar_evaluacion" id="" method="post">
                <input type="hidden" name="id_e" id="id_e" value="< ?php echo $fila->id;?>">
                <input type="hidden" name="nombre" id="nombre" value="< ?php echo $fila ->nombre;?>">
                <input type="hidden" name="nombre_tipo_evaluacion" id="nombre_tipo_evaluacion" value="< ?php echo $nombreEvaluaciones;?>">                                
                <input type="hidden" name="clave" id="clave" value="< ?php echo $fila ->clave;?>">
                <input type="hidden" name="valorpreguntas" id="du" value="< ?php echo $valor;?>">
                <input type="hidden" name="totalpreguntas" id="du" value="< ?php echo getTotalPreguntas($fila->id);?>">
                <input type="hidden" name="idtipoevaluacion" value="< ?php echo $id_evaluacion;?>">
                <input type="hidden" name="nivel" value="< ?php echo $id_nivel;?>">
                <input type="hidden" name="leccion"  value="< ?php echo $id_leccion;?>">
                <button type="submit" name="submitAP" id="submitAP"><i class="fa fa-pencil-square-o" aria-hidden="true"></a></i></span></button> 
                </form>

                -->
                </td>


                <td class="text-center">
                <a href="<?php echo site_url("Preguntas/agregar_preguntas/$fila->id")?>">
                <i class="fa fa-plus-circle fa-1x" aria-hidden="true"></i></a>
               <!--
                <form action="< ?php echo site_url('Preguntas/agregar_preguntas')?>" name="agregar_pregunta" id="" method="post">
                <input type="hidden" name="id_e" id="id_e" value="< ?php echo $fila->id;?>">
                <input type="hidden" name="nombre" id="nombre" value="< ?php echo $fila ->nombre;?>">
                <input type="hidden" name="nombre_tipo_evaluacion" id="nombre_tipo_evaluacion" value="< ?php echo $nombreEvaluaciones->nombre;?>">
                <input type="hidden" name="usuario_creo" id="usuario_creo" value="< ?php echo $usuarioCreo->nombre .' '.$usuarioCreo->apellido_paterno;?>">
                <input type="hidden" name="estado" id="estado" value="< ?php echo $estado;?>">
                <input type="hidden" name="clave" id="clave" value="< ?php echo $fila ->clave;?>">
                <input type="hidden" name="valorpreguntas" id="du" value="< ?php echo $valor;?>">
                <input type="hidden" name="totalpreguntas" id="du" value="< ?php echo getTotalPreguntas($fila->id);?>">
                <input type="hidden" name="idtipoevaluacion" value="< ?php echo $id_evaluacion;?>">
                <input type="hidden" name="nivel" value="< ?php echo $id_nivel;?>">
                <input type="hidden" name="leccion"  value="< ?php echo $id_leccion;?>">
                <button type="submit" name="submitAP" id="submitAP"><i class="fa fa-plus-circle" aria-hidden="true"></a></i></span></button>
                </form>
                -->
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