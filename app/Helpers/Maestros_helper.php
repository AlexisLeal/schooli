<?php 
use  App\Models\Usuarios; 

//FuncionOLD
function getMaestroEspecifico($id_usuario)
{
    $usermodel = new Usuarios($db);
    $usermodel->select('nombre');
    $usermodel->where('deleted',0);
    $usermodel->where('id',$id_usuario);
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
    $resultado = $usermodel->get();   
    $rowArray = $resultado->getResult();
    return($rowArray); 
}
function MaestrosGetAllMaestros()
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('U.nombre, U.apellido_paterno, U.apellido_materno,TH.id_usuario');
    $usermodel->join('maestros TH','U.id = TH.id_usuario and TH.deleted = 0 and U.deleted = 0');
    $resultado = $usermodel->get();   
    $rowArray = $resultado->getResult();
    return($rowArray); 
}

?>