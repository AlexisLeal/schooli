<?php

    if($session->has('notificaciones_usuario')){ 
        
        if(!empty(operacionesGetNotificacionesUsuario())){
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php
                foreach (operacionesGetNotificacionesUsuario() as $fila){
                ?>
                <strong><?php echo $fila->nombre;?>:</strong> <?php echo $fila->notificacion;?>.
                <?php
                }
                ?>
                <button type="button" class="close" onclick="eliminarSessionNotificacion();" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <?php                
        }
    }
?>