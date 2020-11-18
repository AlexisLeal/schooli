<?php 
use  App\Models\Grupos_recursos_model;

//funcion que trae todos los recursos de un grupo especifico 
function getGrupoRecursosEspecifico($id_grupo,$id_recurso)
{
    $usermodel = new Grupos_recursos_model($db);
    $query = "SELECT * FROM  grupo_recursos WHERE deleted = 0 AND id_grupo = $id_grupo AND id_recurso = $id_recurso";
    $resultado = $usermodel ->query($query);   
    $row = $resultado->getRow();
    return($row);

}

function getRecursosAvailable($id_grupo)
{
    $posicion = 0;
    $all = getRecursos();
    foreach(getRecursos() as $fila){
        foreach(getGrupoRecursosEspecifico($id_grupo) as $filaR){
                if($fila->id == $filaR->id_recurso){
                    unset($all[$posicion]);
                }
        }

        $posicion++;
    }
        return($all);



}

?>