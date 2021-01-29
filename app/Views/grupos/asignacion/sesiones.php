
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

          <h4>Sesiones del Grupo.</h4>
          <div class="espacioUno"></div>
          <div class="espacioUno"></div>
          <table>
          <tr>
            <td><a href="<?php echo site_url("/Grupos/vergrupo/$id_grupo"); ?>" ><i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i></a></td>
            <td><a href="<?php echo site_url("/Grupos/vergrupo/$id_grupo"); ?>" >Atras</a></td>
          </tr>
          </table>  
          <div class="espacioUno"></div>

              <div class="card">
                <div class="card-body">
                
                <hr class="linea"/>
                  <div style="padding-left:30px;">
                    <?php for($Sesion=1;$Sesion<=GruposObtenerSesionesporCurso($id_curso);$Sesion++){ ?>
                    <div class="espacioUno"></div>
                    <a href="<?php echo site_url("/Asignacion/recursosasignados/$id_curso/$id_nivel/$Sesion/$id_grupo");?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Sesion <?php echo $Sesion?></a>
                    <?php } ?>
                    </div>

                <hr class="linea"/>
                <br/>            

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