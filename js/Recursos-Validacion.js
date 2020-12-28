$("#cargar_recurso_archivo").on('change','input[type="file"]',function(){
var fileName = this.files[0].name;
var fileSize = this.files[0].size;

if(fileSize > 5000000){
  alert('El archivo no debe superar los 5MB, el peso de esté archivo es:' + fileSize);
  this.value         = '';
  this.files[0].name = '';
}else{
  var ext = fileName.split('.').pop();
  ext     = ext.toLowerCase();
  
  switch (ext) {
    case 'docx':
    case 'xlsx':
    case 'pdf':
    case 'zip':
    case 'rar':
    case 'jpg':
    case 'png':
    case 'mp3':
    case 'mp4':
     break;
    default:
      alert('El la imagen no tiene la extension correcta ');
      this.value         = '';
      this.files[0].name = '';
  }
}

});

function eleccion() {
  
  let tipoRecurso = document.getElementById("tipoRecurso").value;
  let contenidoTipoRecurso = document.getElementById("contenidoTipoRecurso");
  let contenidoTipoRecursoFormulario = document.getElementById("contenidoTipoRecursoFormulario");
  if(tipoRecurso==""){
    contenidoTipoRecurso.style.display='none';
    contenidoTipoRecursoFormulario.style.display='none';
  }
  if(tipoRecurso==1){
    contenidoTipoRecurso.style.display='none';
    contenidoTipoRecursoFormulario.style.display='block';
  }
  if(tipoRecurso==2 || tipoRecurso==3 || tipoRecurso==4){
    contenidoTipoRecurso.style.display='block';
    contenidoTipoRecursoFormulario.style.display='none';
  }

}

  