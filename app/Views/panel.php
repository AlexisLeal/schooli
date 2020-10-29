<?php include('include/header.php');?>

<div class="espacioDos"></div>
<header>

<div class="container">
  <div class="row">
    <div class="col-md-4"><img class="mb-4" src="<?php echo base_url('img-front/logo-app.PNG');?>" alt="" width="72" height="72"></div>
    <div class="col-md-4">
    <form>
    <input type="text" class="form-control buscador">
    </form>
    

    </div>
    <div class="col-md-4 text-right"> 
    <i class="fa fa-cog" aria-hidden="true"></i> 
    <i class="fa fa-shopping-cart" aria-hidden="true"></i>  
    <i class="fa fa-bell-o fa-1x" aria-hidden="true"></i> 
    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
    <?php //echo $session->get('nombre')?> <?php //echo $session->get('apellido')?>  
    <!-- <a href="<?php //echo site_url('/Home/salir'); ?>"> -->
    <!-- <i class="fa fa-sign-out" aria-hidden="true"></i> </a>-->
  </div>
  </div>
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

      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <table width="100%">
          <tr>
          <td><div class="text-center"><a href="<?php echo site_url('/Evaluaciones/index'); ?>"><i class="fa fa-file-text-o fa-3x" aria-hidden="true"></i><br/>Evaluaciones.</a></div></td>
          <td><div class="text-center"><a href="<?php echo site_url('/Grupos/index'); ?>"><i class="fa fa-users fa-3x" aria-hidden="true"></i><br/>Grupos.</a></div></td>
          <td><div class="text-center"><a href="<?php echo site_url('/Alumnos/index'); ?>"><i class="fa fa-user fa-3x" aria-hidden="true"></i><br/>Alumnos.</a></div></td>
          </tr>
          <tr>
          <td><div class="text-center"><a href="<?php echo site_url('/Ciclos/index'); ?>"><i class="fa fa-circle-o-notch fa-3x" aria-hidden="true"></i><br/>Ciclos.</a></div></td>
          <td><div class="text-center"><a href="<?php echo site_url('/Teacher/index'); ?>"><i class="fa fa-user-circle-o fa-3x" aria-hidden="true"></i><br/>Teachers.</a></div></td>
          <td><div class="text-center"><a href="<?php echo site_url('/Tutores/index'); ?>"><i class="fa fa-user-secret fa-3x" aria-hidden="true"></i><br/>Tutores.</a></div></td>
          </tr>
          </table>

          </div>
        </div>

       
      </div>

    
<?php include("include/footer.php");?>