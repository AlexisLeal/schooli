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

        <?php if ($session->has('Ciclo')) {; ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Notificaciones del sistema:</strong> <?php echo $session->get('Ciclo') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php }
        $session->remove('Ciclo'); ?>



        <h4>Registrar un ciclo.</h4>
        <div class="espacioUno"></div>




        <div class="card">
          <div class="card-body">

            <form action="<?php echo site_url('Ciclos/insertarCiclo'); ?>" method="post">

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
                  Fecha de inicio
                  <input type="date" name="fechaInicio" id="fechaInicio" value="<?php echo date("Y-m-d");?>" class="form-control form-control-sm" required="">

                </div>
                <div class="col">
                  Fecha Fin
                  <input type="date" name="fechaFIn" id="fechaFIn" class="form-control form-control-sm" required="">

                  </select>
                </div>
              </div>


              <div class="espacioUno"></div>

              <div class="form-group">
                <label for="lblInstrucciones">Descripción</label>
                <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" rows="3" required=""></textarea>
              </div>
              <div class="espacioUno"></div>
              <div class="calendar-box" id ="calendar-box" ></div>


              <div class="espacioUno"></div>

              <button type="reset" class="btn btn-primary btn-sm">Limpiar</button>

              <button type="submit" name="submitCL" class="btn btn-primary btn-sm">Registrar</button>

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
<?php include(APPPATH . 'Views/include/header-js.php'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/daterangepicker.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/daterangepicker.js"></script>

<script>
$('#fechaFIn').change(function(){
  var FechaInicio = document.getElementById("fechaInicio").value;
  var FechaFin =  document.getElementById("fechaFIn").value;
  MostraCalendario(FechaInicio,FechaFin);
});

$('#fechaInicio').change(function(){
  var FechaInicio = document.getElementById("fechaInicio").value;
  var FechaFin =  document.getElementById("fechaFIn").value;
  MostraCalendario(FechaInicio,FechaFin);
});


function ComprobarRangoFechas(){
  var Mensaje = '';
  var FechaInicio = document.getElementById("fechaInicio").value;
  var FechaFin = this.value;
  if (FechaFin < FechaInicio) {
    Mensaje = "La fecha final debe ser mayor a la fecha inicio";
    this.setCustomValidity(Mensaje);
  }
  this.setCustomValidity(Mensaje);
}
  var FechaFin = document.querySelector("#fechaFIn");
  FechaFin.addEventListener("invalid", ComprobarRangoFechas);
  FechaFin.addEventListener("input", ComprobarRangoFechas);

function MostraCalendario(FechaInicio,FechaFin){
  if (FechaInicio < FechaFin) {
    var NuevaFechaInicio = FormatoFecha(FechaInicio);
    var NuevaFechaFin = FormatoFecha(FechaFin);
    $('.calendar-box').daterangepicker({
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "",
            "cancelLabel": "",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Custom",
            "daysOfWeek": [
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa",
                "Do"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 0
        },
        "startDate": NuevaFechaInicio,
        "endDate": NuevaFechaFin,
        "minDate":NuevaFechaInicio,
        "maxDate":NuevaFechaFin,
          opens: 'left'
    }, function (start, end, label) {
        $(".calendar-box").html(start.format('DD-MM-YYYY') + " <i class='fas fa-minus'></i> " + end.format('DD-MM-YYYY'));
    });
    
    $('.calendar-box').data('daterangepicker').show();
    $('.calendar-box').data('daterangepicker').hide = function () { };

 
  }else{
    $('#calendar-box').data('daterangepicker').remove();
    
  }
}

function FormatoFecha(texto){
  return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
}
</script>