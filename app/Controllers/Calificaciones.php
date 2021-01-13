<?php namespace App\Controllers;
use  App\Models\Kardex_model;
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

                //$ArrayIdAsistencia = ObtenerIdAsistencia();
                $info_ciclo = getCicloEspecifico($IdCiclo);
                //$curso_especifico = getCursoEspecifico($IdCurso);
                //$id_frecuencia = $curso_especifico->id_frecuencia;
                //$infoFrecuencia = getFrencueciaEspecifica($id_frecuencia);
                $ValoresPonderacion = CatalagoObtenerPonderaciondeCurso($IdCurso);
                $fechaInicio = $info_ciclo->fecha_inicio;
                $fechaFin = $info_ciclo->fecha_fin;
                $week_start = strtotime(date($fechaInicio));
                $week_end = strtotime(date($fechaFin));

                $ValordeCadaEjercio = $ValoresPonderacion->valor_ejercicios/$ValoresPonderacion->num_ejercicios;
                $ValordeCadaExamen = $ValoresPonderacion->valor_examenes/$ValoresPonderacion->num_examenes;
            
                $UseModelKarex = new Kardex_model($db);

                foreach(CalificarObtenerMiembrosdeGrupo($IdGrupo) as $FilaMiembro){
                    $CalificacionFinalEvaluaciones = 0;
                    $CalificacionFinalcalAsistencia = 0; 
                    $numeroAsistencia = 0;
                    $numeroFalta = 0;
                    $numeroRetardo = 0;
                    $numeroFaltaJustificada = 0;
                    $CalficacionFinalKardex = 0;
                    //Empieza a obtener la calificacion de las evaluaciones por alumno
                    foreach(CalificarGetEvaluacionesContestadas($FilaMiembro->id,$IdGrupo,$IdCurso,$IdNivel,$IdCiclo) as $FilaEvaluacion){
                        $FilaTipoyCategoria = CalificarGetTipoyCategoriaEvaluacion($FilaEvaluacion->id_evaluacion);

                            if($FilaTipoyCategoria->tipo_evaluacion == 1){
                                if(($FilaTipoyCategoria->idCategoriaEvaluacion) == 1){
                                    if($FilaEvaluacion->calificacion == 100){
                                        $CalificacionFinalEvaluaciones += $ValordeCadaEjercio;
                                    }else{
                                        $CalificacionFinalEvaluaciones += porcentaje($ValordeCadaEjercio, $FilaEvaluacion->calificacion );
                                    }
                                    //echo $FilaEvaluacion->calificacion;
                                    //echo $ValordeCadaEjercio;
                                    //echo $CalificacionFinalEvaluaciones;
        
                                }elseif(($FilaTipoyCategoria->idCategoriaEvaluacion) == 2){
                                    $CalificacionFinalEvaluaciones += $FilaEvaluacion->calificacion * ($ValordeCadaEjercio * 0.50);
                                }

                            }elseif($FilaTipoyCategoria->tipo_evaluacion == 2){
                                if(($FilaTipoyCategoria->idCategoriaEvaluacion) == 1){
                                    if($FilaEvaluacion->calificacion == 100){
                                        $CalificacionFinalEvaluaciones += $ValordeCadaEjercio;
                                    }else{
                                        $CalificacionFinalEvaluaciones += porcentaje($ValordeCadaEjercio, $FilaEvaluacion->calificacion );
                                    }
                                }elseif(($FilaTipoyCategoria->idCategoriaEvaluacion) == 2){
                                    $CalificacionFinalEvaluaciones += $FilaEvaluacion->calificacion *  ($ValordeCadaExamen * 0.50);
                                    
                                }

                            }
                    }
                    //Termina de calificar las evaluaciones y empieza la asistencia
                    foreach(getAsistenciaGrupo($FilaMiembro->id,$IdGrupo) as $FilaAsitencia){                        
                        for($i=$week_start; $i<=$week_end; $i+=86400){
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
                    
                    $valAsistDiaria  = $ValoresPonderacion->valor_asistencia/$ValoresPonderacion->total_dias_laborales;
                    $valorRetardo    = porcentaje($valAsistDiaria, 50 );
                    $sumValorRetardo  = $valorRetardo*$numeroRetardo;
                    $valorFaltaJustificada   = porcentaje($valAsistDiaria, 50 );
                    $sumCalorFaltasJustificadas = $valorFaltaJustificada*$numeroFaltaJustificada;
                    $asistencia = $valAsistDiaria*$numeroAsistencia;
                    $CalificacionFinalcalAsistencia = $asistencia+$sumValorRetardo+$sumCalorFaltasJustificadas;

                    $CalficacionFinalKardex = $CalificacionFinalcalAsistencia + $CalificacionFinalEvaluaciones;

                    $data = [ 'id_usuario' => $FilaMiembro->id,
                    'id_nivel' => $IdNivel, 
                    'primera_oportunidad' =>$CalficacionFinalKardex,
                    'fecha_creacion' => $hoy,
                    'fecha_ultimo_cambio' => $hoy,
                    ];

                    try {
                        $UseModelKarex->insert($data);
                    } catch (\Throwable $th) {
                        
                    }
                    
                }

            }

            echo "ok";
        
        }else{
            return redirect()->to(site_url('Home/salir'));

        }
        
	}
}