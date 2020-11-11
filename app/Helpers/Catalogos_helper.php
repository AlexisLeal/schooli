<?php 
use  App\Models\Ciclos_model;
use  App\Models\Horarios_model;
use  App\Models\Niveles_grupo;
use  App\Models\Salones_model;
use  App\Models\Cursos_model;


function getAllCiclo()
{
    $usermode = new Ciclos_model($db);
    $query = "SELECT * FROM ciclos WHERE deleted = 0";
    $resultado = $usermode->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);
}
function getCicloEspecifico($id_ciclo)
{
    $usermode = new Ciclos_model($db);
    $query = "SELECT * FROM ciclos WHERE deleted = 0 AND id = $id_ciclo";
    $resultado = $usermode->query($query);
    $row = $resultado->getRow();
    return($row);
}

function getAllHorarios()
{       
    $usermode = new Horarios_model($db);
    $query = "SELECT * FROM horarios WHERE deleted = 0";
    $resultado = $usermode->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);
}
function getHorarioEspecifico($id_horario)
{       
    $usermode = new Horarios_model($db);
    $query = "SELECT * FROM horarios WHERE deleted = 0 AND id = $id_horario";
    $resultado = $usermode->query($query);
    $row = $resultado->getRow();
    return($row);
}
 function getAllNiveles()
{
    $usermode = new Niveles_grupo($db);
    $query = "SELECT * FROM niveles_grupo WHERE deleted = 0";
    $resultado = $usermode->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);

}

function getNivelEspecificogrupo($id_nivel)
{
    $usermode = new Niveles_grupo($db);
    $query = "SELECT * FROM niveles_grupo WHERE deleted = 0 AND id = $id_nivel";
    $resultado = $usermode->query($query);
    $row = $resultado->getRow();
    return($row);

}
function getAllSalones()
{
    $usermode = new Salones_model($db);
    $query = "SELECT * FROM salones WHERE deleted = 0";
    $resultado = $usermode->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);

}

function getSalonEspecificogrupo($id_nivel)
{
    $usermode = new Salones_model($db);
    $query = "SELECT * FROM salones WHERE deleted = 0 AND id = $id_nivel";
    $resultado = $usermode->query($query);
    $row = $resultado->getRow();
    return($row);

}

function getAllCursos()
{
    $usermode = new Cursos_model($db);
    $query = "SELECT * FROM cursos WHERE deleted = 0";
    $resultado = $usermode->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);

}

function getCursoEspecifico($id_curso)
{
    $usermode = new Cursos_model($db);
    $query = "SELECT * FROM cursos WHERE deleted = 0 AND id = $id_curso";
    $resultado = $usermode->query($query);
    $row = $resultado->getRow();
    return($row);

}
 

 
















?>