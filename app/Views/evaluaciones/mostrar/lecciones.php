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



          <div class="col-md-6">
          <?php include(APPPATH.'/Views/include/notificacion.php');?>

              <?php

            $nombreEvaluaciones = getTipoEvaluacionEspecifico($id_evaluaciones);
            //$nombreNivel = getnivelEspecifico($id_nivel);
            ?>
          <H1>Tipo de evaluacion: <?php echo $nombreEvaluaciones->nombre ?></H1>
          <H2>Nivel: <?php echo getnivelEspecifico($id_nivel); ?></H2>

          <a href="<?php echo site_url('/Panel/index'); ?>">Panel</a><br/>
          <a href="<?php echo site_url('/Evaluaciones/crear_evaluacion'); ?>">Crear evaluaciones.</a><br/>
          <a href="<?php echo site_url('/Evaluaciones/index'); ?>">Tipo Evaluaciones </a> <br>
          <a href="<?php echo site_url("/Evaluaciones/tipo_evaluacion/$nombreEvaluaciones->id"); ?>">Niveles.</a><br/>

          
          <div class="espacioUno"></div>
              <div class="card">
                <div class="card-body">
                <?php
                foreach(getleccion() as $fila){               
                ?>
                <div class="float-left" style="margin-left:20px;margin-right:20px;padding-top:10px;padding-bottom:15px;">
                  <h4><a href="<?php echo site_url("/Evaluaciones/panel_evaluaciones/$id_evaluaciones/$id_nivel/$fila->id");?>">
                  <?php echo $fila->nombre;?></a>
                  </h4>                  
                  Número de evaluaciones:<span class="badge badge-info"><?php echo getTotalEvaluacionLeccion($id_evaluaciones,$id_nivel,$fila->id);?></span>
                  </div>
                <?php
                }
                ?>


              </div>
            </div>
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

<?php include(APPPATH.'Views/include/footer.php');?>