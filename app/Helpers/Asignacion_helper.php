<?php 
use  App\Models\Grupos_recursos_model;
use  App\Models\Grupos_teachers_model;
use  App\Models\Grupos_alumnos_model;

//funcion que trae todos los recursos de un grupo especifico 
function getGrupoRecursosEspecifico($id_grupo,$id_recurso)
{
    $usermodel = new Grupos_recursos_model($db);
    $query = "SELECT * FROM  grupo_recursos WHERE deleted = 0 AND id_grupo = $id_grupo AND id_recurso = $id_recurso";
    $resultado = $usermodel ->query($query);   
    $row = $resultado->getRow();
    return($row);

}

function getGrupoTeacherEspecifico($id_grupo,$id_teacher)
{
    $usermodel = new Grupos_teachers_model($db);
    $query = "SELECT * FROM  grupo_teachers WHERE deleted = 0 AND id_grupo = $id_grupo AND id_teacher = $id_teacher";
    $resultado = $usermodel ->query($query);   
    $row = $resultado->getRow();
    return($row);



}
function getGrupoAlumnoEspecifico($id_grupo,$id_alumno)
{
    $usermodel = new Grupos_alumnos_model($db);
    $query = "SELECT * FROM  grupo_alumnos WHERE deleted = 0 AND id_grupo = $id_grupo AND id_alumno = $id_alumno";
    $resultado = $usermodel ->query($query);   
    $row = $resultado->getRow();
    return($row);



}

?>