<?php 
use  App\Models\Ciclos_model;
use  App\Models\Horarios_model;

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

 
















?>