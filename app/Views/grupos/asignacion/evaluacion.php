
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
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Notificaciones del sistema:</strong> Este texto es un ejemplo de notificaciones que el sistema le debe de mostrar al Administrador.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 


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
            <h4>Grupos</h4>
              <div class="card">
                <div class="card-body">

            <a href="<?php echo site_url('/Grupos/agregargrupo'); ?>">Crear un grupo</a> 
            <hr class="linea"/>

            <form action="<?php echo site_url('Asignacion/asigniarevaluacion');?>" method="post">

            <select class="form-control form-control-sm" name="nivel" id="nivel" required="" onchange="getevaluacionprueba()">
            <option value="">Seleccione una opción</option>
            <?php foreach(getNivel() as $fila){ ?>
                <option value="<?php echo $fila->id; ?>"><?php echo $fila->nombre; ?></option> 
            <?php }?>
            </select>
            <br>
            <select class="form-control form-control-sm" name="leccion" id="leccion" required="" onchange="getevaluacionprueba()">
            <option value="">Seleccione una opción</option>
            <?php foreach(getleccion() as $fila){ ?>
                <option value="<?php echo $fila->id; ?>"><?php echo $fila->nombre; ?></option> 
            <?php }?>
            </select> 
            <br>
             <select class="form-control form-control-sm" name="evaluacion" id="evaluacion" required="">
              <option value="">Selecciona una opción</option>
              </select>


            <input type="hidden" name="id_grupo" value= "<?php echo $id_grupo?>">
            <input type="submit" class="btn btn-primary btn-sm" name="submitEV" value="Asignar">
           
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
<?php include(APPPATH.'Views/include/header-js.php');?>

<script>
     function getevaluacionprueba(){
       
      let nivel = document.getElementById('nivel').value;
      let leccion =  document.getElementById('leccion').value;

      if(nivel=="" && leccion== "" ){
           alert("El nivel es " + nivel);
           alert("La leccion es " + leccion);
      }else{
  
        $.ajax({
          type: "POST",
          url: "<?php echo site_url('Asignacion/EvaluacionEspecifica');?>",
          data: "nivel=" + nivel + "&leccion=" + leccion,
          success : function(text){
            document.getElementById("evaluacion").innerHTML = "";
            $('#evaluacion').append(text);
            }

        });
      }
      }
    </script>
    
