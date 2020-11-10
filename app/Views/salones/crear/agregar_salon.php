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
          <h4>Registrar un salon.</h4>
          
          <div class="espacioUno"></div>
        



              <div class="card">
                <div class="card-body">

                <form action="#<?php //echo site_url('Alumnos/insertarAlumno');?>" method="post" enctype="multipart/form-data">
               
                <div class="espacioDos"></div>
                <div class="row">
                  <div class="col">
                  Nombre
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-sm">
                  </div>
                  <div class="col">
                    Estatus
                    <select class="form-control form-control-sm" name="estatus" id="estatus" required="">
                    <option value="">Seleccione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                    </select>
                  </div>
                </div>

                <div class="espacioUno"></div>


                <div class="row">
                  <div class="col">
                  Unidad de negocio
                  <select class="form-control form-control-sm" name="unidad_negocio" id="unidad_negocio" required="">
                  <option value="">Selecciona una opción</option>
                  <?php foreach(getUnidadNegocio() as $fila){?>
                    <option value="<?php echo $fila->id?>"><?php echo $fila->nombre?></option>
                    <?php } ?> 
                  </select>
                  </div>
                  <div class="col">
                  Plantel
                  <select class="form-control form-control-sm" name="plantel" id="plantel" required="">
                  <option value="">Selecciona una opción</option> 
                  </select>
                  </div>
                </div>


              <div class="espacioUno"></div>

              <div class="row">
                  <div class="col">
                  Horarios
                    <select class="form-control form-control-sm" name="estatus" id="estatus" required="">
                    <option value="">Seleccione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                    </select>
                  </div>
                  <div class="col">
                    Salon
                    <select class="form-control form-control-sm" name="estatus" id="estatus" required="">
                    <option value="">Seleccione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                    </select>
                  </div>
                </div>

                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                  Cupo
                    <input type="text" name="nombre" id="cupo" class="form-control form-control-sm">
                  </div>
                  <div class="col">
                  Precio
                  <input type="text" name="nombre" id="precio" class="form-control form-control-sm">
                  </div>
                </div>
                
                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                  Nivel
                    <select class="form-control form-control-sm" name="nivel" id="nivel" required="">
                    <option value="">Seleccione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                    </select>
                  </div>
                  <div class="col">
                    Cargar Imagen
                    <div class="form-group">
                    <input  class="form-control form-control-sm" type="file" id="imagen_grupo" name="imagen_grupo" required="">
                  </div>
                  </div>
                </div>
                
                <div class="espacioUno"></div>

              <div class="form-group">
                <label for="lblInstrucciones">Descripción</label>
                <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" rows="3" required=""></textarea>
              </div>

              <div class="espacioUno"></div>

              <button type="submit" name="submitAL" class="btn btn-primary btn-sm">Registrar</button>
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
      $('#unidad_negocio').change(function () {
        var id_unidad = $(this).val();
        // cuando el valor sea 0, se debe resetear el listado de planteles
        $.ajax({
          type: "POST",
          url: "<?php echo site_url('Alumnos/plantelesUnidadNegocio');?>",
          data: "id_unidad_negocio=" + id_unidad,
          success : function(text){
            document.getElementById("plantel").innerHTML = "";
            $('#plantel').append(text);
        }

        });
      });
    </script>
 