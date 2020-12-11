<?php include(APPPATH.'/Views/include/header.php');?>
<style>
.pers {
  margin-left:10px;
padding-left:10px;
float:right;
display:inline;
}
.contenidoEtiqueta {
margin-left:3px;
padding-left:3px;
font-size:90%;
}

.verde {
  width: 13px;
  height: 13px;
  border:0px;
  background-color: #229954;
  -moz-border-radius: 8px;  
  -webkit-border-radius: 8px;
  padding: 3px;
  float:left;
}

.rojo {
  width: 13px;
  height: 13px;
  border:0px;
  background-color: #C70039;
  -moz-border-radius: 8px;  
  -webkit-border-radius: 8px;
  padding: 3px;
  float:left;
}

.amarillo {
  width: 13px;
  height: 13px;
  border:0px;
  background-color: #FFC300;
  -moz-border-radius: 8px;  
  -webkit-border-radius: 8px;
  padding: 3px;
  float:left;
}

.naranja {
  width: 13px;
  height: 13px;
  border:0px;
  background-color: #FF5733;
  -moz-border-radius: 8px;  
  -webkit-border-radius: 8px;
  padding: 3px;
  float:left;
}
/*
input[type='radio']:after {
           width: 15px;
           height: 15px;
           border-radius: 15px;
           top: -2px;
           left: -1px;
           position: relative;
           background-color: #229954;
           content: '';
           display: inline-block;
           visibility: visible;
           border: 2px solid white;
}

input[type='radio']:checked:after {
           width: 15px;
           height: 15px;
           border-radius: 15px;
           top: -2px;
           left: -1px;
           position: relative;
           background-color: #ffa500;
           content: '';
           display: inline-block;
           visibility: visible;
           border: 2px solid white;
}*/
</style>
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
                Alumnos del grupo seleccionado.<br/>
                <hr class="linea"/>
              <div style="padding-left:2px">
              <div class="card">
                <div class="card-body">

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
              Ejemplo de Asistencias para 5 Alumnos: <br/><br/>
              <table width="80%">
              <tr>
              <td width="15%"><div class="verde"> </div><span class="contenidoEtiqueta">Asistencia</span></td>
              <td width="15%"><div class="rojo"> </div> <span class="contenidoEtiqueta">Falta</span></td>
              <td width="15%"><div class="amarillo"> </div> <span class="contenidoEtiqueta">Retardo</span></td>
              <td width="35%"><div class="naranja"> </div> <span class="contenidoEtiqueta">Falta Justificada</span></td>
              <tr>
              </table>
              <br/>



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
          <br/>
          <table class="tabla-registros" width="100%" cellspacing="3" cellpadding="4">
          <thead>
          <tr>
          <th>Alumno</th><th>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th><th>Sabado</th><th>Domingo</th>
          </tr>
          </thead>
          <tr>
          <td></td>
          <?php
            for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
            ?>
            <td><?=date("d-m-Y", $i);?>
            </td>
          <?php
          }
          ?>
          </tr>
          
          <?php
          foreach($alumnos as $alumno){
            ?>
            <tr>
            <td><?=$alumno?></td>
            <?php
            for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
              ?>
              <td><!-- < ?=date("d-m-Y", $i);?>-->
               <!-- Aqui van los radiobuttons con las 4 opciones -->
              <!--<input type="radio" name="" id="" value=""> Asistencia
              <input type="radio" name="" id="" value=""> Falta
              <input type="radio" name="" id="" value=""> Retardo
              <input type="radio" name="" id="" value=""> Falta Justificada
              -->
              <style>
              .form-check-inline {
                padding:1px;
                margin:1px;
              }
              </style>
              <div class="form-check form-check-inline">
                <input class="form-check-input form-control-sm" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input form-control-sm" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input form-control-sm" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input form-control-sm" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
              </div>
              <!--
              <input class="form-check-input form-control-sm pers" type="radio" name="" id="" value="a" alt="Asistencia" required> <span class="vacio">.</span>
              <input class="form-check-input form-control-sm pers" type="radio" name="" id="" value="f" alt="Falta" required> <span class="vacio">.</span>
              <input class="form-check-input form-control-sm pers" type="radio" name="" id="" value="r" alt="Retardo" required> <span class="vacio">.</span>
              <input class="form-check-input form-control-sm pers" type="radio" name="" id="" value="fj" alt="Falta Justificada" required> <span class="vacio">.</span>
              -->
              </td>
              
              <?php
            }
            ?>
            </tr>
            <?php
          }?>
          </table>
<br/><br/>
<hr class="linea"/>
<br/>
                  <div class="text-center">
                  <button type="submit" name="guardarAsistencia" class="btn btn-primary btn-sm" >Guardar</button>

                  </div>  
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