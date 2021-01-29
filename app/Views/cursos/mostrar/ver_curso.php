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


        <h4>Ver curso.</h4>
        <div class="espacioUno"></div>
        <div class="espacioUno"></div>
        <table>
        <tr>
          <td><a href="<?php echo site_url('/Cursos/index'); ?>" ><i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i></a></td>
          <td><a href="<?php echo site_url('/Cursos/index'); ?>" >  Atras</a></td>
        </tr>
        </table>  
        <div class="espacioUno"></div>



        <div class="card">
          <div class="card-body">
            <div class="espacioDos"></div>
            <div class="row">
              <div class="col">
                Nombre
                <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" disabled="disabled" value="<?php echo $nombre; ?>">
              </div>
              <div class="col">
                Estatus
                <input type="text" name="estatus" id="nombre" class="form-control form-control-sm" disabled="disabled" value="<?php echo $estatus; ?>">
              </div>
            </div>

            <div class="espacioUno"></div>


            <div class="row">
              <div class="col">
                Numero de niveles
                <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" disabled="disabled" value="<?php echo $numero_niveles; ?>">
              </div>
              <div class="col">
                Sesiones
                <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" disabled="disabled" value="<?php echo $total_dias_laborales; ?>">
              </div>
            </div>


            <div class="row">
              <div class="col">
                Frecuencia
                <?php
                $f = getFrencueciaEspecifica($id_frecuencia);
                
                ?>
                <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" disabled="disabled" value="<?php echo $f->nombre; ?>">
              </div>
              <div class="col">
                Número de examenes
                <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" disabled="disabled" value="<?php echo $num_examenes; ?>">
              </div>
            </div>

            <div class="row">
              <div class="col">
                Número de ejercicios
                <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" disabled="disabled" value="<?php echo $num_ejercicios; ?>">
              </div>
              <div class="col">
                Valor de asistencia
                <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" disabled="disabled" value="<?php echo $valor_asistencia; ?>">
              </div>
            </div>


            <div class="row">
              <div class="col">
                Valor de ejercicios
                <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" disabled="disabled" value="<?php echo $valor_ejercicios; ?>">
              </div>
              <div class="col">
                Valor de examenes
                <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" disabled="disabled" value="<?php echo $valor_examenes; ?>">
              </div>
            </div>



            <div class="espacioUno"></div>

            <div class="espacioUno"></div>

            <div class="espacioUno"></div>

            <div class="espacioUno"></div>



            <div class="espacioUno"></div>
            </form>

          </div>
        </div>
      </div>




    </div>
  </div>
</div>


<div class="espacioAmplio"></div>

<?php include("include/antes-footer.php");?>

<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/footer.php'); ?>
<?php include(APPPATH . 'Views/include/header-js.php'); ?>