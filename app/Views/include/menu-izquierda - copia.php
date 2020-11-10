<?php
$curURL = current_url();
if(strpos($curURL,"Sistema")){
$collSistema       = "collapse show";
$collIntegraciones = "collapse";
$collCatalogos = "collapse";
$collReportes = "collapse"; 
$collModulos = "collapse";
$enlaceActivo="";
}else if((strpos($curURL,"Catalogos"))){
$Catalogos = ["Ciclos"=>1,"Horarios"=>2,"Niveles"=>3,"Salones"=>4,"Cursos"=>5,"Frecuencias"=>6,
"Sucursales"=>7,"Facultades"=>8,"Carreras"=>9,"Usuarios"=>10,"Roles"=>11,"Integraciones"=>12,"Medios"=>13,
"Canales"=>14,"Origenes"=>15,"Notificaciones"=>16,"Avisos Pop-Up"=>17,"Black List"=>18,"Calendario Anual"=>19,
"Turnos"=>20,"Accesos"=>21,"Materiales"=>22,"Tipo Materiales"=>23,"Categoría Materiales"=>24,"Clases Demo"=>25];

  foreach($Catalogos as $a=>$b){
  
    if(strpos($curURL, trim($a))){
      $collCatalogos  = "collapse show";
      $enlaceActivo = trim($a); 
    break;
    }else{
      $collCatalogos = "collapse";
      $enlaceActivo="";
    }
  }
  $collIntegraciones = "collapse";
  $collSistema = "collapse";
  $collReportes = "collapse"; 
  $collModulos = "collapse";
}else if(strpos($curURL,"Modulos")){
  $Modulos = ["Recursos"=>1,"Evaluaciones"=>2,"Alumnos"=>3,"Grupos"=>4,"Prospectos"=>5,"Teachers"=>6,"Tutores"=>7,"ClasesDemo"=>8,"Preguntas"=>9];
  foreach($Modulos as $a=>$b){
  
    if(strpos($curURL, trim($a))){
      $collModulos  = "collapse show";
      $enlaceActivo = trim($a); 
    break;
    }else{
      $collModulos = "collapse";
      $enlaceActivo="";
    }
  }
  $collIntegraciones = "collapse";
  $collSistema = "collapse";
  $collReportes = "collapse"; 
  $collCatalogos = "collapse";
}else if(strpos($curURL,"Reportes")){
  $collIntegraciones = "collapse";
  $collSistema = "collapse";
  $collReportes = "collapse show"; 
  $collCatalogos = "collapse";
  $collModulos  = "collapse";
  $enlaceActivo="";
}else if(strpos($curURL,"Integraciones")){
  $collIntegraciones = "collapse show";
  $collSistema = "collapse";
  $collReportes = "collapse show"; 
  $collCatalogos = "collapse";
  $collModulos  = "collapse";
  $enlaceActivo="";
}else{
  $collIntegraciones = "collapse";
  $collSistema = "collapse";
  $collReportes = "collapse"; 
  $collCatalogos = "collapse";
  $collModulos  = "collapse";
  $enlaceActivo="";
}




?>












