<?php

use  App\Models\Tipo_usuarios;
use  App\Models\Tipo_evaluacion;
use  App\Models\Niveles_evaluacion;
use  App\Models\Lecciones_evaluacion;
use  App\Models\Evaluaciones_model;
use  App\Models\Preguntas;

function getTipoUsuario()
{
    $usermodel = new Tipo_usuarios($db);
    $query = "Select id,nombre FROM  tipo_usuarios";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();

    #$data['rowArray'] = $rowArray;
    return ($rowArray);
}

//Funcion para obtener TODAS la evaluaciones  
function getTipoEvaluacion(){
    $usermodel = new Tipo_evaluacion($db);
    $query = "SELECT id,nombre from tipo_evaluacion";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();
    return ($rowArray);
    
}
//Funcion para obtener TODOS los nivels
function getNivel(){
    $usermodel = new Niveles_evaluacion($db);
    $query = "SELECT id,nombre from niveles_evaluacion";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();
    return ($rowArray);
    
}
//Funcion para tener obtener TODAS las leccion  
function getleccion(){
    $usermodel = new Lecciones_evaluacion($db);
    $query = "SELECT id,nombre from lecciones_evaluacion";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();
    return ($rowArray);
    
}
function estado(){
     //mas adelante se hace un tabla 
}

 function getTotalEvaluacion($id_evaluacion,$nivel)
{//Funcion para obtener un numero de total de evaluaciones por nivel 
    $usermodel = new Evaluaciones_model($db);
    $query = "select * from evaluaciones where tipo_evaluacion = $id_evaluacion AND nivel = $nivel";
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
    $query = "SELECT id,nombre from niveles_evaluacion WHERE id = $id_nivel";
    $resultado = $usermodel ->query($query);
    // el getrow nos regresa una sola fila por eso no utlizamos el getResult que nos regresa un array luego no especificamos el lugar
    $rowArray = $resultado -> getRow();
    return ($rowArray);
    
}

function getTipoEvaluacionEspecifico($id_evaluacion)
{
    $usermodel = new Tipo_evaluacion($db);
    $query = "SELECT id,nombre from tipo_evaluacion WHERE id = $id_evaluacion";
    $resultado = $usermodel ->query($query);
    // el getrow nos regresa una sola fila por eso no utlizamos el getResult que nos regresa un array luego no especificamos el lugar
    $rowArray = $resultado -> getRow();
    return ($rowArray);
    
}
function getTotalEvaluacionLeccion($id_evaluacion,$id_nivel,$id_leccion)
{//Funcion para obtener un numero de total de evaluaciones por seccion 
    $usermodel = new Evaluaciones_model($db);
    $query = "select * from evaluaciones where tipo_evaluacion = $id_evaluacion AND nivel = $id_nivel AND leccion = $id_leccion";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();
    $total = count($rowArray);
    return($total);
    
}

function getEvaluacion($id_evaluacion,$id_nivel,$id_leccion)
{//Funcion para obtener las evaluaciones por el tipo, nivel y leccion  
    $usermodel = new Evaluaciones_model($db);
    $query = "select * from evaluaciones where tipo_evaluacion = $id_evaluacion AND nivel = $id_nivel AND leccion = $id_leccion";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();
    return($rowArray);
    
}

//Obtiene el total de preguntas y su valor total 
function getValorTotalPreguntas($id_evaluacion)
{
    $usermodel = new Preguntas($db);
    //Esta es mas directa pero un poco mas complicada prefiero el viejo metodo esto solo para cosas muy especificas como una suma o un conteo
    $usermodel->SELECT('(SELECT SUM(valor) FROM preguntas WHERE idEvaluacion= '.$id_evaluacion.') as v', FALSE);
    //Forma de ejecutar un query mediante codelgniter 
     $query = $usermodel->get();
     $rowArray = $query -> getRow();
     //Obtiene la primera columna 
    return($rowArray);

}

function getTotalPreguntas($id_evaluacion)
{
    $usermodel = new Preguntas($db);
    $query = "SELECT idEvaluacion FROM preguntas WHERE idEvaluacion= $id_evaluacion";
    $resultado = $usermodel ->query($query);
    $rowArray = $resultado -> getResult();
    $total = count($rowArray);
    return($total);

}
?>