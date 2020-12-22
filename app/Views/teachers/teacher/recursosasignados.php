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
              Recursos asignados al Grupo.<br/>
              <hr class="linea"/>
              <div style="padding-left:2px">
                <div class="card">
                  <div class="card-body">
                    <div class="espacioUno"></div>
                   <?php 
                    if(empty(getGrupoRecursos($id_curso,$id_nivel))){
                      echo "No existen grupos asignados a para este Teacher.";
                    }else{
                      foreach(getGrupoRecursos($id_curso,$id_nivel) as $fila){
                        switch($fila->extencion){
                          case "docx":
                            $icono = "fa-file-word-o fa-2x";
                            break;
                          case "xlsx":
                            $icono = "fa-file-excel-o fa-2x";
                            break;
                          case "pdf":
                            $icono = "fa-file-pdf-o fa-2x";
                            break;
                          case "zip":
                            $icono = "fa-file-archive-o fa-2x";
                            break;
                          case "rar":
                            $icono = "fa-file-archive-o fa-2x";
                            break;
                          case "jpg":
                            $icono = "fa-file-image-o fa-2x";
                            break;
                          case "png":
                            $icono = "fa-file-image-o fa-2x";
                            break;
                          case "mp3":
                            $icono = "fa-file-audio-o fa-2x";
                            break;
                          case "mp4":
                            $icono = "fa-file-video-o fa-2x";
                            break;
                          default:
                            $icono="fa-file fa-2x";
                        }
                      ?>
                      <a href="< ?php echo base_url($fila->ruta);?>"><i class="fa < ?php echo $icono;?>" aria-hidden="true"></i> <?php echo $fila->nombre;?></a>  <br/>
                    <?php }
                    }
                  ?>
                
                  <div class="espacioUno"></div>            
                </div>
              </div>
              <div class="espacioDos"></div>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </div>
</div>


<div class="espacioAmplio"></div>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <p class="mt-5 mb-3 text-muted text-center"> © <span class="brain-foot">Brain</span> <?php echo date("Y");?></p>
    </div>
    <div class="col-md-3">
      <ul class="footer">
        <li><a href="">Aviso de privacidad</a></li>
        <li><a href="">Certificado AMIPCI</a></li>
        <li><a href="">Certificado Pagos en Linea.</a></li>
        <li><a href="">Certificado SSL.</a></li>
      </ul>            
    </div>
                   
 
    <div class="col-md-3">
      <ul class="footer">
        <li><a href="">Company</a></li>
        <li><a href="">About</a></li>
        <li><a href="">Blog</a></li>
        <li><a href="">Careers</a></li>
        <li><a href="">Press</a></li>
      </ul>         
    </div>
  </div>
</div>
      
<div class="espacioAmplio"></div>

<?php include(APPPATH.'Views/include/footer.php');?>