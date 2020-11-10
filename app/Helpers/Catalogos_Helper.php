<?php 
use  App\Models\Ciclos_model;

function getAllCiclo()
{
    $usermode = new Ciclos_model($db);
    $query = "SELECT * FROM ciclos WHERE deleted = 0";
    $resultado = $usermode->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);
}


 
















?>