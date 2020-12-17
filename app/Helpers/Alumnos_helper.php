<?php
use  App\Models\Planteles;
use  App\Models\Unidad_negocio;
use  App\Models\Rolles;
use  App\Models\Alumnos_model;
use  App\Models\Entidades_federativas;
use  App\Models\Usuarios;  
use  App\Models\Paises; 


function getUnidadNegocio()
{
    $usermodel = new Unidad_negocio($db);
    $usermodel->select('id, nombre');
    $usermodel->where('deleted',0);
    $query = $usermodel ->get();
    $rowArray = $query->getResult();
    return($rowArray);
}

function getRoll()
{
    $usermodel = new Rolles($db);
    $usermodel->select('id, nombre');
    $usermodel->where('deleted',0);
    $query = $usermodel ->get();
    $rowArray = $query->getResult();
    return($rowArray);
}
//Verificar
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
    $usermodel->select('id, nombre');
    $usermodel->where('deleted',0);
    $query = $usermodel ->get();
    $rowArray = $query->getResult();
    return($rowArray);
}
function getPaises()
{
    $usermodel = new Paises($db);
    $usermodel->select('id, pais');
    $query = $usermodel ->get();
    $rowArray = $query->getResult();
    return($rowArray);
}


function getPlanteEspecifico($id_plantel)
{
    $usermodel = new Planteles($db);
    $usermodel->select('nombre');
    $usermodel->where('deleted',0);
    $usermodel->where('id',$id_plantel);
    $query = $usermodel->get();
    $row = $query->getRow();
    $nombre = $row->nombre;
    return($nombre);
}

function getUnidadNegocioEspecifico($id_unidad_negocio)
{
    $usermodel = new Unidad_negocio($db);
    $usermodel->select('nombre');
    $usermodel->where('deleted',0);
    $usermodel->where('id',$id_unidad_negocio);
    $query = $usermodel->get();
    $row = $query->getRow();
    $nombre = $row->nombre;
    return($nombre);
}

function getAlumnoEspecifico($id_usuario)
{
    $usermodel = new Usuarios($db);
    $usermodel->select('*');
    $usermodel->where('deleted',0);
    $usermodel->where('id',$id_usuario);
    $query = $usermodel->get();
    $row = $query->getRow();
    return($row);
}

function getEstadoEspecifico($id_estado)
{
    $usermodel = new Entidades_federativas($db);
    $usermodel->select('nombre');
    $usermodel->where('deleted',0);
    $usermodel->where('id',$id_estado);
    $query = $usermodel->get();
    $row = $query->getRow();
    $nombre = $row->nombre;
    return($nombre);
}
function getPaisEspecifico($id_pais)
{
    $usermodel = new Paises($db);
    $usermodel->select('pais');
    $usermodel->where('id',$id_pais);
    $query = $usermodel->get();
    $row = $query->getRow();
    $nombre = $row->pais;
    return($nombre);
}

function getRollEspecifico($id_roll)
{
    $usermodel = new Rolles($db);
    $usermodel->select('nombre');
    $usermodel->where('deleted',0);
    $usermodel->where('id',$id_roll);
    $query = $usermodel->get();
    $row = $query->getRow();
    $nombre = $row->nombre;
    return($nombre);
}

function getPlantelesPorUNidadNegocio($id_unidad_negocio)
{
    $usermodel = new Planteles($db);
    $usermodel->select('id, nombre');
    $usermodel->where('deleted',0);
    $usermodel->where('id_unidad_negocio',$id_unidad_negocio);
    $query = $usermodel->get();
    $row = $query->getResult();
    return($row);

}

//Funcion nueva de alumnos 
function getAlumnos()
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('AL.id, U.nombre, U.apellido_paterno, U.apellido_materno, AL.matricula, AL.id_plantel, AL.id_unidad_negocio');
    $usermodel->join('alumnos AL','U.id = AL.id_usuario and U.deleted = 0 ');
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
}

?>