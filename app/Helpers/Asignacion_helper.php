<?php 

function getGrupoMaestros($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('U.id, U.nombre, G_TH.id_grupo');
    $usermodel->join('grupo_teachers G_TH',"U.id = G_TH.id_teacher and G_TH.id_grupo = $id_grupo and G_TH.deleted = 0",'left');
    $usermodel->join('maestros M','M.id_usuario = U.id');
    $usermodel->where('U.id_tipo_usuario',3);
    $usermodel->where('U.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
}

function getGrupoMaestrosEliminar($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('G_TH.id, U.nombre, G_TH.id_grupo');
    $usermodel->join('grupo_teachers G_TH',"U.id = G_TH.id_teacher and G_TH.id_grupo = $id_grupo and G_TH.deleted = 0");
    $usermodel->where('U.id_tipo_usuario',3);
    $usermodel->where('U.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
}

function getGrupoAlumnos($id_grupo,$id_unidad_negocio,$id_plantel)
{
    
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('U.id,U.nombre,U.apellido_paterno,U.apellido_materno,G_AL.id_grupo');
    $usermodel->join('grupo_alumnos G_AL',"U.id = G_AL.id_alumno and G_AL.id_grupo = $id_grupo and G_AL.deleted = 0",'left');
    $usermodel->join('alumnos AL',"AL.id_usuario = U.id and  AL.id_plantel = $id_plantel AND AL.id_unidad_negocio = $id_unidad_negocio");
    $usermodel->where('U.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
}

function AsignacionGetAlumnosAsignados($id_unidad_negocio,$id_plantel)
{
    
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('U.id,U.nombre,U.apellido_paterno,U.apellido_materno,G_AL.id_grupo');
    $usermodel->join('grupo_alumnos G_AL',"U.id = G_AL.id_alumno and G_AL.deleted = 0",'left');
    $usermodel->join('alumnos AL',"AL.id_usuario = U.id and  AL.id_plantel = $id_plantel AND AL.id_unidad_negocio = $id_unidad_negocio");
    $usermodel->where('U.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
}

function getGruposEvaluacion($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('evaluaciones EV');
    $usermodel->select('EV.nombre, EV.id');
    $usermodel->join('grupo_evaluacion G_EV',"EV.id = G_EV.id_evaluacion and G_EV.id_grupo = $id_grupo and G_EV.deleted = 0");
    $usermodel->where('EV.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
}


function getGrupoEvaluacionEliminar($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('evaluaciones EV');
    $usermodel->select('G_EV.id,EV.nombre,G_EV.id_grupo');
    $usermodel->join('grupo_evaluacion G_EV',"EV.id = G_EV.id_evaluacion and G_EV.id_grupo = $id_grupo and G_EV.deleted = 0");
    $usermodel->where('EV.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
}

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

function getGrupoRecursos($idcurso,$idnivel)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('recursos R');
    $usermodel->select('R.id, R.nombre,R.extencion,R.ruta');
    $usermodel->where('id_curso',$idcurso);
    $usermodel->where('id_nivel',$idnivel);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);

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

function getMateriales($id_grupo)
{
   $db = \Config\Database::connect();
   $usermodel = $db->table('recursos R');
   $usermodel->select('R.nombre, R.tipo_archivo, R.descripcion');
   $usermodel->join('grupo_recursos GR','R.id = GR.id_recurso and GR.deleted=0');
   $usermodel->where('GR.id_grupo',$id_grupo);
   $query = $usermodel->get();
   $resultado = $query->getResult();
   return($resultado);
}

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

}

function getMiembrosOtrosGrupos($id_grupo,$id_unidad_negocio,$id_plantel)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('U.nombre,U.apellido_paterno,U.apellido_materno, AL.matricula,G_AL.id_grupo');
    $usermodel->join('grupo_alumnos G_AL','U.id = G_AL.id_alumno and G_AL.deleted=0');
    $usermodel->join('alumnos AL',"AL.id_usuario = U.id and  AL.id_plantel = $id_plantel AND AL.id_unidad_negocio = $id_unidad_negocio");
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
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
   
}

function AsignacionGetGrupostAsignadosMaestro()
{
    $idUsuarioTipoMaestro = $_SESSION['id'];
    $db = \Config\Database::connect();
    $usermodel = $db->table('grupos G');
    $usermodel->select('G.nombre,G.id_unidad_negocio,G.id_plantel,GT.id_grupo');
    $usermodel->join('grupo_teachers GT',"G.id = GT.id_grupo and GT.id_teacher = $idUsuarioTipoMaestro AND GT.deleted = 0  and G.deleted = 0");
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return $resultado;  
}

function AsignacionGetGrupoHorario($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('grupos G');
    $usermodel->select('HO.nombre,HO.hora_inicio,HO.hora_fin');
    $usermodel->join('horarios HO',"G.id_horario = HO.id and G.id = $id_grupo AND G.deleted = 0 and HO.deleted = 0");
    $query = $usermodel->get();
    $resultado = $query->getRow();
    return $resultado;  
}


function AsignacionGetGrupoFrecuencia($id_grupo)
{
    $idfrecuencia = AsignacionGetIdFrecuencia($id_grupo);
    $db = \Config\Database::connect();
    $usermodel = $db->table('frecuencia F');
    $usermodel->select('F.lunes,F.martes,F.miercoles,F.jueves,F.viernes,F.sabado,F.domingo');
    $usermodel->where('id',$idfrecuencia);
    $usermodel->where('deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getRow();
    return $resultado;  
}

function AsignacionGetIdFrecuencia($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('grupos G');
    $usermodel->select('C.id_frecuencia');
    $usermodel->join('cursos C',"G.id_curso = C.id and G.id = $id_grupo AND G.deleted = 0 and C.deleted = 0");
    $query = $usermodel->get();
    $resultado = $query->getRow();
    $idFrecuencia = $resultado->id_frecuencia;
    return $idFrecuencia;  
}
?>