<?php include(APPPATH.'/Views/include/header.php');?>
<style>
#banner {
  padding-top:5px;
  background: rgb(15,98,172);
background: linear-gradient(90deg, rgba(15,98,172,1) 0%, rgba(23,149,235,1) 50%, rgba(18,106,171,1) 100%);
height:270px;
}
</style>
  </head>
  <body>



<header>
<div class="container">
  <div class="row">
    <div class="col-md-4"><img class="mb-4" src="img/logo-nueva-version.jpg" alt="" width="112" height="112"></div>
    <div class="col-md-4">
    
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    
    </ul>

  </div>
</nav>
    </div>
    <div class="col-md-4 text-right"> Hola <?php echo $session->get('nombre')?> <?php echo $session->get('apellido')?>  <a href="<?php echo site_url('/Home/salir'); ?>"> Salir <i class="fa fa-sign-out" aria-hidden="true"></i> </a></div>
  </div>
  <!--<div class="row">
    <div class="col-md-6">.col-md-6</div>
    <div class="col-md-6">.col-md-6</div>
  </div>-->
</div>
  </header>
     
    <!--Ejemplo tabla con DataTables-->
    <div id="banner">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            
          </div>
        </div>  
      </div>
    </div>


<?php
// aqui se esta obteniendo el valor del id de la tabla de usuarios

// Este contenido se mostrar si el tipo de usuario registrado es un editor
?>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <div class="table-responsive">
          <a href="<?php echo site_url('/Panel/index'); ?>">Panel</a><br/>
          <a href="<?php echo site_url('/Evaluaciones/crear_evaluacion'); ?>">Crear evaluaciones.</a><br/>
          <!--Hay que modificar este de crear evaluacion -->
          <a href="<?php echo site_url('/Evaluaciones/index'); ?>">Tipo Evaluaciones </a> <br>
          <a href="niveles.php>">Niveles.</a><br/>
          <a href="lecciones.php>">Lecciones.</a><br/>
          <br/>
            Evaluaciones:<br/>
  <!--
  ##################
  ################## Inicia la tabla
  ##################

  -->



  <table id="t01" class="display">
    <thead>
  <tr>
  <th>ID</th>

  <th>Nombre</th>
  <th>Tipo Evaluacion</th>

  <th>Numero de preguntas</th>
  <th>Valor total</th>
  <th>Estado</th>

  <th>Ver</th>
  <th>Editar</th>
  <th>Agregar preguntas</th>
  </tr>
  </thead>
  <tbody>
<?php
   $nombreEvaluaciones = getTipoEvaluacionEspecifico($id_evaluacion);//obtiene si es sistema o exci 
//Estos paremetros nos lo pasen el contralador
foreach(getEvaluacion($id_evaluacion,$id_nivel,$id_leccion) as $fila){
  $valor =getValorTotalPreguntas($fila->id);
  $usuarioCreo =getUsuarioCreo($fila->usuario_creo);
  //MUY IMPORTANTE ESTE FUNCION 
 
    ?>
    <tr>
    <td><?php echo $fila->id;?></td>

    <td><?php echo $fila ->nombre;?></td>
    <td><?php echo $nombreEvaluaciones->nombre;?></td>
    
    <td><?php echo getTotalPreguntas($fila->id);?></td>
    <td><?php echo $valor->v;?></td>
    <td><?php if($fila->estado == 1){
      echo "Activo";
      $estado = "Activo";
    }else{
      echo "Inactivo";
      $estado = "Inactivo";
    } ?></td>

    <td class="text-center"><a href="examen.php"><i class="fa fa-file-text-o" aria-hidden="true"></a></i></td>
    <td class="text-center"><a href="examen.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>

    <td class="text-center">
    <form action="<?php echo site_url('Preguntas/agregar_preguntas')?>" name="" id="" method="post">
    <input type="hidden" name="id_e" id="id_e" value="<?php echo $fila->id;?>">
    <input type="hidden" name="nombre" id="nombre" value="<?php echo $fila ->nombre;?>">
    <input type="hidden" name="nombre_tipo_evaluacion" id="nombre_tipo_evaluacion" value="<?php echo $nombreEvaluaciones->nombre;?>">
    <input type="hidden" name="usuario_creo" id="usuario_creo" value="<?php echo $usuarioCreo->nombre .' '.$usuarioCreo->apellido_paterno;?>">
    <input type="hidden" name="estado" id="estado" value="<?php echo $estado;?>">
    <input type="hidden" name="clave" id="clave" value="<?php echo $fila ->clave;?>">
    <input type="hidden" name="valorpreguntas" id="du" value="<?php echo $valor->v;?>">
    <input type="hidden" name="totalpreguntas" id="du" value="<?php echo getTotalPreguntas($fila->id);?>">
    <input type="hidden" name="idtipoevaluacion" value="<?php echo $id_evaluacion;?>">
    <input type="hidden" name="nivel" value="<?php echo $id_nivel;?>">
    <input type="hidden" name="leccion"  value="<?php echo $id_leccion;?>">
    <button type="submit" name="submitAP" id="submitAP"><i class="fa fa-plus-circle" aria-hidden="true"></a></i></span></button>
    </form>
    </td>
    
    </tr>
 
  <?php
  }
  ?>
  </tbody>
  </table>
  <br/>
  <br/>
  <br/>
            

  </div>
          </div>
        </div>  
      </div>



<script src="js/jquery/jquery-3.3.1.min.js"></script>
<script type="text/script" src="js/popper/popper.min"></script>
<script type="text/script" src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="DataTables/datatables.min.js"></script>


<script type="text/javascript" src="DataTables/Buttons-1.6.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="DataTables/Buttons-1.6.4/js/buttons.html5.min"></script>

    
<script>
$(document).ready(function() {    
    $('#t01').DataTable({
    //para cambiar el lenguaje a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
            responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
          {
            extend:    'excelHtml5',
            text:      '<i class="fa fa-file-excel-o"></i> ',
            titleAttr: 'Exportar a Excel',
            className: 'btn btn-success'
          },
          {
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf-o"></i> ',
            titleAttr: 'Exportar a PDF',
            className: 'btn btn-danger'
          },
          {
            extend:    'print',
            text:      '<i class="fa fa-print"></i> ',
            titleAttr: 'Imprimir',
            className: 'btn btn-info'
          },
		]	





    });     
});


</script>
<?php include(APPPATH.'Views/include/footer.php');?>