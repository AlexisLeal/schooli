<?php
use  App\Models\Control_grupos_calificaciones_evaluaciones_model;
use  App\Models\Evaluaciones_model;

function getEvaluacionesContestadas($IdUsuario,$IdGrupo,$IdCurso,$IdNivel,$IdCiclo)
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

function getTipoyCategoriaEvaluacion($IdEvaluacion){
    $UseModelEvaluaciones = new Evaluaciones_model($db);
    $UseModelEvaluaciones->select('tipo_evaluacion,idCategoriaEvaluacion');
    $UseModelEvaluaciones->where('id',$IdEvaluacion);
    $UseModelEvaluaciones->where('deleted',0);
    $Resultado = $UseModelEvaluaciones->get();
    $row = $Resultado->getRow();
    return($row);

}

function CalificarEvaluacionTipoEjercio($IdEvaluacion,$IdCategoria){
    if($IdCategoria == 1){
        CalificarEvaluacionTipoEjercioNormal($IdEvaluacion);
    }else{
        CalificarEvaluacionTipoEjercioRecuperacion($IdEvaluacion);
    }

}
function CalificarEvaluacionTipoExamen($IdEvaluacion,$IdCategoria){
    if($IdCategoria == 1){
        CalificarEvaluacionTipoExamenNormal($IdEvaluacion);
    }else{
        CalificarEvaluacionTipoExamenRecupercion($IdEvaluacion);
    }
    
}
function CalificarEvaluacionTipoEjercioNormal($IdEvaluacion){
    
}
function CalificarEvaluacionTipoEjercioRecuperacion($IdEvaluacion){
    
}
function CalificarEvaluacionTipoExamenNormal($IdEvaluacion){
    
}
function CalificarEvaluacionTipoExamenRecupercion($IdEvaluacion){
    
}



?>