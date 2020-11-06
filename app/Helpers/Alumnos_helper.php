<?php
use  App\Models\Tipo_usuarios;
use  App\Models\Planteles;
use  App\Models\Unidad_negocio;
use  App\Models\Rolles;
use  App\Models\Alumnos_model;
use  App\Models\Entidades_federativas;

function getTipoUsuarioAlumno()
{
    $usermodel = new Tipo_usuarios($db);
    $query = "SELECT id,nombre FROM  tipo_usuarios WHERE deleted = 0 AND id  = 1";
    $resultado = $usermodel ->query($query);   
    $row = $resultado -> getRow();
     return ($row);
}

function getPlanteles()
{
    $usermodel = new Planteles($db);
    $query = "SELECT id,nombre FROM  planteles WHERE deleted = 0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $usermodel->getResult();
    return($rowArray);
}

function getUnidadNegocio()
{
    $usermodel = new Unidad_negocio($db);
    $query = "SELECT id,nombre FROM  unidad_negocio WHERE deleted = 0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $usermodel->getResult();
    return($rowArray);
}
function getRollAlumno()
{
    $usermodel = new Rolles($db);
    $query = "SELECT id,nombre FROM  rolles WHERE deleted = 0 AND id = 1";
    $resultado = $usermodel ->query($query);   
    $row = $usermodel->getRow();
    return($row);
}

function getAllAlumnos()
{
    $usermodel = new alumnos($db);
    $query = "SELECT * FROM  alumnos WHERE deleted = 0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $usermodel->getResult();
    return($rowArray);   
}

function getEstados()
{
    $usermodel = new Entidades_federativas($db);
    $query = "SELECT id,nombre FROM  entidades_federativas WHERE deleted = 0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $usermodel->getResult();
    return($rowArray);
    
}

?>