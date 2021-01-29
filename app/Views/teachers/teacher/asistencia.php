<?php include(APPPATH.'/Views/include/header.php');?>


<div class="espacioDos"></div>
<header id="barra-superior">

<div class="container">
  <div class="row">
    <div class="col-md-2">
      <div class="text-center">
        <a href="<?php echo site_url('/Teacher/index'); ?>">
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

<div class="container">
  <div id="general">
    <div class="row">
      <div class="col-md-2">
        <?php include(APPPATH.'/Views/include/menu-teacher.php');?>
      </div>
      <div class="col-md-10">
        <?php include(APPPATH.'/Views/include/notificacion.php');?>
        <div class="espacioUno"></div>
        <div class="text-right">
          <h4><?php echo $session->get('nombre')." ".$session->get('apellido')." ".$session->get('apellido_materno');?></h4>
        </div>
        <div class="espacioUno"></div>
        <div class="card">
          <div class="card-body">
          </div>
        </div>
      </div> <!-- Se termina el div 10-->
    </div><!-- Se termina el row-->
  </div> <!-- Se termina id general -->
</div> <!-- Se termina el container-->




<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div style="padding-left:2px">
        <?php 
        if(empty(getGrupoAlumnos($id_grupo,$id_unidad_negocio,$id_plantel))){
          echo "No existen alumnos asignados.";
        }else{
          echo " Listado de alumnos asignados.<br/>";
        ?>
        <div class="espacioUno"></div>
          <div class="card">
            <div class="card-body">
              <table width="60%">
              <tr>
                <td width="10%"><div class="verde"> </div><span class="contenidoEtiqueta">Asistencia</span></td>
                <td width="10%"><div class="rojo"> </div> <span class="contenidoEtiqueta">Falta</span></td>
                <td width="10%"><div class="amarillo"> </div> <span class="contenidoEtiqueta">Retardo</span></td>
                <td width="30%"><div class="naranja"> </div> <span class="contenidoEtiqueta">Falta Justificada</span></td>
              <tr>
              </table>
              <div class="espacioUno"></div>

              <?php
              setlocale(LC_TIME, "spanish");
              $mes    = strftime("%B");
              $mesEsp = ucwords($mes);
              echo "<h2>".$mesEsp." ".date("Y")."</h2>";
          
              if (date("D") == "Mon"){
                $week_start = strtotime(date("d-m-Y"));
              } else {
                $week_start = strtotime('last Monday', time());
              }
              $week_end     = strtotime('next Sunday', time());
              $alumnos      = array();
              ?>
              <div class="espacioUno"></div>
              <!-- Iniciar el formulario -->
                <form action="<?php echo site_url('Teacher/insertar_asistencia'); ?>" method="post">
                  <?php
                  $num_semana = date("W"); 
                  $id_teacher = $session->get('id');
                  ?>
                  <input type="hidden" name="id_grupo" value="<?=$id_grupo;?>">
                  <input type="hidden" name="id_teacher" value="<?=$id_teacher;?>">
                  <input type="hidden" name="num_semana" value="<?=$num_semana;?>">
                  <table class="tabla-registros" width="100%" cellspacing="3" cellpadding="4">
                  <thead>
                    <tr>
                      <th>Alumno</th><th>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th><th>Sabado</th><th>Domingo</th>
                    </tr>
                  </thead>
                    <tr>
                      <td></td>
                      <?php
                      $fechaInicio = $week_start;
                      $fechaFin    = $week_end;
                        for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
                        ?>
                        <td><?=date("d-m-Y", $i);?>
                        </td>
                        <?php
                        }
                        ?>
                  </tr>
                 <tr>
                <td></td>
                <?php
                  for($x=1;$x<=7;$x++){
                  ?>
                  <td>
                    <div class="verde"> </div>
                    <div class="rojo"> </div>
                    <div class="amarillo"> </div>
                    <div class="naranja"> </div>
                  </td>
                <?php
                  }
                ?>
                </tr>
                <?php
                $a = 0;
                  foreach(getGrupoAlumnos($id_grupo,$id_unidad_negocio,$id_plantel) as $fila){ 
                    $alumnos[] = $fila->id;
                    $alumnosComa = implode(",", $alumnos);
                    $a++;
                ?>
                <tr>
                <td><?=$fila->nombre?></td>
                <?php
                  for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
                  $date = date('Y-m-d', $i);
                    if($date != date("Y-m-d")){
                      $d="disabled";
                      }else{$d="";}
                      ?>
                <td>
              
                <div class="form-check form-check-inline">
                  <input class="form-check-input form-control-sm" type="radio" name="<?=$fila->id;?>" id="<?=$fila->id;?>" <?php echo $d;?> value="1" required>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input form-control-sm" type="radio" name="<?=$fila->id;?>" id="<?=$fila->id;?>" <?php echo $d;?> value="2" required>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input form-control-sm" type="radio" name="<?=$fila->id;?>" id="<?=$fila->id;?>" <?php echo $d;?> value="3" required>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input form-control-sm" type="radio" name="<?=$fila->id;?>" id="<?=$fila->id;?>" <?php echo $d;?> value="4" required>
                </div>
              
                </td>
              
                <?php
                }
              }
            }
            ?>
          </tr>
        </table>
              <div class="espacioDos"></div>
              <hr class="linea"/>
              <div class="espacioUno"></div>
              <div class="text-center">
                <input type="hidden" name="alumnos" value="<?=$alumnosComa;?>">
                <input type="hidden" name="num_alumnos" value="<?=$a;?>">
                <input type="hidden" name="id_unidad_negocio" value="<?=$id_unidad_negocio;?>">
                <input type="hidden" name="id_plantel" value="<?=$id_plantel;?>">
                <button type="submit" name="guardarAsistencia" class="btn btn-primary btn-sm" >Guardar</button>
              </div>  
            </form>
          </div>
        </div>        
      </div>
    </div>
  </div>
</div>
<div class="espacioDos"></div>



<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/antes-footer.php'); ?>

<div class="espacioAmplio"></div>

<?php include(APPPATH.'Views/include/footer.php');?>