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
    // AND id_tipo_usuario = 3 se agrega mas adelante esta linea 
    $resultado = $usermodel ->query($query);   
    $row = $resultado->getRow();
    return($row);   
}





























?>