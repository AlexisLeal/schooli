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
//Helpers ayuda atraer todo que contiene una evaluacion 
// Nivel,Leccion,EVALUACION,Preguntas, el tipo de evualuacion y su categoria 
//Tambien que trer todo de una pregunta su tipo y total 
function getTipoUsuario()
{
    $usermodel = new Tipo_usuarios($db);
    $query = "SELECT id,nombre FROM  tipo_usuarios WHERE deleted = 0";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();

    #$data['rowArray'] = $rowArray;
    return ($rowArray);
}

//Funcion para obtener TODAS la evaluaciones  
function getTipoEvaluacion(){
    $usermodel = new Tipo_evaluacion($db);
    $query = "SELECT id,nombre from tipo_evaluacion WHERE deleted = 0";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();
    return ($rowArray);
    
}
//Funcion para obtener TODOS los nivels
function getNivel(){
    $usermodel = new Niveles_evaluacion($db);
    $query = "SELECT id,nombre from niveles_evaluacion WHERE deleted = 0";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();
    return ($rowArray);
    
}
//Funcion para tener obtener TODAS las leccion  
function getleccion(){
    $usermodel = new Lecciones_evaluacion($db);
    $query = "SELECT id,nombre from lecciones_evaluacion WHERE deleted = 0";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();
    return ($rowArray);
    
}

 function getTotalEvaluacion($id_tipo_evaluacion,$nivel)
{//Funcion para obtener un numero de total de evaluaciones por nivel 
    $usermodel = new Evaluaciones_model($db);
    $query = "SELECT * from evaluaciones where tipo_evaluacion = $id_tipo_evaluacion AND nivel = $nivel AND deleted = 0";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();
    $total = count($rowArray);
    return($total);
    
}

//Obtiene un nivel en especifico 
 function getnivelEspecifico($id_nivel)
{
    $usermodel = new Niveles_evaluacion($db);
    $query = "SELECT nombre from niveles_evaluacion WHERE id = $id_nivel AND deleted = 0";
    $resultado = $usermodel ->query($query);
    // el getrow nos regresa una sola fila por eso no utlizamos el getResult que nos regresa un array luego no especificamos el lugar
    $row = $resultado->getRow();
    $nombre = $row->nombre;
    return ($nombre);
    
}

function getTipoEvaluacionEspecifico($id_tipo_evaluacion)
{
    //Nos devuele si es sistema o exci 
    $usermodel = new Tipo_evaluacion($db);
    $query = "SELECT id,nombre from tipo_evaluacion WHERE id = $id_tipo_evaluacion AND deleted = 0";
    $resultado = $usermodel ->query($query);
    // el getrow nos regresa una sola fila por eso no utlizamos el getResult que nos regresa un array luego no especificamos el lugar
    $row = $resultado->getRow();
    return ($row);
    
}
function getTotalEvaluacionLeccion($id_tipo_evaluacion,$id_nivel,$id_leccion)
{//Funcion para obtener un numero de total de evaluaciones por seccion 
    $usermodel = new Evaluaciones_model($db);
    $query = "SELECT * from evaluaciones where tipo_evaluacion = $id_tipo_evaluacion AND nivel = $id_nivel AND leccion = $id_leccion AND deleted = 0";
    $resultado = $usermodel ->query($query);
    // Lo convertimos del tipo array 
    $rowArray = $resultado -> getResult();
    $total = count($rowArray);
    return($total);
    
}

function getEvaluacion($id_tipo_evaluacion,$id_nivel,$id_leccion)
{//Funcion para obtener las evaluaciones por el tipo, nivel y leccion  
    $usermodel = new Evaluaciones_model($db);
    $query = "SELECT * from evaluaciones where tipo_evaluacion = $id_tipo_evaluacion AND nivel = $id_nivel AND leccion = $id_leccion AND deleted = 0";
    $resultado = $usermodel ->query($query);
    // Lo convertimos del tipo array 
    $rowArray = $resultado -> getResult();
    return($rowArray);
    
}

//Obtiene el total de preguntas y su valor total 
function getValorTotalPreguntas($id_evaluacion)
{
    $usermodel = new Preguntas_model($db);
    //Esta es mas directa pero un poco mas complicada prefiero el viejo metodo esto solo para cosas muy especificas como una suma o un conteo
    $usermodel->SELECT('(SELECT SUM(valor) FROM preguntas WHERE idEvaluacion= '.$id_evaluacion.' AND deleted = 0) as v', FALSE);
    //Forma de ejecutar un query mediante codelgniter 
     $query = $usermodel->get();
     $row = $query -> getRow();
     //Obtiene la primera columna 
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
//Funcion para obtener el nombre de usuario que creo una evaluacion     
{
    $usermodel = new Usuarios($db);
    $query = "SELECT nombre,apellido_paterno,apellido_materno from usuarios where id = $id_usuario AND deleted = 0";
     $resultado = $usermodel ->query($query);
     //Obtiene la primera columna  y por eso no utlizamos el getResult
    $rowArray = $resultado -> getRow();
    return($rowArray);
    
}

//Funcion para obtener el tipo de pregunta(abierta, opcion multiple, etc )
function getTipoPreguntas()     
{
    $usermodel = new Tipo_preguntas($db);
    $query = "SELECT id,nombre from tipo_preguntas WHERE deleted = 0";
    $resultado = $usermodel->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);
    
}

//Funcion para obtener la preguntas por evaluacion
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
    $query = "SELECT nombre from categorias_evaluaciones WHERE id = $id_categoria_evaluacion AND deleted = 0";
    $resultado = $usermodel->query($query);
    $row = $resultado->getRow();
    $nombre = $row->nombre;
    return($nombre);
}

function getRecursos()
{
    $usermodel = new Recursos_model($db);
    $query = "SELECT id,nombre,extencion,tipo_archivo,descripcion from recursos WHERE deleted = 0";
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
?>