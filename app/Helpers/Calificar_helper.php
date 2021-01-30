<?php
use  App\Models\Control_grupos_calificaciones_evaluaciones_model;
use  App\Models\Evaluaciones_model;
use  App\Models\Kardex_model;



function CalificarObtenerMiembrosdeGrupo($id_grupo)
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('usuarios U');
    $usermodel->select('U.id');
    $usermodel->join('grupo_alumnos G_AL','U.id = G_AL.id_alumno and G_AL.deleted=0');
    $usermodel->where('G_AL.id_grupo',$id_grupo);
    $usermodel->where('U.deleted',0);
    $usermodel->where('G_AL.deleted',0);
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

function Porcentaje($ValorAsitenciaDiara, $Porcentaje) {
    if($ValorAsitenciaDiara>=1){
      $PorcentajeAplicado="0.".$Porcentaje;
      return $ValorAsitenciaDiara*floatval($PorcentajeAplicado);
    }else{
      $PorcentajeAplicado="0.".$Porcentaje;
      return $ValorAsitenciaDiara*floatval($PorcentajeAplicado);
    }
  }

function ObtenerIdAsistencia(){
    $ArrayIdAsistencia = array ();
    foreach(getValorAsistencia() as $fila){
        $ArrayIdAsistencia[$fila->id]=$fila->valor;
      }
    return $ArrayIdAsistencia;
}

function ObtenerCalificacionesdeKardex($IdUsuario,$IdNivel)
{
    $UseModelKardex = new Kardex_model($db);
    $UseModelKardex->select('primera_oportunidad,segunda_oportunidad');
    $UseModelKardex->where('id_usuario',$IdUsuario);
    $UseModelKardex->where('id_nivel',$IdNivel);
    $UseModelKardex->where('deleted',0);
    $Query = $UseModelKardex->get();
    return $Query->getRow();
}


function ObtenerCalificacionesPreviasdeEvaluaciones($IdUsuario,$idGrupo,$idCurso,$idNivel,$idCiclo,$ValordeCadaEjercio,$ValordeCadaExamen){
    $calificacionFinalEjercicio = 0;
    $calificacionFinalExamen = 0 ;
    foreach(CalificarGetEvaluacionesContestadas($IdUsuario,$idGrupo,$idCurso,$idNivel,$idCiclo) as $FilaEvaluacion){
        $FilaTipoyCategoria = CalificarGetTipoyCategoriaEvaluacion($FilaEvaluacion->id_evaluacion);

            if($FilaTipoyCategoria->tipo_evaluacion == 1){
                if(($FilaTipoyCategoria->idCategoriaEvaluacion) == 1){
                    if($FilaEvaluacion->calificacion == 100){
                        $calificacionFinalEjercicio += $ValordeCadaEjercio;
                    }else{
                        $calificacionFinalEjercicio += porcentaje($ValordeCadaEjercio, $FilaEvaluacion->calificacion );
                    }

                }elseif(($FilaTipoyCategoria->idCategoriaEvaluacion) == 2){
                    $calificacionFinalEjercicio += $FilaEvaluacion->calificacion * ($ValordeCadaEjercio * 0.50);
                }

            }elseif($FilaTipoyCategoria->tipo_evaluacion == 2){
                if(($FilaTipoyCategoria->idCategoriaEvaluacion) == 1){
                    if($FilaEvaluacion->calificacion == 100){
                        $calificacionFinalExamen += $ValordeCadaExamen;
                    }else{
                        $calificacionFinalExamen += porcentaje($ValordeCadaExamen, $FilaEvaluacion->calificacion );
                    }
                }elseif(($FilaTipoyCategoria->idCategoriaEvaluacion) == 2){
                    $calificacionFinalExamen += $FilaEvaluacion->calificacion *  ($ValordeCadaExamen * 0.50);
                    
                }

            }
    }

    $calificaionesPreliminares = array(
        'calificacionesEjercicios' => $calificacionFinalEjercicio,
        'calificaionesExamenes' => $calificacionFinalExamen,
    );

    return $calificaionesPreliminares;
   
}

function ObtenerCalificaionesPreviasAsistencia($idUsuario,$idGrupo,$fechaInicio,$fechaFin,$valorAsistDiaria){
    $numeroAsistencia = 0;
    $numeroFalta = 0;
    $numeroRetardo = 0;
    $numeroFaltaJustificada = 0;
    foreach(getAsistenciaGrupo($idUsuario,$idGrupo) as $FilaAsitencia){                        
        for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
          if(date("Y-m-d", $i)==$FilaAsitencia->fecha_asistencia){

            if($FilaAsitencia->valor_asistencia==1){
              $numeroAsistencia++;
            }
            if($FilaAsitencia->valor_asistencia==2){
              $numeroFalta++;
            }
            if($FilaAsitencia->valor_asistencia==3){
              $numeroRetardo++;
            }
            if($FilaAsitencia->valor_asistencia==4){
              $numeroFaltaJustificada++;
            }     

          }
        }
    }
    $valorRetardo    = porcentaje($valorAsistDiaria, 50 );
    $sumValorRetardo  = $valorRetardo*$numeroRetardo;
    $valorFaltaJustificada   = porcentaje($valorAsistDiaria, 50 );
    $sumCalorFaltasJustificadas = $valorFaltaJustificada*$numeroFaltaJustificada;
    $asistencia = $valorAsistDiaria*$numeroAsistencia;
    $CalificacionFinalcalAsistencia = $asistencia+$sumValorRetardo+$sumCalorFaltasJustificadas;

    return $CalificacionFinalcalAsistencia;
  
}

function EvaluacionContestado($idUsuario,$idGrupo,$idCurso,$idNivel,$seion,$idCiclo,$IdEvaluacion){

    $useModel = new Control_grupos_calificaciones_evaluaciones_model($db);
    $useModel->select('id');
    $useModel->where('id_alumno',$idUsuario);
    $useModel->where('id_grupo',$idGrupo);
    $useModel->where('id_curso',$idCurso);
    $useModel->where('id_nivel',$idNivel);
    $useModel->where('session',$seion);
    $useModel->where('id_ciclo',$idCiclo);
    $useModel->where('id_evaluacion',$IdEvaluacion);
    $useModel->where('deleted',0);
    $query = $useModel->get();
    return $query->getRow();
}

function ComprobacionEvaluacionContestado($evaluacionContesda)
{
   if(!empty($evaluacionContesda)){
       return true;
   }else{
       return false;
   }
}

?>