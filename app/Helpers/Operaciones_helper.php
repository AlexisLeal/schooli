<?php
use  App\Models\Tipo_usuarios;
use  App\Models\Tipo_evaluacion;
use  App\Models\Niveles_evaluacion;
use  App\Models\Lecciones_evaluacion;
use  App\Models\Evaluaciones_model;
use  App\Models\Preguntas_model;
use  App\Models\Usuarios;
use  App\Models\Tipo_preguntas;
use  App\Models\Pregunta_opcion_multiple;
use  App\Models\Pregunta_opcion_audio;
use  App\Models\Pregunta_opcion_video;
use  App\Models\Categorias_Evaluaciones;
use  App\Models\Recursos_model;
use  App\Models\Notificaciones_model;
use  App\Models\Planteles;



function getTipoUsuario()
{
    $usermodel = new Tipo_usuarios($db);
    $query = "SELECT id,nombre FROM  tipo_usuarios WHERE deleted = 0";
    $resultado = $usermodel ->query($query);
    $rowArray = $resultado -> getResult();
    return ($rowArray);
}

function getTipoEvaluacion(){
    $usermodel = new Tipo_evaluacion($db);
    $query = "SELECT id,nombre from tipo_evaluacion WHERE deleted = 0";
    $resultado = $usermodel ->query($query);
    $rowArray = $resultado -> getResult();
    return ($rowArray);
    
}

function getNivel(){
    $usermodel = new Niveles_evaluacion($db);
    $query = "SELECT id,nombre from niveles_evaluacion WHERE deleted = 0";
    $resultado = $usermodel ->query($query);
    $rowArray = $resultado -> getResult();
    return ($rowArray);
    
}

function getleccion(){
    $usermodel = new Lecciones_evaluacion($db);
    $query = "SELECT id,nombre from lecciones_evaluacion WHERE deleted = 0";
    $resultado = $usermodel ->query($query);
    $rowArray = $resultado -> getResult();
    return ($rowArray);
    
}
function OperacionesGetNombreLeccion($idLeccion){
    $usermodel = new Lecciones_evaluacion($db);
    $query = "SELECT nombre from lecciones_evaluacion WHERE deleted = 0 and id = $idLeccion";
    $resultado = $usermodel ->query($query);
    $row = $resultado -> getRow();
    $nombre = $row->nombre;
    return ($nombre);
    
}

function getTotalEvaluacion($id_tipo_evaluacion,$nivel)
{
    $usermodel = new Evaluaciones_model($db);
    $query = "SELECT * from evaluaciones where tipo_evaluacion = $id_tipo_evaluacion AND nivel = $nivel AND deleted = 0";
    $resultado = $usermodel ->query($query);
    $rowArray = $resultado -> getResult();
    $total = count($rowArray);
    return($total);
    
}


 function getnivelEspecifico($id_nivel)
{
    $usermodel = new Niveles_evaluacion($db);
    $query = "SELECT nombre from niveles_evaluacion WHERE id = $id_nivel AND deleted = 0";
    $resultado = $usermodel ->query($query);
    $row = $resultado->getRow();
    $nombre = $row->nombre;
    return ($nombre);
    
}

function getTipoEvaluacionEspecifico($id_tipo_evaluacion)
{
    $usermodel = new Tipo_evaluacion($db);
    $query = "SELECT id,nombre from tipo_recurso_evaluacion WHERE id = $id_tipo_evaluacion AND deleted = 0";
    $resultado = $usermodel ->query($query);
    $row = $resultado->getRow();
    return ($row);
    
}
function getTotalEvaluacionLeccion($id_tipo_evaluacion,$id_nivel,$id_leccion)
{
    $usermodel = new Evaluaciones_model($db);
    $query = "SELECT * from evaluaciones where tipo_evaluacion = $id_tipo_evaluacion AND nivel = $id_nivel AND leccion = $id_leccion AND deleted = 0";
    $resultado = $usermodel ->query($query);
    $rowArray = $resultado -> getResult();
    $total = count($rowArray);
    return($total);
    
}

function getEvaluacion($id_evaluacion)
{ 
    $usermodel = new Evaluaciones_model($db);
    $query = "SELECT * from evaluaciones where id = $id_evaluacion AND deleted = 0";
    $resultado = $usermodel ->query($query);
    $rowArray = $resultado -> getResult();
    return($rowArray);
    
}

