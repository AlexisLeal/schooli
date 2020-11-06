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



          <h4>Registro de alumno.</h4>
          <div class="espacioUno"></div>
        
              <div class="card">
                <div class="card-body">

                <form action="<?php echo site_url('Alumnos/insertarAlumno');?>" method="post">
                <div class="espacioDos"></div>
                Datos Generales
                <div class="espacioDos"></div>
                <div class="row">
                  <div class="col">
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" placeholder="Nombre">
                  </div>
                  <div class="col">
                    <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control form-control-sm" placeholder="Apellido Paterno">
                  </div>
                </div>

                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                    <input type="text" name="apellido_materno" id="apellido_materno" class="form-control form-control-sm" placeholder="Apellido Materno">
                  </div>
                  <div class="col">
                    <input type="text" name="usuario" id="usuario" class="form-control form-control-sm" placeholder="Usuario">
                  </div>
                </div>
                
                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                    <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="Correo">
                  </div>
                  <div class="col">
                    <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Contraseña">
                  </div>
                </div>
            
                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                    <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" placeholder="Teléfono">
                  </div>
                  <div class="col">
                    <input type="text" name="movil" id="movil" class="form-control form-control-sm" placeholder="Móvil o WhatssApp">
                  </div>
                </div>


                <div class="espacioUno"></div>
                

                <div class="row">
                  <div class="col">
                  Roll
                  <select class="form-control form-control-sm" name="roll" id="roll" required="">
                    <option value="">Seleccione una opción</option>
                    <?php foreach(getRoll() as $fila){?>
                    <option value="<?php echo $fila->id?>"><?php echo $fila->nombre?></option>
                    <?php } ?> 
                  </select>
                  </div>
                  <div class="col">
 
                  </div>
                </div>


                <div class="espacioDos"></div>
                <hr class="linea"/>
                Datos Escolares
                <div class="espacioDos"></div>
                <div class="row">
                  <div class="col">
                    Matricula
                    <input type="text" name="matricula" id="matricula" class="form-control form-control-sm" placeholder="Matricula">
                  </div>
                  <div class="col">
                    Unidad de negocio
                  <select class="form-control form-control-sm" name="unidad_negocio" id="unidad_negocio" required="">
                  <option value="">Selecciona una opción</option>
                  <?php foreach(getUnidadNegocio() as $fila){?>
                    <option value="<?php echo $fila->id?>"><?php echo $fila->nombre?></option>
                    <?php } ?> 
                  </select>
                  </div>
                </div>








                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                  Plantel
                  <select class="form-control form-control-sm" name="plantel" id="plantel" required="">
                  <option value="">Selecciona una opción</option>
                  <?php //foreach(getPlanteles() as $fila){?>
                   <!-- <option value="<?php //echo $fila->id?>"><?php //echo $fila->nombre?></option>-->
                    <?php //} ?> 
                  </select>

                  </div>
                  <div class="col">
                  </div>
                </div>

                <div id="contenido">Contenido</div>
                <div id="nocontenido">No contenido</div>



              <div class="form-group">
                <label for="lblInstrucciones">Comentarios</label>
                <textarea class="form-control form-control-sm" name="comentarios" id="comentarios" rows="3" required=""></textarea>
              </div>
                <div class="espacioDos"></div>
                <hr class="linea"/>
                Direccion
                <div class="espacioDos"></div>
                <div class="row">
                  <div class="col">
                  <input type="text" name="calle" id="calle" class="form-control form-control-sm" placeholder="Calle">
                  </div>
                  <div class="col">
                  <input type="text" name="num_interior" id="num_interior" class="form-control form-control-sm" placeholder="Número interior">
                  </div>
                </div>

                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                  <input type="text" name="num_exterior" id="num_exterior" class="form-control form-control-sm" placeholder="Número exterior">
                  </div>
                  <div class="col">
                  <input type="text" name="colonia" id="colonia" class="form-control form-control-sm" placeholder="Colonia">
                  </div>
                </div>

                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                  <input type="text" name="cp" id="cp" class="form-control form-control-sm" placeholder="Código Postal">
                  </div>
                  <div class="col">
                  <input type="text" name="municipio_delegacion" id="municipio_delegacion" class="form-control form-control-sm" placeholder="Municipio / Delegación">
                  </div>
                </div>

                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                  Estado
                  <select class="form-control form-control-sm" name="entidad_federativa" id="entidad_federativa" required="">
                    <?php foreach(getEstados() as $fila){?>
                    <option value="<?php echo $fila->id;?>"><?php echo $fila->nombre;?></option>
                    <?php } ?> 
                  </select>
                  </div>
                  <div class="col">
                  Pais
                  <select class="form-control form-control-sm" name="pais" id="pais" required="">
                    <?php foreach(getPaises() as $fila){?>
                    <option value="<?php echo $fila->id;?>"><?php echo $fila->pais;?></option>
                    <?php } ?> 
                    </select>
                  </div>
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
      <?php echo base_url('app/Views/include/ajax/consulta-plantel.php');?>
      <?php include(APPPATH.'Views/include/footer.php');?>
      <?php include(APPPATH.'Views/include/header-js.php');?>
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script>
      $('#unidad_negocio').change(function () {
        alert("entro");
        
        $.ajax({
          type: "POST",
          url: "<?php echo site_url('Alumnos/plantelesUnidadNegocio');?>",
          data:"",
          success : function(text){
          limpio = text.trim();
          if(limpio == "exito"){
            document.getElementById("contenido").innerHTML="okkkkkkkkkkkkk";
          }else{
            document.getElementById("nocontenido").innerHTML="nnnnnnnnnnnnnok";
          }                      
        }
        });



      });
    </script>
    