<?php 
use  App\Models\Maestros; 
use  App\Models\Usuarios; 

function getAllMaestros()
{
    $usermodel = new Maestros($db);
    $query = "SELECT * FROM  maestros WHERE deleted = 0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray); 
}

function getMaestroEspecifico($id_usuario)
{
    $usermodel = new Usuarios($db);
    $query = "SELECT * FROM  usuarios WHERE deleted = 0 and id = $id_usuario";
    $resultado = $usermodel ->query($query);   
    $row = $resultado->getRow();
    return($row);   
}





























?>