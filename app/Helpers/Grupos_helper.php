<?php 
use  App\Models\Grupos_model;

function getAllGrupos()
{
    $usermode = new Grupos_model($db);
    $query = "SELECT * FROM grupos WHERE deleted = 0";
    $resultado = $usermode->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);
}












?>