function getValorTotalPreguntas($id_evaluacion)
{
    $usermodel = new Preguntas_model($db);
    $usermodel->SELECT('(SELECT SUM(valor) FROM preguntas WHERE idEvaluacion= '.$id_evaluacion.' AND deleted = 0) as v', FALSE);
    $query = $usermodel->get();
    $row = $query -> getRow();
    if(empty($row->v)){
        $valor = 0;
        return($valor);
    }
    return($row->v);
}

function getTotalPreguntas($id_evaluacion)
{
    $usermodel = new Preguntas_model($db);
    $query = "SELECT idEvaluacion FROM preguntas WHERE idEvaluacion= $id_evaluacion and deleted =0";
    $resultado = $usermodel ->query($query);
    $rowArray = $resultado -> getResult();
    $total = count($rowArray);
    return($total);

}

function getUsuarioCreo($id_usuario)      
{
    $usermodel = new Usuarios($db);
    $query = "SELECT nombre,apellido_paterno,apellido_materno from usuarios where id = $id_usuario AND deleted = 0";
    $resultado = $usermodel ->query($query);
    $rowArray = $resultado -> getRow();
    return($rowArray);
    
}

function getTipoPreguntas()     
{
    $usermodel = new Tipo_preguntas($db);
    $query = "SELECT id,nombre from tipo_preguntas WHERE deleted = 0";
    $resultado = $usermodel->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);
    
}

function getPreguntas($id_evaluacion)
{
    $usermodel = new Preguntas_model($db);
    $query = "SELECT * from preguntas where idEvaluacion = $id_evaluacion and deleted=0";
    $resultado = $usermodel->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);
    
}

 function getPreguntaOpcion_multiple($id_evaluacion,$id_pregunta)
{
    $usermodel = new Pregunta_opcion_multiple($db);
    $query = "SELECT idEvaluacion,idPregunta,valor1,valor2,valor3,valor4 from pregunta_opcion_multiple where idEvaluacion=$id_evaluacion and idPregunta=$id_pregunta AND deleted = 0";
    $resultado = $usermodel->query($query);
    $rowArray = $resultado -> getRow();
    return($rowArray);
}


 function getPreguntaOpcion_audio($id_evaluacion,$id_pregunta)
{
    $usermodel = new Pregunta_opcion_audio($db);
    $query = "SELECT idEvaluacion,idPregunta,nombre_audio,ruta_audio from pregunta_opcion_audio WHERE idEvaluacion=$id_evaluacion AND idPregunta=$id_pregunta AND deleted = 0";
    $resultado = $usermodel->query($query);
    $rowArray = $resultado -> getRow();
    return($rowArray);

}

function getPreguntaOpcion_video($id_evaluacion,$id_pregunta)
{
    $usermodel = new Pregunta_opcion_video($db);
    $query = "SELECT idEvaluacion,idPregunta,nombre_video,ruta_video FROM pregunta_opcion_video WHERE idEvaluacion=$id_evaluacion AND idPregunta=$id_pregunta AND deleted = 0";   
    $resultado = $usermodel->query($query);
    $row = $resultado -> getRow();
    if(empty($row)){
        $ruta = null;
        return ($ruta);
    }
    return($row);
  
   
}

function getCategoriaEvaluacion()
{
    $usermodel = new Categorias_Evaluaciones($db);
    $query = "SELECT id,nombre from categorias_evaluaciones WHERE deleted = 0";
    $resultado = $usermodel->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);
}

function getCategoriaEvaluacionEspecifica($id_categoria_evaluacion)
{
    $usermodel = new Categorias_Evaluaciones($db);
    $query = "SELECT nombre from categoria_recurso_evaluacion WHERE id = $id_categoria_evaluacion AND deleted = 0";
    $resultado = $usermodel->query($query);
    $row = $resultado->getRow();
    $nombre = $row->nombre;
    return($nombre);
}

function getRecursos()
{
    $usermodel = new Recursos_model($db);
    $query = "SELECT id,nombre,extencion,tipo_recurso,id_evaluacion,tipo_archivo from recursos WHERE deleted = 0";
    $resultado = $usermodel->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);
}


function operacionesGetNotificaciones()
{
    $usermodel = new Notificaciones_model($db);
    $query = "SELECT n.id,n.nombre,n.notificacion,tu.nombre as usuario,n.estatus,n.fecha_inicio,n.fecha_termina from 
    notificaciones as n join tipo_usuarios as tu on  n.tipo_usuario=tu.id WHERE n.deleted = 0";
    $resultado = $usermodel->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);
}


