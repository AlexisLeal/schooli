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
                $valorAsistenciaDiaria = $ValoresPonderacion->valor_asistencia/$ValoresPonderacion->total_dias_laborales;

                foreach(CalificarObtenerMiembrosdeGrupo($IdGrupo) as $FilaMiembro){
                    $calificaciones = 0;
                    $calificacionesAsistencia = 0; 
                    $CalficacionFinalKardex = 0;
                    $calificaciones = ObtenerCalificacionesPreviasdeEvaluaciones($FilaMiembro->id,$IdGrupo,$IdCurso,$IdNivel,$IdCiclo,$ValordeCadaEjercio,$ValordeCadaExamen);
                    $calificacionesAsistencia = ObtenerCalificaionesPreviasAsistencia($FilaMiembro->id,$IdGrupo, $week_start,$week_end,$valorAsistenciaDiaria);


                    $CalficacionFinalKardex = $calificaciones['calificacionesEjercicios'] + $calificaciones['calificaionesExamenes'] + $calificacionesAsistencia;

                    $data = [ 'id_usuario' => $FilaMiembro->id,
                    'id_nivel' => $IdNivel, 
                    'primera_oportunidad' =>$CalficacionFinalKardex,
                    'fecha_creacion' => $hoy,
                    'fecha_ultimo_cambio' => $hoy,
                    ];

                    try {
                        $UseModelKarex = new Kardex_model($db);
                        $UseModelKarex->insert($data);
                    } catch (\Throwable $th) {
                        
                    }
                    
                }

            }else{
                return redirect()->to(site_url('Home/salir'));
            }

            echo "ok";
        
        }else{
            return redirect()->to(site_url('Home/salir'));

        }
        
    }
    public function CalificacionesAplicadas($IdGrupo,$IdNivel){
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['IdGrupo']=$IdGrupo;
            $data['$IdNivel']=$IdNivel;

            return view('grupos/mostrar/calificacionesaplicadas',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }   
       
    }
}