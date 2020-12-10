<?php include(APPPATH.'/Views/include/header.php');?>

<div class="espacioDos"></div>
<header id="barra-superior">

<div class="container">
  <div class="row">
    <div class="col-md-2">
      <div class="text-center">
        <a href="<?php echo site_url('/Alumno/index'); ?>">
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
            <?php include(APPPATH.'/Views/include/menu-teacher.php');?>
          </div>



          <div class="col-md-9">
          <?php include(APPPATH.'/Views/include/notificacion.php');?>

          <div class="espacioUno"></div>
          <div class="text-right">
            <h4><?php echo $session->get('nombre')." ".$session->get('apellido')." ".$session->get('apellido_materno');?></h4>
          </div>
          <div class="espacioUno"></div>

          
            <div class="card">
              <div class="card-body">
                Grupos asignado.<br/>
                <hr class="linea"/>
              <div style="padding-left:30px">
              <div class="card">
                <div class="card-body">
                Listado de grupos asignados
                <?php
                $alumnos=array();
                $alumnos[] = 'Gerardo';
                $alumnos[] = 'Hugo';
                $alumnos[] = 'Saby';
                $alumnos[] = 'Luz';
                $alumnos[] = 'Angeles';
                ?>
                </div>
              </div>
            
            <br/>

            <div class="card">
              <div class="card-body">
              Ejemplo de Asistencias para 5 Alumnos: <br/>

              <?php
          setlocale(LC_TIME, "spanish");
          $mes=strftime("%B");
          $mesEsp=ucwords($mes);
          echo "<h2>".$mesEsp." ".date("Y")."</h2>";
          

          if (date("D") == "Mon"){
            $week_start = date("Y-m-d");
          } else {
            $week_start = strtotime('last Monday', time());
          }
          $week_end     = strtotime('next Sunday', time());

          $fechaInicio=$week_start;
          $fechaFin=$week_end;



          ?>
          <table width="100%">
          <tr>
          <td>Alumno</td><td>Lunes</td><td>Martes</td><td>Miercoles</td><td>Jueves</td><td>Viernes</td><td>Sabado</td><td>Domingo</td>
          <tr>
          <tr>
          
              <?php
              foreach($alumnos as $alumno){
                echo $alumno."<br/>";
              }?>

              <?php
              for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
              ?>
              <td><?php echo date("d-m-Y", $i);?></td>
              <?php
              }
              ?>
          </tr>
          </table>

              

              </div>
            </div>



  

            <br/><br/>
            </div>
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