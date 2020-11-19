<?php
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
function getRoll()
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
    $usermodel = new Paises($db);
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

function getEstadoEspecifico($id_estado)
{
    $usermodel = new Entidades_federativas($db);
    $query = "SELECT nombre FROM  entidades_federativas WHERE deleted = 0 AND id = $id_estado";
    $resultado = $usermodel ->query($query);   
    $row = $resultado->getRow();
    $nombre = $row->nombre; 
    return($nombre);
    
}
function getPaisEspecifico($id_pais)
{
    $usermodel = new Paises($db);
    $query = "SELECT pais FROM  paises WHERE id = $id_pais";
    $resultado = $usermodel ->query($query);   
    $row = $resultado->getRow();
    $nombre = $row->pais;
    return($nombre);
    
}

function getRollEspecifico($id_roll)
{
    $usermodel = new Rolles($db);
    $query = "SELECT nombre FROM  rolles WHERE deleted = 0 AND id= $id_roll";
    $resultado = $usermodel ->query($query);   
    $row = $resultado->getRow();
    $nombre = $row->nombre;
    return($nombre);
}
function getPlantelesPorUNidadNegocio($id_unidad_negocio)
{

    $usermodel = new Planteles($db);
    $query = "SELECT id,nombre FROM  planteles WHERE deleted = 0 AND id_unidad_negocio = $id_unidad_negocio";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);
}

//Funcion nueva de alumnos 

function getAlumnos()
{
    $usermodel = new Alumnos_model($db);
    $query = "SELECT usuarios.id,usuarios.nombre,usuarios.apellido_paterno,usuarios.apellido_materno,alumnos.matricula,alumnos.id_plantel,alumnos.id_unidad_negocio from usuarios inner join alumnos on usuarios.id = alumnos.id_usuario and usuarios.deleted = 0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);  
}

?>