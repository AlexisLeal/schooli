<?php 
use  App\Models\Grupos_recursos_model;

//funcion que trae todos los recursos de un grupo especifico 
function getGrupoRecursosEspecifico($id_grupo)
{
    $usermodel = new Grupos_recursos_model($db);
    $query = "SELECT id_recurso FROM  grupo_recursos WHERE deleted = 0 AND id_grupo = $id_grupo";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);

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