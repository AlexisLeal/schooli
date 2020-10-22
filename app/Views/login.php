<?php include("include/header.php");?>
<?php if($this->session->get('login')){
            
  }
  ?>
<div class="container">
  <div class="row">
  
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <form class="form-signin" action= "<?php echo site_url('/Comprobacion/check'); ?>" method="POST">
      <div class="text-center mb-4">

        
        <img class="mb-4" src="img/logo-nueva-version.jpg" alt="" width="182" height="182">
        <h1 class="h3 mb-3 font-weight-normal"><font style="vertical-align: inherit;">
        
        <font style="vertical-align: inherit;">Acceso Restringido</font></font></h1>
        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Éste sistema es esclusivo del Instituto Neurolingüistico Bilingüe </font></font>
        <code>:Derechos Reservados</code><font style="vertical-align: inherit;">
        <font style="vertical-align: inherit;">  </font></font>
        <a href="https://caniuse.com/#feat=css-placeholder-shown">
        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Funciona en las últimas versiones de Chrome, Safari y Firefox.</font></font></a></p>
      </div>

      <div class="form-label-group">
        <input type="text" id="credencial" name="credencial" class="form-control" placeholder="" required="" autofocus="">
        <label for="inputEmail"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Matricula, Usuario ó Correo electrónico</font></font></label>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" required="" placeholder="">
        <label for="inputPassword"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Contraseña</font></font></label>
      </div>

      <div class="form-label-group">
        <select name="tipo_usuario" id="tipo_usuario"  class="form-control" required=""> 
        <!--required="" Forma temporal-->
        <option value="">Selecciona una opción</option>
        <?php
          $tipo = getTipoUsuario();
            foreach($tipo as $fila){
        
              ?>
              <option value="<?php echo $fila->id;?>"> <?php echo $fila->nombre;?> </option>         
          
        <?php } 
        ?>
        
        </select>
        <label for="inputPassword"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tipo de acceso</font></font></label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" name="login" type="submit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Entrar</font></font></button>
      <p class="mt-5 mb-3 text-muted text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">© INBI</font></font></p>
    </form>
  </div>
  </div>

  <div class="col-md-4">
  </div>
  
  </div>

<?php include("include/footer.php");?>