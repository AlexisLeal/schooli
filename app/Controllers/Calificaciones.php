<?php namespace App\Controllers;
use  App\Models\Karedex_model;
helper('Calificar');

class Calificaciones extends BaseController{

    public function ObtenerCalificacionesparaKardex()
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['SubmitObtenerCalificaciones'])){
                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");
                $IdGrupo = $REQUEST->getPost('IdGrupo');
                $IdCurso = $REQUEST->getPost('IdCurso');
                $IdNivel = $REQUEST->getPost('IdNivel');
                $IdCiclo = $REQUEST->getPost('IdCiclo');
                $ValordeEjercicios = $REQUEST->getPost('ValordeEjercicios');
                $ValordeExamanes = $REQUEST->getPost('ValordeExamanes');
                $CantidadeEjericios = $REQUEST->getPost('CantidadeEjericios');
                $CantidadeExamenes = $REQUEST->getPost('CantidadeExamenes');
                $ValordeCadaEjercio = $ValordeEjercicios/$CantidadeEjericios;
                $ValordeCadaExamen = $$ValordeExamanes/$CantidadeExamenes;
                $CalificacionFinalEvaluaciones = 0;
                foreach(CalificarObtenerMiembrosdeGrupo($IdGrupo) as $FilaMiembro){
                    foreach(CalificarGetEvaluacionesContestadas($FilaMiembro->id,$IdGrupo,$IdCurso,$IdNivel,$IdCiclo) as $FilaEvaluacion){
                        $FilaTipoyCategoria = CalificarGetTipoyCategoriaEvaluacion($FilaEvaluacion->id);

                            if($FilaTipoyCategoria->tipo_evaluacion == 1){
                                if(($FilaTipoyCategoria->idCategoriaEvaluacion) == 1){
                                    $CalificacionFinalEvaluaciones =$FilaEvaluacion->calificacion * $ValordeCadaEjercio;
                                    //Aplica la ponderacion 

                                }elseif(($FilaTipoyCategoria->idCategoriaEvaluacion) == 2){
                                    $CalificacionFinalEvaluaciones =$FilaEvaluacion->calificacion * ($ValordeCadaEjercio * 0.50);
                                    //Aplica la ponderacion
                                }

                            }elseif($FilaTipoyCategoria->tipo_evaluacion == 2){
                                if(($FilaTipoyCategoria->idCategoriaEvaluacion) == 1){
                                    $CalificacionFinalEvaluaciones = $FilaEvaluacion->calificacion *  $ValordeCadaExamen;
                                    //Aplica la ponderacion 

                                }elseif(($FilaTipoyCategoria->idCategoriaEvaluacion) == 2){
                                    $CalificacionFinalEvaluaciones =$FilaEvaluacion->calificacion *  ($ValordeCadaExamen * 0.50);
                                    //Aplica la ponderacion
                                }

                            }
                    }

                    //Insertamos la calificacion y reiniciamos la calificaicon  a cero 
                    $data = [ 'id_usuario' => $FilaMiembro->id,
                    'id_nivel' => $IdNivel, 
                    'primera_oportunidad' =>$$CalificacionFinalEvaluaciones,
                    'fecha_creacion' => $hoy,
                    'fecha_ultimo_cambio' => $hoy,
                    ];
                    $CalificacionFinalEvaluaciones = 0;
                }


            }
        
        }else{
            return redirect()->to(site_url('Home/salir'));

        }
        
	}
}