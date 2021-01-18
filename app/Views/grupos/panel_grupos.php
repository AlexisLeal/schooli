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
        if ($session->has('pregunta-exito')) {
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
        <h4>Panel de Grupos</h4>
        <a class="btn btn-success btn-sm" href="<?php echo site_url('/Grupos/agregargrupo'); ?>" role="button">Registrar un Grupo</a>

        <div class="espacioUno"></div>
        <div class="espacioUno"></div>
        <table>
        <tr>
          <td><a href="<?php echo site_url('/Panel/index'); ?>" ><i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i></a></td>
          <td><a href="<?php echo site_url('/Panel/index'); ?>" >  Ir al Panel</a></td>
        </tr>
        </table>  
        <div class="espacioUno"></div>


        <div class="card">
          <div class="card-body">

            <hr class="linea" />
              <style>
              .nombreGrupo {
              color: #283747;
              font-weight:bold;
              }
              </style>
            <?php foreach (getAllGrupos() as $fila) { ?>
              <div class="niveles" style="width:230px;height:100px;background-image:url('<?php echo base_url($fila->url_imagen) ?>');float:left;margin-left:10px;margin-right:10px;margin-bottom:50px;padding-top:5px;padding-bottom:5px;padding-left:10px;">  
              
                <div class="row">
                  <div class="col">
                    <a class="nombreGrupo" href="<?php echo site_url("/Grupos/vergrupo/$fila->id"); ?>"><?php echo $fila->nombre ?></a>
                    
                    <?php
                    echo "Estatus: ".$fila->estatus."<br/>";
                    echo "Plantel: ".$fila->id_plantel."<br/>";
                    ?>
                    INBI English School <br/>
                  </div>
                  
                  <div class="col">
                    <div style="text-align:right;padding-right:40px;">
                      <i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
                



              </div>
              
            <?php
            }
            ?>


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