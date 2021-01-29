<?php include("include/header.php");?>
<div class="view-login">
  <div class="container">
    <div class="espacioDos"></div>
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="background-form">
          <form class="form-signin" action= "<?php echo site_url('/Comprobacion/check'); ?>" method="POST">
            <div class="text-center mb-4">
              <img class="mb-4" src="<?php echo base_url('img-front/logo-app.png');?>" alt="" width="142" height="142">
            </div>
            <?php
            if($session->has('errorcredenciales')){ 
            ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                echo $session->get('errorcredenciales');
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php  
            $session->remove('errorcredenciales');
            $session->destroy(); 
            }
            ?>

            <div class="form-label-group">
              <input type="text" id="credencial" name="credencial" class="form-control inputLogin" placeholder="" required="" autofocus="">
              <span class="labelLogin">Usuario.</span>
            </div>
            <div class="espacioUno"></div>
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="inputPassword" class="form-control inputLogin" required="" placeholder="">
              <span class="labelLogin">Contraseña</span>
            </div>

            <div class="espacioUno"></div>
            <div class="form-label-group">
              <select name="tipo_usuario" id="tipo_usuario"  class="form-control inputLogin" required=""> 
              <option value="">Selecciona una opción</option>
              <?php
                foreach(getTipoUsuario() as $fila){        
                ?>
                <option value="<?php echo $fila->id;?>"> <?php echo $fila->nombre;?> </option>
              <?php } 
              ?>
              </select>
              <span class="labelLogin">Tipo de acceso</span>
              <div class="espacioDos"></div>
            </div>

            <button class="btn btn-md btn-block btn-login" name="login" type="submit">Entrar</button>
            <p class="mt-5 mb-3 text-muted text-center"> © LMS INBI <?php echo date("Y");?></p>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-4">
    </div>
  </div>
</div>
<?php include("include/footer.php");?>