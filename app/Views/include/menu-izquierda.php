<?php
$curURL = current_url();

// Menu para Sistema
$collSistema       = strpos($curURL, "Sistema") ?  "collapse show" : "collapse";


// Menu para Catalogos
$collCatalogos     = strpos($curURL, 'Catalogos') ? "collapse show" : "collapse";

// Menu para modulos
$Modulos = ["Recursos"=>1,"Evaluaciones"=>2,"Estudiantes"=>3,"Grupos"=>4,"Ciclos"=>5,"Prospectos"=>6,"Teachers"=>7,"Tutores"=>8,"ClasesDemo"=>9,"Preguntas"=>10];
foreach($Modulos as $a=>$b){
  
  if(strpos($curURL, trim($a))){
    $collModulos  = "collapse show";
    $enlaceActivo = trim($a); 
    echo $enlaceActivo; 
  break;
  }else{
    $collModulos = "collapse";
    $enlaceActivo="";
  }
  
}



$collReportes      = strpos($curURL, 'Reportes') ? "collapse show" : "collapse";

$collIntegraciones = strpos($curURL, 'Integraciones') ? "collapse show" : "collapse";
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
             <li class="list-group-item"><a href="#">Horarios</a></li>
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
             <li class="list-group-item"><a href="#">Estudiantes</a></li>
             <li class="list-group-item"><a href="#">Grupos</a></li>
             <li class="list-group-item"><a href="#">Ciclos</a></li>
             <li class="list-group-item"><a href="#">Prospectos</a></li>
             <li class="list-group-item"><a href="#">Teachers</a></li>
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