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



        <h4>Editar recursos</h4>
        
        <div class="espacioUno"></div>
        <div class="espacioUno"></div>
        <table>
        <tr>
          <td><a href="<?php echo site_url('/Recursos/recursos'); ?>" ><i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i></a></td>
          <td><a href="<?php echo site_url('/Recursos/recursos'); ?>" >Atras</a></td>
        </tr>
        </table>  
        <div class="espacioUno"></div>

        <div class="card">
          <div class="card-body">
            <?php
            //idCurso
            //idNivel
            //sesion
            ?>
            
            <form action="<?php echo site_url('Recursos/ActualizarRecurso'); ?>" method="post">
            <table width="70%" cellspacing="6" cellpadding="6">
            <?php
            if($tipoRecurso==1){
            ?>
            <tr>
            <td>Tipo de Formulario:</td><td>
            <select class="form-control form-control-sm" name="tipoFormulario" id="tipoFormulario">
                    <option value="">Seleccione una opción</option>
                    <?php foreach(getTipoFormularioRecursos() as $fila){?>
                    <?php
                    if($idTipoEvaluacion==$fila->id){
                    ?>
                    <option value="<?php echo $fila->id;?>" selected="selected"><?php echo $fila->nombre ?></option>
                    <?php
                    }else{
                    ?>
                    <option value="<?php echo $fila->id;?>"><?php echo $fila->nombre ?></option>
                    <?php
                    }
                    ?>
                      <?php }?>
                  </select>
            </td>
            </tr>


            <tr>
            <td>Tipo de aplicación:</td><td>
            <select class="form-control form-control-sm" name="tipocategoriaevaluacion" id="tipocategoriaevaluacion">
                    <option value="">Seleccione una opción</option>
                    <?php foreach(getCategoriaEvaluacionRecursos() as $fila){?>
                        <?php
                    if($idCategoriaEvaluacion==$fila->id){
                    ?>
                    <option value="<?php echo $fila->id;?>" selected="selected"><?php echo $fila->nombre ?></option>
                    <?php
                    }else{
                    ?>
                    <option value="<?php echo $fila->id;?>"><?php echo $fila->nombre ?></option>
                    <?php
                    }
                    ?>
                      <?php }?>
                  </select>
            </td>
            </tr>                    
            <tr>
            <td>Nombre de la evaluación:</td><td>
            <input type="text" class="form-control form-control-sm" name="nombreEvaluacion" id="nombreEvaluacion" value="<?php echo $nombreEvaluacion;?>" required>
            </td>
            </tr>
            <?php
            }
            ?>









            <tr>
            <td>Curso</td>
            <td>
            <select class="form-control form-control-sm" name="curso" id="curso" required>
                    <option value="">Seleccione una opción</option>
                    <?php foreach (CatalagoGetCursos() as $fila) { ?>
                        <?php
                    if($idCurso==$fila->id){
                    ?>
                    <option value="<?php echo $fila->id;?>" selected="selected"><?php echo $fila->nombre ?></option>
                    <?php
                    }else{
                    ?>
                    <option value="<?php echo $fila->id;?>"><?php echo $fila->nombre ?></option>
                    <?php
                    }
                    ?>
                    <?php } ?>
                  </select>
            </td> 
            </tr>
            <tr>
            <td>Nivel</td>
            <td>
            <select class="form-control form-control-sm" name="nivel" id="nivel" required>
                    <option value="">Seleccione una opción</option>
                    <?php for($i=1;$i<=ObtenerNivelesparaCurso($idCurso);$i++){ ?>
                    <?php if($i==$idNivel){ ?>
                        <option value="<?php echo $i;?>" selected="selected"><?php echo $i ?></option>
                    <?php }else{ ?>
                        <option value="<?php echo $i;?>"><?php echo $i ?></option>
                    <?php } }?>
                  </select>
            </td>
            </tr>
            <tr>
            <td>Sesion</td>
            <td>
            <select class="form-control form-control-sm" name="sesion" id="sesion" required>
                  <option value="">Seleccione una opción</option>
                  <?php for($i=1;$i<=ObtenerSesionesparaCurso($idCurso);$i++){ ?>
                    <?php if($i==$sesion){ ?>
                        <option value="<?php echo $i;?>" selected="selected"><?php echo $i ?></option>
                    <?php }else{ ?>
                        <option value="<?php echo $i;?>"><?php echo $i ?></option>
                    <?php } }?>
            </select></td>
            </tr>
            <input type="hidden" name="tipoRecurso" id="tipoRecurso" value="<?php echo $tipoRecurso;?>">
            <input type="hidden" name="idRecurso" id="idRecurso" value="<?php echo $idRecurso;?>">
            <input type="hidden" name="idEvaluacion" id="idEvaluacion" value="<?php echo $idEvaluacion;?>">
            <input type="hidden" name="nombreRecurso" id="nombreRecurso" value="<?php echo $nombreRecurso;?>">
            <tr>
            <td colspan="2">
                <button type="submit" name="actualizarRecurso" class="btn btn-primary btn-sm">Subir</button>
            </td>
            </tr>
            </table>
            </form>
          </div>
        </div>



      </div> <!-- Termina el Div del contenido de enmedio-->




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

<?php include(APPPATH . '/Views/include/header-js.php'); ?>
<?php include(APPPATH . 'Views/include/footer.php'); ?>
<script>
$('#curso').change(function(){
 var Id_Curso = document.getElementById('curso').value;
 if(Id_Curso != ''){

  ObtenerTodosNivelesPorCurso(Id_Curso);
  ObtenerTodasSesionesPorCurso(Id_Curso);

  }
});


function ObtenerTodosNivelesPorCurso(Id_Curso){
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('Recursos/AjaxNiveles'); ?>",
    data: {Id_Curso},
    success: function(text) {
      document.getElementById("nivel").innerHTML = "";
      $('#nivel').append(text);

    }
    });

}

function ObtenerTodasSesionesPorCurso(Id_Curso){
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('Recursos/AjaxSesiones'); ?>",
    data: {Id_Curso},
    success: function(text) {
      document.getElementById("sesion").innerHTML = "";
      $('#sesion').append(text);

    }
    });
}
</script>

