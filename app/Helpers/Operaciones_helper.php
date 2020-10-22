<?php

use  App\Models\Tipo_usuarios;

function getTipoUsuario()
{
    $usermodel = new Tipo_usuarios($db);
    $query = "Select id,nombre FROM  tipo_usuarios";
    $resultado = $usermodel ->query($query);
    // Lo comvertimos del tipo array 
    $rowArray = $resultado -> getResult();

    #$data['rowArray'] = $rowArray;
    return ($rowArray);
}


?>