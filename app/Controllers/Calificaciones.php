<?php namespace App\Controllers;
helper('Calificar');

class Calificaciones extends BaseController{

    public function ObtenerCalificacionesparaKardex()
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['SubmitObtenerCalificaciones'])){
                $REQUEST = \Config\Services::request();
                $IdGrupo = $REQUEST->getPost('IdGrupo');
                $IdCurso = $REQUEST->getPost('IdCurso');
                $IdNivel = $REQUEST->getPost('IdNivel');
                $IdCiclo = $REQUEST->getPost('IdCiclo');
                $CalificacionFinalEvaluaciones = 0;
                foreach(CalificarObtenerMiembrosdeGrupo($IdGrupo) as $FilaMiembro){
                    foreach(CalificarGetEvaluacionesContestadas($FilaMiembro->id,$IdGrupo,$IdCurso,$IdNivel,$IdCiclo) as $FilaEvaluacion){
                        $FilaTipoyCategoria = CalificarGetTipoyCategoriaEvaluacion($FilaEvaluacion->id);

                            if($FilaTipoyCategoria->tipo_evaluacion == 1){
                                if(($FilaTipoyCategoria->idCategoriaEvaluacion) == 1){
                                    $FilaEvaluacion->calificacion;
                                    //Aplica la ponderacion 

                                }elseif(($FilaTipoyCategoria->idCategoriaEvaluacion) == 2){
                                    $FilaEvaluacion->calificacion;
                                    //Aplica la ponderacion
                                }

                            }elseif($FilaTipoyCategoria->tipo_evaluacion == 2){
                                if(($FilaTipoyCategoria->idCategoriaEvaluacion) == 1){
                                    $FilaEvaluacion->calificacion;
                                    //Aplica la ponderacion 

                                }elseif(($FilaTipoyCategoria->idCategoriaEvaluacion) == 2){
                                    $FilaEvaluacion->calificacion;
                                    //Aplica la ponderacion
                                }

                            }

                    }

                    //Insertamos la calificacion y reiniciamos la calificaicon  a cero 
                    $CalificacionFinalEvaluaciones = 0;
                }


            }
        
        }else{
            return redirect()->to(site_url('Home/salir'));

        }
        
	}
}