  
  
  $("#activarCargarImagen" ).click(function() {
    let elemento = document.getElementById("activarCargarImagen");
    if( elemento.checked ) {
      $('#agregarImagen').append('<div class="form-group">\
            Cargar imagen <input class="form-control form-control-sm" type="file" id="archivo_imagen" name="archivo_imagen" required="">\
            </div>');    
    }else{
      document.getElementById("agregarImagen").innerHTML = "";
    }
  });
  

$("#activarCargarAudioPregunta" ).click(function() {
  let elemento = document.getElementById("activarCargarAudioPregunta");
  if( elemento.checked ) {
    $('#agregarAudioPregunta').append('<div class="form-group">\
          Cargar Audio <input class="form-control form-control-sm" type="file" id="archivo_audio_pregunta" name="archivo_audio_pregunta" required="">\
          </div>');    
  }else{
    document.getElementById("agregarAudioPregunta").innerHTML = "";
  }
});

  

  $("#tipoPregunta").on ('change', function(e) {
  
  var valor        = $(this).val();
  switch(valor) {
  case "1":
  document.getElementById("agregarCampos").innerHTML = "";
  break;

  case "2":
    var numCampos = 5;
    var i=1;      
    var abcd = new Array("A", "B", "C","D"); 
    document.getElementById("agregarCampos").innerHTML = "";
    if(document.querySelector('#agregarCampos').childElementCount < 1){ 
      
    while (i < numCampos) {
      var nombreCampo = idEvaluacion + '-' + valor + '-' + i; 
      var j = i - 1;
      $('#agregarCampos').append('<div class="form-group mb-2">\
            Opcion '+ i +' <input class="form-control form-control-sm" type="text" id="opcion_'+i+'" name="opcion_'+i+'" value="' + abcd[j] + '" required="">\
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
  document.getElementById("agregarCampos").innerHTML = "";
  if(document.querySelector('#agregarCampos').childElementCount < 1){ 
  var nombreCampo = idEvaluacion + '-' + valor;
  $('#agregarCampos').append('<div class="form-group">\
            Cargar audio <input class="form-control form-control-sm" type="file" id="archivo_audio" name="archivo_audio" required="">\
            </div>');
  }    
  break;

  case "4":
  document.getElementById("agregarCampos").innerHTML = "";
  if(document.querySelector('#agregarCampos').childElementCount < 1){ 
  var nombreCampo = idEvaluacion + '-' + valor;
  $('#agregarCampos').append('<div class="form-group">\
            Cargar video <input  class="form-control form-control-sm" type="file" id="archivo_video" name="archivo_video" required="">\
            </div>');
  }
  break;

  case "5":
  document.getElementById("agregarCampos").innerHTML = "";
  break;
  }
  
  });






  //Imagen
$("#agregarImagen").on('change','input[type="file"]',function(){
var fileName = this.files[0].name;
var fileSize = this.files[0].size;

if(fileSize > 5000000){
  alert('El archivo no debe superar los 5MB');
  this.value = '';
  this.files[0].name = '';
}else{
  var ext = fileName.split('.').pop();
  ext = ext.toLowerCase();
 
  switch (ext) {
    case 'jpg':
    case 'jpeg':
    case 'png':
     break;
    default:
      alert('El la imagen no tiene la extension correcta ');
      this.value = ''; 
      this.files[0].name = '';
  }
}

});

$("#agregarAudioPregunta").on('change','input[type="file"]',function(){
  var fileName = this.files[0].name;
  var fileSize = this.files[0].size;
  
  if(fileSize > 7000000){
    alert('El archivo no debe superar los 7MB');
    this.value = '';
    this.files[0].name = '';
  }else{

    var ext = fileName.split('.').pop();
    ext = ext.toLowerCase();
    

    switch (ext) {
      case 'mp3':
     break;
      default:
        alert('El audio no tiene la extension correcta');
        this.value = ''; 
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

      var ext = fileName.split('.').pop();
      ext = ext.toLowerCase();

      switch (ext) {
        case 'mp3':
       break;
        default:
          alert('El audio no tiene la extension correcta');
          this.value = ''; 
          this.files[0].name = '';
      }
    }
    
    }

if(indice == 4){
  var fileName = this.files[0].name;
var fileSize = this.files[0].size;

if(fileSize > 50000000){
  alert('El archivo no debe superar los 3MB');
  this.value = '';
  this.files[0].name = '';
}else{
  var ext = fileName.split('.').pop();
  ext = ext.toLowerCase();
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



