<?php 
use  App\Models\Maestros; 
use  App\Models\Usuarios; 

//FuncionOLD
function getAllMaestros2()
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
    $usermodel->select('*');
    $usermodel->where('deleted',0);
    $usermodel->where('id',$id_usuario);
    //$usermodel->where('id_tipo_usuario',3);
    //$query = "SELECT * FROM  usuarios WHERE deleted = 0 and id = $id_usuario";
    // AND id_tipo_usuario = 3 se agrega mas adelante esta linea 
    $resultado = $usermodel->get();   
    $row = $resultado->getRow();
    return($row);   
}


function getAllMaestros()
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('U.nombre, U.apellido_paterno, U.apellido_materno,TH.id,TH.id_usuario,TH.idUnidadNegocio,TH.idPlantel');
    $usermodel->join('maestros TH','U.id = TH.id_usuario and TH.deleted = 0 and U.deleted = 0');
   // $query = "SELECT * from usuarios inner join maestros on usuarios.id = maestros.id_usuario and usuarios.deleted=0";
    $resultado = $usermodel->get();   
    $rowArray = $resultado->getResult();
    return($rowArray); 
}






























?>