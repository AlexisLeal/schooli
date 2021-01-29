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
            
              <h4> Asignación de Teacher y Teachers Asignados.</h4>
              <div class="card">
                <div class="card-body">
                </h4>
                <a href="<?php echo site_url("/Grupos/vergrupo/$id_grupo");?>">
                <i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i>
                </a>
                </h4>

                <hr class="linea"/>

                <form action="<?php echo site_url('Asignacion/asignarteacher');?>" method="post">
                <?php foreach(getGrupoMaestros($id_grupo) as $fila){
                if(empty($fila->id_grupo)){?>
                <input type="checkbox" name="<?php echo $fila->id?>"  value="<?php echo $fila->id?>"> <?php echo $fila->nombre;?> <br>
                <?php }else{?>
                <input type="checkbox"  disabled="disabled"  checked> <?php echo $fila->nombre?> <br> 
                <?php }?>
                <?php }?>

                <input type="hidden" name="id_grupo" value= "<?php echo $id_grupo?>">
                <input type="hidden" name="id_unidad_negocio" value= "<?php echo $id_unidad_negocio?>">
                <input type="hidden" name="id_plantel" value= "<?php echo $id_plantel?>">
                <br/><br/>
                <div class="text-center">
                <button type="submit" name="submitTH" class="btn btn-primary btn-sm"> Asignar </button>
                </div>
                </form>


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