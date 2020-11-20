<?php 
use  App\Models\Grupos_recursos_model;
use  App\Models\Grupos_teachers_model;
use  App\Models\Grupos_alumnos_model;


//FUNCIONES DE PRUEBA 

function getGrupoMaestros($id_grupo)
{
    $usermodel = new Grupos_teachers_model($db);
    $query = "SELECT usuarios.id,usuarios.nombre,grupo_teachers.id_grupo from usuarios LEFT JOIN grupo_teachers on usuarios.id = grupo_teachers.id_teacher and grupo_teachers.id_grupo=$id_grupo where usuarios.id_tipo_usuario=3 and usuarios.deleted =0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray); 
   
}

function getGrupoAlumnos($id_grupo)
{
    $usermodel = new Grupos_alumnos_model($db);
    $query = "SELECT usuarios.id,usuarios.nombre,grupo_alumnos.id_grupo FROM usuarios LEFT JOIN grupo_alumnos on usuarios.id = grupo_alumnos.id_alumno and grupo_alumnos.id_grupo=$id_grupo where usuarios.id_tipo_usuario=1 and usuarios.deleted =0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);

}

function getGrupoRecursos($id_grupo)
{
    $usermodel = new Grupos_recursos_model($db);
    $query = "SELECT recursos.id,recursos.nombre,grupo_recursos.id_grupo FROM recursos LEFT JOIN grupo_recursos on recursos.id = grupo_recursos.id_recurso and grupo_recursos.id_grupo=$id_grupo";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);
}











//Funciciones de materiales (recursos asignados a un gpo) con JOIN
function getMateriales($id_grupo)
{
    $usermodel = new Grupos_recursos_model($db);
    $query = "SELECT recursos.nombre,recursos.tipo_archivo,recursos.descripcion FROM recursos inner join grupo_recursos ON recursos.id = grupo_recursos.id_recurso where grupo_recursos.id_grupo = $id_grupo and recursos.deleted=0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
   
     return($rowArray);
}

//Funcion de miembros(Alumnos asignados a un gpo) con JOIN 

function getMiembros($id_grupo)
{
    $usermodel = new Grupos_alumnos_model($db);
    $query = "SELECT usuarios.nombre,usuarios.apellido_paterno,usuarios.apellido_materno, alumnos.matricula FROM usuarios inner join grupo_alumnos ON usuarios.id = grupo_alumnos.id_alumno join alumnos on alumnos.id_usuario = usuarios.id where grupo_alumnos.id_grupo = $id_grupo and usuarios.deleted = 0"; 
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);

}
?>