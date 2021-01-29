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


<div class="container">
  <div id="general">
    <div class="row">
      <div class="col-md-3">
        <?php include(APPPATH . '/Views/include/menu-izquierda.php'); ?>
      </div>

      <div class="col-md-9">
        <?php include(APPPATH . '/Views/include/notificacion.php'); ?>
        <?php if ($session->has('Grupo')) {; ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Notificaciones del sistema:</strong> <?php echo $session->get('Grupo') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php }
        $session->remove('Grupo'); ?>

        <h4>Registro de un Grupo.</h4>
        <div class="espacioUno"></div>
        <div class="espacioUno"></div>
        <table>
        <tr>
          <td><a href="<?php echo site_url('/Grupos/index'); ?>" ><i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i></a></td>
          <td><a href="<?php echo site_url('/Grupos/index'); ?>" >Atras</a></td>
        </tr>
        </table>  
        <div class="espacioUno"></div>


        <div class="card">
          <div class="card-body">
            <form action="<?php echo site_url('Grupos/insertargrupo'); ?>" method="post" enctype="multipart/form-data" id="datosgrupo">
              <div class="espacioDos"></div>
              <div class="row">
                <div class="col">
                  Nombre <input type="text" name="nombre" id="nombre" class="form-control form-control-sm">
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
              <div class="espacioDos"></div>
              <div class="row">
                <div class="col">
                Plantel
                    <select class="form-control form-control-sm" name="plantel" id="plantel" required="">
                      <option value="">Selecciona una opción</option>
                      <?php foreach(getPlanteles() as $fila){?>
                        <option value="<?php echo $fila->id;?>"><?php echo $fila->nombre;?></option>
                        <?php
                      }
                      ?>
                    </select>
                </div>
                <div class="col">

                </div>
              </div>


              <div class="espacioDos"></div>

              <div class="row">
                <div class="col">
                  Curso
                  <select class="form-control form-control-sm" name="curso" id="curso" required="">
                    <option value="">Selecciona una opción</option>
                    <?php foreach (CatalagoGetCursos() as $fila) { ?>
                      <option value="<?php echo $fila->id ?>"><?php echo $fila->nombre ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col">
                  Horarios
                  <select class="form-control form-control-sm" name="horarios" id="horarios" required="">
                    <option value="">Seleccione una opción</option>
                    <?php foreach (getAllHorarios() as $fila) { ?>
                      <option value="<?php echo $fila->id; ?>"><?php echo $fila->nombre; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="espacioDos"></div>

              <div class="row">
                <div class="col">
                  Salon
                  <select class="form-control form-control-sm" name="salon" id="salon" required="">
                    <option value="">Seleccione una opción</option>
                    <?php foreach (getAllSalones() as $fila) { ?>
                      <option value="<?php echo $fila->id; ?>"><?php echo $fila->nombre; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col">
                  Cupo
                  <input type="number" name="cupo" id="cupo" class="form-control form-control-sm">
                </div>
              </div>

              <div class="espacioDos"></div>
              <div class="row">
                <div class="col">
                  Nivel
                  <select class="form-control form-control-sm" name="nivel" id="nivel" required="">
                    <option value="">Seleccione una opción</option>
                  </select>
                </div>
                <div class="col">
                  Ciclo
                  <select class="form-control form-control-sm" name="ciclo" id="ciclo" required="">
                    <option value="">Seleccione una opción</option>
                    <?php foreach (CatalagogetGetCiclo() as $fila) { ?>
                      <option value="<?php echo $fila->id; ?>"><?php echo $fila->nombre; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="espacioDos"></div>
                <div class="col">
                  Cargar Imagen
                  <div class="form-group">
                    <input class="form-control form-control-sm" type="file" id="imagen_grupo" name="imagen_grupo" required="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  Teacher 1
                  <select class="form-control form-control-sm" name="maestro" id="maestro">
                    <option value="">Seleccione una opción</option>
                    <?php foreach (MaestrosGetAllMaestros() as $fila) { ?>
                      <option value="<?php echo $fila->id_usuario; ?>"><?php echo $fila->nombre . ' ' . $fila->apellido_paterno . ' ' . $fila->apellido_materno; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col">
                  Teacher 2
                  <select class="form-control form-control-sm" name="maestro2" id="maestro2">
                    <option value="">Seleccione una opción</option>
                  </select>
                </div>
              </div>

              <div class="espacioDos"></div>

              <div class="form-group">
                <label for="lblInstrucciones">Descripción</label>
                <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" rows="3" required=""></textarea>
              </div>

              <div class="espacioUno"></div>
              <button type="submit" name="submitGP" class="btn btn-primary btn-sm">Registrar</button>

              <button class="btn btn-secondary btn-sm" onclick="confirmarlimpiado()">Limpiar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/antes-footer.php'); ?>

<div class="espacioAmplio"></div>

<?php include(APPPATH . 'Views/include/footer.php'); ?>
<?php include(APPPATH . 'Views/include/header-js.php'); ?>


<script>
  /*
  $('#unidad_negocio').change(function() {
    var id_unidad = $(this).val();
    $.ajax({
      type: "POST",
      url: "< ?php echo site_url('Alumnos/plantelesUnidadNegocio'); ?>",
      data: "id_unidad_negocio=" + id_unidad,
      success: function(text) {
        document.getElementById("plantel").innerHTML = "";
        $('#plantel').append(text);
      }

    });
  });*/

  $('#maestro').change(function() {
    var id_maestro1 = $(this).val();
    if (id_maestro1 != "") {
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Grupos/ajaxlistadomaestrostipo2'); ?>",
        data: {
          id_maestro1
        },
        success: function(text) {
          document.getElementById("maestro2").innerHTML = "";
          $('#maestro2').append(text);
        }
      });
    } else {
      document.getElementById("maestro2").innerHTML = "";
      $('#maestro2').append('<option value="">Seleccione una opción</option>\
        </select>');
    }
  });


  function confirmarlimpiado() {
    if (confirm("Seguro que quieres limpiar el formulario")) {
      document.getElementById("datosgrupo").reset();
    }
  }

  $('#curso').change(function(){
    var idCurso = $(this).val();
    if(idCurso != ""){
      ObtenerNivelesporCurso(idCurso);

    }else{
      document.getElementById('nivel').innerHTML = "";
      $('#nivel').append('<option value="">Seleccione una opción</option>\
        </select>');
    }

  });

function ObtenerNivelesporCurso(idCurso){

  $.ajax({
        type: "POST",
        url: "<?php echo site_url('Grupos/ajaxListadodeNiveles'); ?>",
        data: {
          idCurso
        },
        success: function(text) {
          document.getElementById("nivel").innerHTML = "";
          $('#nivel').append(text);
        }
      });

  }
</script>