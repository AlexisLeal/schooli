$("#cargar_recurso_archivo").on('change','input[type="file"]',function(){
var fileName = this.files[0].name;
var fileSize = this.files[0].size;

if(fileSize > 5000000){
  alert('El archivo no debe superar los 5MB');
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



