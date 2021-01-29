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
                <form action="<?php echo site_url('');?>" method="post">
                <table width="60%">
                <tr>
                <td>Valor de la asistencias:</td>
                </tr>

                
                <?php
                $diasFrecuencia = getFrencueciaId($id_frecuencia);
                foreach($diasFrecuencia as $fila){
                  if($fila->lunes==1){
                    ?>
                    <tr>
                      <td>Lunes</td><td><input type="text" class="form-control form-control-sm" name="lunes" id="lunes" required></td>
                    </tr>
                    <?php
                  }
                  
                  if($fila->martes==1){
                    ?>
                    <tr>
                      <td>Martes</td><td><input type="text" class="form-control form-control-sm" name="martes" id="martes" required></td>
                    </tr>
                    <?php
                  }

                                    
                  if($fila->miercoles==1){
                    ?>
                    <tr>
                      <td>Miercoles</td><td><input type="text" class="form-control form-control-sm" name="miercoles" id="miercoles" required></td>
                    </tr>
                    <?php
                  }

                  if($fila->jueves==1){
                    ?>
                    <tr>
                      <td>Jueves</td><td><input type="text" class="form-control form-control-sm" name="jueves" id="jueves" required></td>
                    </tr>
                    <?php
                  }


                  if($fila->viernes==1){
                    ?>
                    <tr>
                      <td>Viernes</td><td><input type="text" class="form-control form-control-sm" name="viernes" id="viernes" required></td>
                    </tr>
                    <?php
                  }
                  

                  if($fila->sabado==1){
                    ?>
                    <tr>
                      <td>Sabado</td><td><input type="text" class="form-control form-control-sm" name="sabado" id="sabado" required></td>
                    </tr>
                    <?php
                  }

                  if($fila->domingo==1){
                    ?>
                    <tr>
                      <td>Domingo</td><td><input type="text" class="form-control form-control-sm" name="domingo" id="domingo" required></td>
                    </tr>
                    <?php
                  }

                  ?>
                  

                <?php
                }
                ?>
                <tr>
                  <td>
                  <input type="hidden" name="id_frecuencia" id="id_frecuencia" value="<?php echo $id_frecuencia;?>" class="form-control form-control-sm">
                    <button type="submit" name="submitAVF" class="btn btn-primary btn-sm">Registrar</button>
                  </td>
                </tr>
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