<?php
use  App\Models\Tipo_usuarios;
use  App\Models\Planteles;
use  App\Models\Unidad_negocio;
use  App\Models\Rolles;
use  App\Models\Alumnos_model;
use  App\Models\Entidades_federativas;
use  App\Models\Usuarios; 
use  App\Models\Paises; 

function getPlanteles()
{

    $usermodel = new Planteles($db);
    $query = "SELECT id,nombre FROM  planteles WHERE deleted = 0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);
}




function getUnidadNegocio()
{
    $usermodel = new Unidad_negocio($db);
    $query = "SELECT id,nombre FROM  unidad_negocio WHERE deleted = 0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);
}
function getRollAlumno()
{
    $usermodel = new Rolles($db);
    $query = "SELECT id,nombre FROM  rolles WHERE deleted = 0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);
}

function getAllAlumnos()
{
    $usermodel = new Alumnos_model($db);
    $query = "SELECT * FROM  alumnos WHERE deleted = 0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);   
}

function getEstados()
{
    $usermodel = new Entidades_federativas($db);
    $query = "SELECT id,nombre FROM  entidades_federativas WHERE deleted = 0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);
    
}
function getPaises()
{
    $usermodel = new Entidades_federativas($db);
    $query = "SELECT id,pais FROM  paises";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);
    
}


function getPlanteEspecifico($id_plantel)
{
    $usermodel = new Planteles($db);
    $query = "SELECT nombre FROM  planteles WHERE deleted = 0 AND id = $id_plantel";
    $resultado = $usermodel ->query($query);   
    $row = $resultado->getRow();
    $nombre = $row->nombre;
    return($nombre);
}

function getUnidadNegocioEspecifico($id_unidad_negocio)
{
    $usermodel = new Unidad_negocio($db);
    $query = "SELECT nombre FROM  unidad_negocio WHERE deleted = 0 AND id = $id_unidad_negocio";
    $resultado = $usermodel ->query($query);   
    $row = $resultado->getRow();
    $nombre = $row->nombre;
    return($nombre);
}



function getAlumnoEspecifico($id_usuario)
{
    $usermodel = new Usuarios($db);
    $query = "SELECT * FROM  usuarios WHERE deleted = 0 and id = $id_usuario";
    $resultado = $usermodel ->query($query);   
    $row = $resultado->getRow();
    return($row);   
}


?>