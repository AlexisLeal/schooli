<?php
use  App\Models\Control_grupos_calificaciones_evaluaciones_model;
use  App\Models\Evaluaciones_model;



function CalificarObtenerMiembrosdeGrupo($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('U.id');
    $usermodel->join('grupo_alumnos G_AL','U.id = G_AL.id_alumno and G_AL.deleted=0');
    $usermodel->where('G_AL.id_grupo',$id_grupo);
    $usermodel->where('U.deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);

}

function CalificarGetEvaluacionesContestadas($IdUsuario,$IdGrupo,$IdCurso,$IdNivel,$IdCiclo)
{
    $usermodel = new Control_grupos_calificaciones_evaluaciones_model($db);
    $usermodel->select('id_evaluacion,calificacion');
    $usermodel->where('id_alumno',$IdUsuario);
    $usermodel->where('id_grupo',$IdGrupo);
    $usermodel->where('id_curso',$IdCurso);
    $usermodel->where('id_nivel',$IdNivel);
    $usermodel->where('id_ciclo',$IdCiclo);
    $usermodel->where('deleted',0);
    $resultado = $usermodel->get();
    $rowArray = $resultado->getResult();
    return($rowArray);
}

function CalificarGetTipoyCategoriaEvaluacion($IdEvaluacion){
    $UseModelEvaluaciones = new Evaluaciones_model($db);
    $UseModelEvaluaciones->select('tipo_evaluacion,idCategoriaEvaluacion');
    $UseModelEvaluaciones->where('id',$IdEvaluacion);
    $UseModelEvaluaciones->where('deleted',0);
    $Resultado = $UseModelEvaluaciones->get();
    $row = $Resultado->getRow();
    return($row);

}
/*
function CalificarEvaluacionTipoEjercio($IdCategoria){
    if($IdCategoria == 1){
        return 1;
        
    }elseif($IdCategoria == 2){
        return 2;
        
    }

}
function CalificarEvaluacionTipoExamen($IdCategoria){
    if($IdCategoria == 1){
        return 1;
    }elseif($IdCategoria == 2){
        return 2;
    }
    
}

function CalificarEvaluacionTipoEjercioNormal($IdEvaluacion,$Calificacion){
    //Regresar un array con el idevaluacion y su calificacion final 
}
function CalificarEvaluacionTipoEjercioRecuperacion($IdEvaluacion,$Calificacion){
    
}
function CalificarEvaluacionTipoExamenNormal($IdEvaluacion,$Calificacion){
    
}
function CalificarEvaluacionTipoExamenRecupercion($IdEvaluacion,$Calificacion){
    
}

*/

?>