  
  // Validacion para habialitar un upload y cargar una imagen.
  $("#activarCargarImagen" ).click(function() {
    // detectar si esta seleccionado o deseleccionado
    let elemento = document.getElementById("activarCargarImagen");
    // si esta cheked
    if( elemento.checked ) {
      $('#agregarImagen').append('<div class="form-group">\
            Cargar imagen <input class="form-control form-control-sm" type="file" id="archivo_imagen" name="archivo_imagen" required="">\
            </div>');    
    }else{
      document.getElementById("agregarImagen").innerHTML = "";
    }
  });
  

  

// Validacion para habialitar un upload y cargar un audio.
$("#activarCargarAudioPregunta" ).click(function() {
  // detectar si esta seleccionado o deseleccionado
  let elemento = document.getElementById("activarCargarAudioPregunta");
  // si esta cheked
  if( elemento.checked ) {
    $('#agregarAudioPregunta').append('<div class="form-group">\
          Cargar Audio <input class="form-control form-control-sm" type="file" id="archivo_audio_pregunta" name="archivo_audio_pregunta" required="">\
          </div>');    
  }else{
    document.getElementById("agregarAudioPregunta").innerHTML = "";
  }
});

  
  
  
  // Comienza la logica para agregar los diferentes tipos de campos
  $("#tipoPregunta").on ('change', function(e) {
  var valor        = $(this).val();
  var idEvaluacion = 1;
  function removerDiv(){
  $agregarCampos.parent('div').remove();
  }
  switch(valor) {
  case "1":
  document.getElementById("agregarCampos").innerHTML = "";
  break;
  case "2":
  // Pregunta opcion multiple
    var numCampos = 5;
    var i=1;      
    document.getElementById("agregarCampos").innerHTML = "";
    if(document.querySelector('#agregarCampos').childElementCount < 1){ 
    while (i < numCampos) {
      var nombreCampo = idEvaluacion + '-' + valor + '-' + i;  
      $('#agregarCampos').append('<div class="form-group mb-2">\
            Opcion '+ i +' <input class="form-control form-control-sm" type="text" id="opcion_'+i+'" name="opcion_'+i+'" required="">\
            </div>\
            <div class="form-group mb-2">\
            <input class="form-check-input form-control-sm" type="radio" name="opcion_correcta" id="'+i+'" value="'+i+'">\
            <label class="form-check-label" for="exampleRadios1">\
            Opción correcta <br/><br/><br/>\
            </label>\
            </div>\
            ');
        i++;
      }
    }
  break;
  case "3":
  // Audio
  document.getElementById("agregarCampos").innerHTML = "";
  if(document.querySelector('#agregarCampos').childElementCount < 1){ 
  var nombreCampo = idEvaluacion + '-' + valor;
  $('#agregarCampos').append('<div class="form-group">\
            Cargar audio <input class="form-control form-control-sm" type="file" id="archivo_audio" name="archivo_audio" required="">\
            </div>');
  }    
  break;
  case "4":
  // Video
  document.getElementById("agregarCampos").innerHTML = "";
  if(document.querySelector('#agregarCampos').childElementCount < 1){ 
  var nombreCampo = idEvaluacion + '-' + valor;
  $('#agregarCampos').append('<div class="form-group">\
            Cargar video <input  class="form-control form-control-sm" type="file" id="archivo_video" name="archivo_video" required="">\
            </div>');
  }
  break;
  case "5":
  // Falso o Verdadero
  document.getElementById("agregarCampos").innerHTML = "";
  break;
  }
  
  });













  //Imagen
$("#agregarImagen").on('change','input[type="file"]',function(){
   // this.files[0].size recupera el tamaño del archivo
  // alert(this.files[0].size);
var fileName = this.files[0].name;
var fileSize = this.files[0].size;

if(fileSize > 5000000){
  alert('El archivo no debe superar los 5MB');
  this.value = '';
  this.files[0].name = '';
}else{
  // recuperamos la extensión del archivo
  var ext = fileName.split('.').pop();
  
  // Convertimos en minúscula porque 
  // la extensión del archivo puede estar en mayúscula
  ext = ext.toLowerCase();
  
  // console.log(ext);
  switch (ext) {
    case 'jpg':
    case 'jpeg':
    case 'png':
     break;
    default:
      alert('El la imagen no tiene la extension correcta ');
      this.value = ''; // reset del valor
      this.files[0].name = '';
  }
}

});

//Audio

$("#agregarAudioPregunta").on('change','input[type="file"]',function(){
  var fileName = this.files[0].name;
  var fileSize = this.files[0].size;
  
  if(fileSize > 7000000){
    alert('El archivo no debe superar los 7MB');
    this.value = '';
    this.files[0].name = '';
  }else{
    // recuperamos la extensión del archivo
    var ext = fileName.split('.').pop();
    
    // Convertimos en minúscula porque 
    // la extensión del archivo puede estar en mayúscula
    ext = ext.toLowerCase();
    
    // console.log(ext);
    switch (ext) {
      case 'mp3':
     break;
      default:
        alert('El audio no tiene la extension correcta');
        this.value = ''; // reset del valor
        this.files[0].name = '';
    }
  }

});

//Para tipo de preguntas audio o vidoe 
$("#agregarCampos").on('change','input[type="file"]',function(){
indice = document.getElementById("tipoPregunta").selectedIndex;
if(indice ==3){
 
    var fileName = this.files[0].name;
    var fileSize = this.files[0].size;
    
    if(fileSize > 7000000){
      alert('El archivo no debe superar los 7MB');
      this.value = '';
      this.files[0].name = '';
    }else{
      // recuperamos la extensión del archivo
      var ext = fileName.split('.').pop();
      
      // Convertimos en minúscula porque 
      // la extensión del archivo puede estar en mayúscula
      ext = ext.toLowerCase();
      
      // console.log(ext);
      switch (ext) {
        case 'mp3':
       break;
        default:
          alert('El audio no tiene la extension correcta');
          this.value = ''; // reset del valor
          this.files[0].name = '';
      }
    }
    
    }

//Video 
if(indice == 4){
  var fileName = this.files[0].name;
var fileSize = this.files[0].size;

if(fileSize > 50000000){
  alert('El archivo no debe superar los 3MB');
  this.value = '';
  this.files[0].name = '';
}else{
  // recuperamos la extensión del archivo
  var ext = fileName.split('.').pop();
  
  // Convertimos en minúscula porque 
  // la extensión del archivo puede estar en mayúscula
  ext = ext.toLowerCase();
  
  // console.log(ext);
  switch (ext) {
    case 'mp4':
   break;
    default:
      alert('El video no tiene la extension correcta');
      this.value = ''; // reset del valor
      this.files[0].name = '';
  }
}

}
});



