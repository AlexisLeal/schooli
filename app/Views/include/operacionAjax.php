
<script>

function eliminarSessionNotificacion(){
 
    $.ajax({
      type: "GET",
      url: "<?php echo site_url('Operaciones/operacioneseliminaSessionNotificacion');?>",
      data: "v="+1,
      success : function(text){

    }
    });
    
  }
 
  </script>