function operacionesGetNotificacionesUsuario()
{
    $sesion_tipo = $_SESSION['tipo_usuario'];
    $hoy = date("Y-m-d");
    $usermodel = new Notificaciones_model($db);
    $query = "SELECT * from notificaciones WHERE tipo_usuario=$sesion_tipo and estatus=1 and deleted=0 and fecha_termina >='".$hoy."' and fecha_inicio <= '".$hoy."' order by fecha_creacion desc limit 1";
    $resultado = $usermodel->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);
}


function InsertarEvaluacion($id_recurso,$tipo_evaluacion,$categoria_evaluacion,$nombre_evaluacion){

    $usermodel = new Evaluaciones_model($db);
   
    $hoy = date("Y-m-d H:i:s");
    $data = ['nombre' => $nombre_evaluacion,
    'tipo_evaluacion' => $tipo_evaluacion,
    'idCategoriaEvaluacion' => $categoria_evaluacion,
    'id_recurso' => $id_recurso,
    'usuario_creo' => $_SESSION['id'],
    'usuario_modifico' => $_SESSION['id'],
    'fecha_creacion' => $hoy,
    'fecha_ultimo_cambio' => $hoy,
    ];
    //Pornelo en un bloque TryCatch
    $usermodel->insert($data);
    $id_evaluacion = $usermodel->insertID();

    return $id_evaluacion;


}

function InsertaRutaEvaluacion($id_evaluacion,$nombreCurso,$nombreNivel,$nombreSesion)
{
     $hoy = date("Y-m-d H:i:s");
     $usermodel = new Evaluaciones_model($db);
    //Forma de tener la clave 
     $hoyLimpio        = str_replace(' ','',$hoy);
     $hoyLimpio        = str_replace(':','',$hoyLimpio);
     $hoyLimpio        = str_replace('-','',$hoyLimpio);
     $clave ="EV".$id_evaluacion.$hoyLimpio;           
     $nombreRuta = "recursos/$nombreCurso/$nombreNivel/$nombreSesion/$clave";
 
     //Actualizamos para inserta la clave y su ruta 
     $sqlUpdate ="UPDATE evaluaciones set clave = '".$clave."',directorio_uploads='".$nombreRuta."' where id=$id_evaluacion";
     $usermodel->query($sqlUpdate);
 
     //Creamos una carpeta donde se guardaran todos los archivos de la evaluacion(Imagenes,videos etc )
     if (!is_dir("recursos/$nombreCurso/$nombreNivel/$nombreSesion/$clave")) {
         mkdir("recursos/$nombreCurso/$nombreNivel/$nombreSesion/$clave", 0777, TRUE);
     }else{
         echo "Error inesperado";
     }
 
}


function ObtenerRutaEvaluacion($IdEvaluacion)
{
    $UseModelEvaluacion = new Evaluaciones_model($db);
    $UseModelEvaluacion->select('directorio_uploads');
    $UseModelEvaluacion->where('id',$IdEvaluacion);
    $UseModelEvaluacion->where('deleted',0);
    $Query = $UseModelEvaluacion->get();
    $Resultado = $Query->getRow();
    return  $Resultado->directorio_uploads;
    
}

function EliminarEvaluacion($IdEvaluacion)
{
    $UseModelEvaluacion = new Evaluaciones_model($db);
    $UseModelEvaluacion->delete(['id'=>$IdEvaluacion]);
}
function OperacionesObtenerDatosParaEditarEvaluacion($IdEvaluacion)
{
    $UseModelEvaluacion = new Evaluaciones_model($db);
    $UseModelEvaluacion->select('nombre,tipo_evaluacion,idCategoriaEvaluacion');
    $UseModelEvaluacion->where('id',$IdEvaluacion);
    $UseModelEvaluacion->where('deleted',0);
    $query = $UseModelEvaluacion->get();
    return $query->getRow();   
}

function getPlanteles()
{
    $usermodel = new Planteles($db);
    $usermodel->select('id, nombre');
    $usermodel->where('deleted',0);
    $query = $usermodel->get();
    $row = $query->getResult();
    return($row);

}

function getCategoriaRecursoFormulario($id_evaluacion)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('evaluaciones E');
    $usermodel->select('TRE.id,TRE.nombre as nombreTipo,CRE.nombre as nombreCategoria');
    $usermodel->join('tipo_recurso_evaluacion TRE',"E.id=$id_evaluacion and E.tipo_evaluacion=TRE.id");
    $usermodel->join('categoria_recurso_evaluacion CRE',"E.idCategoriaEvaluacion=CRE.id");
    $usermodel->where('E.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getRow();
    return($resultado);
}


?>