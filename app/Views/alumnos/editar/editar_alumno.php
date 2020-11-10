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
          <?php if($session->has('Alumno')){;?>
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Notificaciones del sistema:</strong> <?php echo $session->get('Alumno')?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
              <?php } $session->remove('Alumno');?>



          <h4>Editar Alumno.</h4>
          <div class="espacioUno"></div>
        
              <div class="card">
                <div class="card-body">

                <form action="<?php echo site_url('Alumnos/editar');?>" method="post">
                <div class="espacioDos"></div>
                Datos Generales
                <div class="espacioDos"></div>
                <div class="row">
                  <div class="col">
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" placeholder="Nombre" value="<?php echo $nombre; ?>">
                  </div>
                  <div class="col">
                    <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control form-control-sm" placeholder="Apellido Paterno" value="<?php echo $apeliido_paterno;?>">
                  </div>
                </div>

                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                    <input type="text" name="apellido_materno" id="apellido_materno" class="form-control form-control-sm" placeholder="Apellido Materno" value ="<?php echo $apeliido_materno;?>">
                  </div>
                  <div class="col">
                    <input type="text" name="usuario" id="usuario" class="form-control form-control-sm" placeholder="Usuario" value ="<?php echo $usuario;?>">
                  </div>
                </div>
                
                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                    <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="Correo" value="<?php echo $email;?>">
                  </div>
                </div>
            
                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                    <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" placeholder="Teléfono" value ="<?php echo $telefono;?>">
                  </div>
                  <div class="col">
                    <input type="text" name="movil" id="movil" class="form-control form-control-sm" placeholder="Móvil o WhatssApp" value ="<?php echo $movil;?>">
                  </div>
                </div>


                <div class="espacioUno"></div>
                

                <div class="row">
                  <div class="col">
                  Roll
                  <select class="form-control form-control-sm" name="roll" id="roll" required="">
                    <option value="">Seleccione una opción</option>
                    <?php foreach(getRoll() as $fila){?>
                      <?php if($fila->id == $roll){ ?>
                        <option selected="selected" value="<?php echo $fila->id;?>"><?php echo $fila->nombre;?></option>
                      <?php }else{?>
                    <option value="<?php echo $fila->id?>"><?php echo $fila->nombre?></option>
                      <?php }?>
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
                    <input type="text" name="matricula" id="matricula" class="form-control form-control-sm" placeholder="Matricula" value="<?php echo $matricula;?>">
                  </div>
                  <div class="col">
                    Unidad de negocio
                  <select class="form-control form-control-sm" name="unidad_negocio" id="unidad_negocio" required="">
                  <option value="">Selecciona una opción</option>
                  <?php foreach(getUnidadNegocio() as $fila){?>
                    <?php if($fila->id  == $unidad_negocio){?>
                      <option selected="selected" value="<?php echo $fila->id;?>"><?php echo $fila->nombre;?></option>
                      <?php }else{ ?>
                    <option value="<?php echo $fila->id?>"><?php echo $fila->nombre?></option>
                    <?php } ?> 
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
                  <?php foreach(getPlantelesPorUNidadNegocio($unidad_negocio) as $fila){?>
                  <?php if($fila->id ==  $plantel){ ?>
                    <option selected="selected" value="<?php echo $fila->id;?>"><?php echo $fila->nombre;?></option>
                      <?php }else{ ?>
                    <option value="<?php echo $fila->id?>"><?php echo $fila->nombre?></option>
                    <?php } ?> 
                    <?php } ?> 
                  </select>
                  </div>
                  <div class="col">
                  </div>
                </div>




              <div class="form-group">
                <label for="lblInstrucciones">Comentarios</label>
                <textarea class="form-control form-control-sm" name="comentarios" id="comentarios" rows="3" required=""><?php echo $comentarios?></textarea>
              </div>
                <div class="espacioDos"></div>
                <hr class="linea"/>
                Direccion
                <div class="espacioDos"></div>
                <div class="row">
                  <div class="col">
                  <input type="text" name="calle" id="calle" class="form-control form-control-sm" placeholder="Calle" value="<?php echo $calle;?>">
                  </div>
                  <div class="col">
                  <input type="text" name="num_interior" id="num_interior" class="form-control form-control-sm" placeholder="Número interior" value ="<?php echo $numero_interior;?>">
                  </div>
                </div>

                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                  <input type="text" name="num_exterior" id="num_exterior" class="form-control form-control-sm" placeholder="Número exterior" value ="<?php echo $numero_exterior;?>">
                  </div>
                  <div class="col">
                  <input type="text" name="colonia" id="colonia" class="form-control form-control-sm" placeholder="Colonia" value ="<?php echo $colonia;?>">
                  </div>
                </div>

                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                  <input type="text" name="cp" id="cp" class="form-control form-control-sm" placeholder="Código Postal" value ="<?php echo $codigo_postal;?>">
                  </div>
                  <div class="col">
                  <input type="text" name="municipio_delegacion" id="municipio_delegacion" class="form-control form-control-sm" placeholder="Municipio / Delegación" value ="<?php echo $municipio_delegacion;?>">
                  </div>
                </div>

                <div class="espacioUno"></div>

                <div class="row">
                  <div class="col">
                  Estado
                  <select class="form-control form-control-sm" name="entidad_federativa" id="entidad_federativa" required="">
                    <?php foreach(getEstados() as $fila){?>
                      <?php if($fila->id== $estado){ ?>
                        <option selected="selected" value="<?php echo $fila->id;?>"><?php echo $fila->nombre;?></option>
                        <?php
                      }else{ ?>
                        <option value="<?php echo $fila->id;?>"><?php echo $fila->nombre;?></option>
                        <?php } ?> 
                    <?php } ?> 
                  </select>
                  </div>
                  <div class="col">
                  Pais
                  <select class="form-control form-control-sm" name="pais" id="pais" required="">

                    <?php foreach(getPaises() as $fila){?>
                    <?php if($fila->id == $pais){?>
                      <option selected="selected" value="<?php echo $fila->id;?>"><?php echo $fila->pais;?></option>
                    <?php }else{ ?>
                    <option value="<?php echo $fila->id;?>"><?php echo $fila->pais;?></option>
                    <?php } ?> 
                    <?php } ?> 
                    </select>
                  </div>
                </div>
              <div class="espacioUno"></div>


              <input type="hidden" name="idAlumno" value="<?php echo $idAlumno;?>">    
              <button type="submit" name="submitAL" class="btn btn-primary btn-sm">Registrar</button>
              </form>
              
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-6 text-right">
                  <form action="<?php echo site_url('Alumnos/deletedAlumnos')?>" name="<?php echo $fila->id;?>" id="" method="post">
                    <input type="hidden" name="idAlumno" id="idAlumno" value="<?php echo $idAlumno;?>">
                    <button type="submit" name="submitAP" id="submitAP"><i class="fa fa-trash-o" aria-hidden="true"></i></i></span></button>
                  </form>
                  </div>
                </div>
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
      <?php include(APPPATH.'Views/include/header-js.php');?>
     

    <script>
      $('#unidad_negocio').change(function () {
        var id_unidad = $(this).val();
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
    

 