<?php

use  App\Models\Tipo_usuarios;
use  App\Models\Tipo_evaluacion;
use  App\Models\Niveles_evaluacion;
use  App\Models\Lecciones_evaluacion;
use  App\Models\Evaluaciones_model;

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

//Funcion para obtener los evaluaciones
function getTipoEvaluacion(){
    $usermodel = new Tipo_evaluacion($db);
    $query = "SELECT id,nombre from tipo_evaluacion";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();
    return ($rowArray);
    
}
//Funcin para obtener el nivel 
function getNivel(){
    $usermodel = new Niveles_evaluacion($db);
    $query = "SELECT id,nombre from niveles_evaluacion";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();
    return ($rowArray);
    
}
//Funcion para tener el numero de leccion 
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
{
    $usermodel = new Evaluaciones_model($db);
    $query = "select * from evaluaciones where tipo_evaluacion = $id_evaluacion AND nivel = $nivel";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();
    $total = count($rowArray);
    return($total);
    
}


?>