<a data-toggle="collapse" href="#collapseSistema" role="button" aria-expanded="false" aria-controls="collapseSistema">
              <h2 class="titulos-menu">Sistema</h2>
          </a>
          
          <div class="<?php echo $collSistema;?>" id="collapseSistema">
            <ul class="list-group">
              <li class="list-group-item"><a href="#">Configuración Regional</a></li>
              <li class="list-group-item"><a href="#">Información Técnica</a></li>
            </ul>
          </div>
          
          <hr class="linea" />

          <a data-toggle="collapse" href="#collapseCatalogos" role="button" aria-expanded="false" aria-controls="collapseCatalogos">
                <h2 class="titulos-menu">Catalogos</h2>
          </a>

          
          <div class="<?php echo $collCatalogos;?>" id="collapseCatalogos">
           <ul class="list-group">        
           <li class="list-group-item"><a class="<?php if($enlaceActivo=='Ciclos'){echo 'mi-active';}?>" href="<?php echo site_url('Ciclos/index')?>">Ciclos</a></li>
           <li class="list-group-item"><a class="<?php if($enlaceActivo=='Horarios'){echo 'mi-active';}?>" href="<?php echo site_url('Horarios/index')?>">Horarios</a></li>
           <li class="list-group-item"><a class="<?php if($enlaceActivo=='Niveles'){echo 'mi-active';}?>" href="<?php echo site_url('Niveles/index')?>">Niveles</a></li>
           <li class="list-group-item"><a class="<?php if($enlaceActivo=='Salones'){echo 'mi-active';}?>" href="<?php echo site_url('Salones/index')?>">Salones</a></li>
           <li class="list-group-item"><a class="<?php if($enlaceActivo=='Cursos'){echo 'mi-active';}?>" href="<?php echo site_url('Cursos/index')?>">Cursos</a></li>
           <li class="list-group-item"><a class="<?php if($enlaceActivo=='Frecuencias'){echo 'mi-active';}?>" href="<?php echo site_url('Frecuencias/index')?>">Frecuencias</a></li>
           


             
             <li class="list-group-item"><a href="#">Sucursales</a></li>
             <li class="list-group-item"><a href="#">Facultades</a></li>
             <li class="list-group-item"><a href="#">Carreras</a></li>
             <li class="list-group-item"><a href="#">Usuarios</a></li>
             <li class="list-group-item"><a href="#">Roles</a></li>
             <li class="list-group-item"><a href="#">Integraciones</a></li>
             <li class="list-group-item"><a href="#">Medios</a></li>
             <li class="list-group-item"><a href="#">Canales</a></li>
             <li class="list-group-item"><a href="#">Origenes</a></li>
             <li class="list-group-item"><a href="#">Notificaciones</a></li>
             <li class="list-group-item"><a href="#">Avisos Pop-Up</a></li>
             <li class="list-group-item"><a href="#">Black List</a></li>
             <li class="list-group-item"><a href="#">Calendario Anual</a></li>
             <li class="list-group-item"><a href="#">Turnos</a></li>
             <li class="list-group-item"><a href="#">Accesos</a></li>
             <li class="list-group-item"><a href="#">Materiales</a></li>
             <li class="list-group-item"><a href="#">Tipo Materiales</a></li>
             <li class="list-group-item"><a href="#">Categoría Materiales</a></li>
             <li class="list-group-item"><a href="#">Clases Demo</a></li>
           </ul>
          </div>

           <hr class="linea" />
           
           <a data-toggle="collapse" href="#collapseModulos" role="button" aria-expanded="false" aria-controls="collapseModulos">
              <h2 class="titulos-menu">Modulos</h2>
           </a>

            <div class="<?php echo $collModulos;?>" id="collapseModulos">
           <ul class="list-group">
             <li class="list-group-item"><a class="<?php if($enlaceActivo=='Recursos'){echo 'mi-active';}?>" href="<?php echo site_url('Recursos/recursos')?>">Recursos</a></li>
             <li class="list-group-item"><a class="<?php if($enlaceActivo=='Evaluaciones' || $enlaceActivo=='Preguntas'){echo 'mi-active';}?>" href="<?php echo site_url('Evaluaciones/index')?>">Evaluaciones</a></li>
             <li class="list-group-item"><a class="<?php if($enlaceActivo=='Alumnos'){echo 'mi-active';}?>" href="<?php echo site_url('Alumnos/index')?>">Alumnos</a></li>
             <li class="list-group-item"><a href="#">Empleados</a></li>
             <li class="list-group-item"><a href="#">Roles</a></li>
             <li class="list-group-item"><a class="<?php if($enlaceActivo=='Grupos'){echo 'mi-active';}?>" href="<?php echo site_url('Grupos/index')?>">Grupos</a></li>
             <li class="list-group-item"><a href="#">Prospectos</a></li>
             <li class="list-group-item"><a class="<?php if($enlaceActivo=='Teachers'){echo 'mi-active';}?>" href="<?php echo site_url('Teachers/index')?>">Teachers</a></li>
             <li class="list-group-item"><a href="#">Tutores</a></li>
             <li class="list-group-item"><a href="#">Clase Demo</a></li>
           </ul>
           </div>
           <hr class="linea" />
           
           <a data-toggle="collapse" href="#collapseReportes" role="button" aria-expanded="false" aria-controls="collapseReportes">
            <h2 class="titulos-menu">Reportes</h2>
           </a>

           <div class="<?php echo $collReportes;?>" id="collapseReportes">
          <ul class="list-group">
             <li class="list-group-item"><a href="#">Reporte 1</a></li>
             <li class="list-group-item"><a href="#">Reporte 2</a></li>
           </ul>
           </div>
           <hr class="linea" />

           <a data-toggle="collapse" href="#collapseIntegraciones" role="button" aria-expanded="false" aria-controls="collapseIntegraciones">
              <h2 class="titulos-menu">Integraciones</h2>
           </a>


           <div class="<?php echo $collIntegraciones;?>" id="collapseIntegraciones">
            <ul class="list-group">
             <li class="list-group-item"><a href="#">Estados de cuenta.</a></li>
             <li class="list-group-item"><a href="#">Pagos en esta plataforma</a></li>
           </ul>
           </div>