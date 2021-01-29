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
      <div class="col-md-3">
        <?php include(APPPATH . '/Views/include/menu-izquierda.php'); ?>
      </div>



      <div class="col-md-9">
        <?php include(APPPATH . '/Views/include/notificacion.php'); ?>


        <?php
        if ($session->has('editar-grupo-exito')) {
        ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php
            echo $session->get('editar-grupo-exito');
            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php

          $session->remove('editar-grupo-exito');
        }
        ?>


        <div class="espacioUno"></div>
        <h4>Editar grupo</h4>
        

        <div class="espacioUno"></div>
        <div class="espacioUno"></div>
        <table>
        <tr>
          <td><a href="<?php echo site_url('/Grupos/index'); ?>" ><i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i></a></td>
          <td><a href="<?php echo site_url('/Grupos/index'); ?>" >  Ir al Panel</a></td>
        </tr>
        </table>  
        <div class="espacioUno"></div>


        <div class="card">
          <div class="card-body">

            <hr class="linea" />
            
            <form action="<?php echo site_url('Grupos/editargrupo'); ?>" method="post">
            <table>
                <tr>
                    <td>Nombre del grupo</td>
                    <td><input class="form-control form-control-sm" type="text" name="nombreGrupo" id="nombreGrupo" value="<?php echo $nombre;?>" required></td>
                </tr>
                <tr>
                    <td>Plantel</td>
                    <td>
                    <select class="form-control form-control-sm" name="plantelGrupo" id="plantelGrupo">
                    <?php
                    foreach(getPlanteles() as $fila){
                      if($fila->id==$id_plantel){
                        ?>
                          <option selected="selected" value="<?php echo $fila->id;?>"><?php echo $fila->nombre;?></option>
                        <?php
                      }else{
                        ?>
                          <option value="<?php echo $fila->id;?>"><?php echo $fila->nombre;?></option>
                        <?php
                      }
                      ?>
                    <?php
                    }
                    ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>Estatus</td>
                    <td>
                        <select class="form-control form-control-sm" name="estatusGrupo" id="estatusGrupo">
                            <option <?php if($estatus==1){echo "selected='selected'";}?>value="1">Activo</option>
                            <option <?php if($estatus==0){echo "selected='selected'";}?>value="0">Inactivo</option>
                        </select>
                        <input type="hidden" name="id_grupo" id="id_grupo" value="<?php echo $id_grupo;?>" >
                    </td>
                </tr>
                <tr>
                  <td colspan="2"><button type="submit" name="editarGrupo" class="btn btn-primary btn-sm">Guardar</button></td>
                </tr>
            </table>
            </form>

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
      <p class="mt-5 mb-3 text-muted text-center"> © <span class="brain-foot">LMS INBI</span> <?php echo date("Y"); ?></p>
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