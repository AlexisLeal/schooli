<?php 
use  App\Models\Grupos_recursos_model;
use  App\Models\Grupos_teachers_model;
use  App\Models\Grupos_alumnos_model;
use  App\Models\Recursos_model;


//FUNCIONES DE PRUEBA 

function getGrupoMaestros($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
   //$usermodel = new Grupos_teachers_model($db);
    $usermodel->select('U.id, U.nombre, G_TH.id_grupo');
    $usermodel->join('grupo_teachers G_TH',"U.id = G_TH.id_teacher and G_TH.id_grupo = $id_grupo and G_TH.deleted = 0",'left');
    $usermodel->where('U.id_tipo_usuario',3);
    $usermodel->where('U.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
    
    /* $query = "SELECT usuarios.id,usuarios.nombre,grupo_teachers.id_grupo from usuarios LEFT JOIN grupo_teachers on usuarios.id = grupo_teachers.id_teacher and grupo_teachers.id_grupo=$id_grupo and grupo_teachers.deleted=0 where usuarios.id_tipo_usuario=3 and usuarios.deleted =0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray); 
   */
}

function getGrupoMaestrosEliminar($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
   //$usermodel = new Grupos_teachers_model($db);
    $usermodel->select('G_TH.id, U.nombre, G_TH.id_grupo');
    $usermodel->join('grupo_teachers G_TH',"U.id = G_TH.id_teacher and G_TH.id_grupo = $id_grupo and G_TH.deleted = 0");
    $usermodel->where('U.id_tipo_usuario',3);
    $usermodel->where('U.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
}





//Para agregar y ver los que estan agregados 
function getGrupoAlumnos($id_grupo)
{
    
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('U.id,U.nombre,G_AL.id_grupo');
    $usermodel->join('grupo_alumnos G_AL',"U.id = G_AL.id_alumno and G_AL.id_grupo = $id_grupo and G_AL.deleted = 0",'left');
    $usermodel->where('U.id_tipo_usuario',1);
    $usermodel->where('U.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
    /*
    $usermodel = new Grupos_alumnos_model($db);
    $query = "SELECT usuarios.id,usuarios.nombre,grupo_alumnos.id_grupo FROM usuarios LEFT JOIN grupo_alumnos on usuarios.id = grupo_alumnos.id_alumno and grupo_alumnos.id_grupo=$id_grupo and grupo_alumnos.deleted = 0 where usuarios.id_tipo_usuario=1 and usuarios.deleted =0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);
*/
}

function getGruposEvaluacion($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('evaluaciones EV');
    $usermodel->select('EV.nombre');
    $usermodel->join('grupo_evaluacion G_EV',"EV.id = G_EV.id_evaluacion and G_EV.id_grupo = $id_grupo and G_EV.deleted = 0",);
    $usermodel->where('EV.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
}




//Para eliminar a un alumno de un grupoAlumnos
function getGrupoAlumnosEliminar($id_grupo)
{
    
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('G_AL.id,U.nombre,G_AL.id_grupo');
    $usermodel->join('grupo_alumnos G_AL',"U.id = G_AL.id_alumno and G_AL.id_grupo = $id_grupo and G_AL.deleted = 0");
    $usermodel->where('U.id_tipo_usuario',1);
    $usermodel->where('U.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);

}

function getGrupoRecursos($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('recursos R');
    $usermodel->select('R.id, R.nombre, G_RC.id_grupo');
    $usermodel->join('grupo_recursos G_RC',"R.id = G_RC.id_recurso and G_RC.id_grupo = $id_grupo and G_RC.deleted = 0",'left');
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);


/*
    $usermodel = new Grupos_recursos_model($db);
    $query = "SELECT recursos.id,recursos.nombre,grupo_recursos.id_grupo FROM recursos LEFT JOIN grupo_recursos on recursos.id = grupo_recursos.id_recurso and grupo_recursos.id_grupo=$id_grupo and grupo_recursos.deleted=0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);
*/
}

function getGrupoRecursosEliminar($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('recursos R');
    $usermodel->select('G_RC.id, R.nombre, G_RC.id_grupo');
    $usermodel->join('grupo_recursos G_RC',"R.id = G_RC.id_recurso and G_RC.id_grupo = $id_grupo and G_RC.deleted = 0");
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
}








//Funciciones de materiales (recursos asignados a un gpo) con JOIN
function getMateriales($id_grupo)
{
   $db = \Config\Database::connect();
   $usermodel = $db->table('recursos R');//FROM
   //$usermodel = new Recursos_model($db);
   $usermodel->select('R.nombre, R.tipo_archivo, R.descripcion');
  // $usermodel->from('recursos R');
   $usermodel->join('grupo_recursos GR','R.id = GR.id_recurso and GR.deleted=0');
   $usermodel->where('GR.id_grupo',$id_grupo);
   $query = $usermodel->get();
   $resultado = $query->getResult();
   return($resultado);
   /* $usermodel = new Grupos_recursos_model($db);
    $query = "SELECT recursos.nombre,recursos.tipo_archivo,recursos.descripcion FROM recursos inner join grupo_recursos ON recursos.id = grupo_recursos.id_recurso where grupo_recursos.id_grupo = $id_grupo and recursos.deleted=0";
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
   */
 // $usermodel = new Recursos_model($db);
}

//Funcion de miembros(Alumnos asignados a un gpo) con JOIN 

function getMiembros($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('U.nombre,U.apellido_paterno,U.apellido_materno, AL.matricula');
    $usermodel->join('grupo_alumnos G_AL','U.id = G_AL.id_alumno and G_AL.deleted=0');
    $usermodel->join('alumnos AL','AL.id_usuario = U.id');
    $usermodel->where('G_AL.id_grupo',$id_grupo);
    $usermodel->where('U.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);


/*
    $usermodel = new Grupos_alumnos_model($db);
    $query = "SELECT usuarios.nombre,usuarios.apellido_paterno,usuarios.apellido_materno, alumnos.matricula FROM usuarios inner join grupo_alumnos ON usuarios.id = grupo_alumnos.id_alumno and grupo_alumnos.deleted=0 join alumnos on alumnos.id_usuario = usuarios.id where grupo_alumnos.id_grupo = $id_grupo and usuarios.deleted = 0"; 
    $resultado = $usermodel ->query($query);   
    $rowArray = $resultado->getResult();
    return($rowArray);
*/
}

//Funcion que traer los miembros de otro grupos osea los no disponibles 
function getMiembrosOtrosGrupos($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('U.nombre,U.apellido_paterno,U.apellido_materno, AL.matricula,G_AL.id_grupo');
    $usermodel->join('grupo_alumnos G_AL','U.id = G_AL.id_alumno and G_AL.deleted=0');
    $usermodel->join('alumnos AL','AL.id_usuario = U.id');
    $usermodel->where('G_AL.id_grupo !=',$id_grupo);
    $usermodel->where('U.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
}
function getMiembrosDisponibles($id_unidad_negocio,$id_plantel)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('U.nombre,U.apellido_paterno,U.apellido_materno, AL.matricula');
    $usermodel->join('grupo_alumnos G_AL','U.id = G_AL.id_alumno and G_AL.deleted=0','left');
    $usermodel->join('alumnos AL',"AL.id_usuario = U.id and  AL.id_plantel = $id_plantel AND AL.id_unidad_negocio = $id_unidad_negocio");
    $usermodel->where('G_AL.id is null');
    $usermodel->where('U.deleted',0);
   // $usermodel->where('U.id_tipo_usuario',1);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
   
}










?>