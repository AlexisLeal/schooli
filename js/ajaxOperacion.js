
function eliminarSessionNotificacion(){
  alert("Cerrar ventana y con ajax terminar la session");

  $.ajax({
    type: "POST",
    url: "index.php/App/Controllers/Operaciones/eliminarSessionNotificaciones'",
    data: "",
    success : function(text){
      //document.getElementById("plantel").innerHTML = "";
      //$('#plantel').append(text);
  }
  });




}

