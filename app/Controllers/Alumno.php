<?php namespace App\Controllers;
use  App\Models\Grupos_model;
use  App\Models\Evaluaciones_model;
use  App\Models\Preguntas_model;
use  App\Models\Pregunta_opcion_multiple;
use  App\Models\Control_Respuestas_model;
use  App\Models\Control_grupos_calificaciones_evaluaciones_model;


class Alumno extends BaseController{

    public function index()
	{
        if($this->session->get('login') && $this->session->get('roll') == 1){
            $id_usuario= $this->session->get('id');
            $data['id_usuario'] = $id_usuario;
            return view('alumnos/alumno/index_alumno',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
	}
    
    public function presentarevaluacion($id_evaluacion,$idGrupo,$IdCurso,$IdNivel,$Idciclo){
        if($this->session->get('login') && $this->session->get('roll') == 1){
            $usermodel = new Evaluaciones_model($db);
            $usermodel->select('nombre,clave,tipo_evaluacion');
            $usermodel->where('id',$id_evaluacion);
            $usermodel->where('deleted',0);
            $resultado = $usermodel->get();
            $row = $resultado -> getRow();

            $data['idEvaluacion'] = $id_evaluacion;
            $data['IdCurso'] = $IdCurso;
            $data['IdNivel'] = $IdNivel;
            $data['Idciclo'] = $Idciclo;
            $data['nombre'] = $row->nombre;
            $data['clave'] = $row->clave;
            $data['idtipoevaluacion'] = $row->tipo_evaluacion;
            $data['totalpreguntas'] = getTotalPreguntas($id_evaluacion);
            $data['valorpreguntas'] =  getValorTotalPreguntas($id_evaluacion);
            $nombre =getTipoEvaluacionEspecifico($row->tipo_evaluacion);
            $data['tipo_evaluacion'] = $nombre->nombre;
            $data['idGrupo'] = $idGrupo;
            $data['page_title'] = "Preguntas";

            return view('alumnos/alumno/presentarevaluacion',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function perfil()
    {
        if($this->session->get('login')&& $this->session->get('roll') == 1){
            $id_usuario = $this->session->get('id');               
            $db = \Config\Database::connect();
            $usermodel = $db->table('usuarios U');

            $usermodel->select('U.email,U.estado,U.telefono,U.movil,U.roll,AL.id_plantel,AL.id_unidad_negocio,AL.matricula,
            D.calle,D.numero_interior,D.numero_exterior,D.colonia,D.codigo_postal,D.municipio_delegacion,
            D.id_entidad_federativa,D.id_pais');

            $usermodel->join('alumnos AL', "AL.id_usuario = U.id and U.id = $id_usuario and U.deleted = 0 and AL.deleted = 0");
            $usermodel->join('direcciones D',' D.id = U.id_direccion and D.deleted = 0');
            $resultado = $usermodel->get();   
            $row = $resultado->getRow();

             //Usuario  
            $data['email'] = $row->email;
            $data['estado'] = ($row->estado == 1) ? "Activo" : "Inactivo";
            $data['telefono'] = $row->telefono;
            $data['movil'] = $row->movil;
            $data['roll'] = $row->roll;

            //Alummno
            $data['matricula'] =$row->matricula ;
            $data['plantel'] =$row->id_plantel;
            $data['unidad_negocio'] = $row->id_unidad_negocio;

            //Dirrecion 
            $data['calle'] = $row->calle;
            $data['numero_interior'] = $row->numero_interior;
            $data['numero_exterior'] = $row->numero_exterior;
            $data['colonia'] = $row->colonia;
            $data['codigo_postal'] = $row->codigo_postal;
            $data['municipio_delegacion'] = $row->municipio_delegacion;

            //Estado
            $data['estado'] = $row->id_entidad_federativa;

            //Pais 
            $data['pais'] = $row->id_pais;

            return view('alumnos/alumno/perfil',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function CalificarEvaluacion()
    {
        if($this->session->get('login')&& $this->session->get('roll') == 1){
            if(isset($_POST['SubmitRespuestas'])){
                $REQUEST = \Config\Services::request();

                $idEvaluacion = $REQUEST->getPost('idEvaluacion');
                $idGrupo = $REQUEST->getPost('idGrupo');

                $usermodelPreguntas = new Preguntas_model($db);
                $usermodelPreguntas->select('id,idTipoPregunta');
                $usermodelPreguntas->where('idEvaluacion',$idEvaluacion);
                $usermodelPreguntas->where('deleted',0);
                $query = $usermodelPreguntas->get();
                $resultado = $query->getResult();

                $preguntasMultiples = array();

                foreach($resultado as $fila){
                    if($fila->idTipoPregunta == 2){
                        if(!empty($REQUEST->getPost('optmulti'.$fila->id))){
                            $preguntasMultiples[$fila->id] = $REQUEST->getPost('optmulti'.$fila->id);
                        }  
                    }
                }
                if(!empty($preguntasMultiples)){

                    $preguntasCalificadasOptionMultiple = array();

                    $usermodelPreguntasOpcionMultiple = new Pregunta_opcion_multiple($db);
                    $usermodelPreguntasOpcionMultiple->select('idPregunta,opcion_correcta');
                    $usermodelPreguntasOpcionMultiple->where('idEvaluacion',$idEvaluacion);
                    $usermodelPreguntasOpcionMultiple->where('deleted',0);
                    $query = $usermodelPreguntasOpcionMultiple->get();
                    $resultado = $query->getResult();

                    foreach($resultado as $fila){
                        foreach($preguntasMultiples as $key=>$value){
                            if($fila->idPregunta == $key){
                                if($fila->opcion_correcta == $value){
                                    $preguntasCalificadasOptionMultiple[$fila->idPregunta] = 1; 

                                }else{
                                    $preguntasCalificadasOptionMultiple[$fila->idPregunta] = 0; 
                                }
                            }
                        }
                    }

                    $usermodelControRespuestas = new Control_Respuestas_model($db);
                    $hoy = date("Y-m-d H:i:s");

                    foreach($preguntasCalificadasOptionMultiple as $idpregunta=>$respuesta){

                        $data = ['idalumno'=> $this->session->get('id'),
                        'idgrupo'=> $idGrupo,
                        'idevaluacion' =>$idEvaluacion,
                        'idpregunta'=> $idpregunta,
                        'idtipopregunta'=> 2,
                        'respuesta'=> $respuesta,
                        'fecha_creacion'=> $hoy,
                        'fecha_ultimo_cambio' => $hoy,
                        ];

                        $usermodelControRespuestas->insert($data);
                       
                    }
                    $usermodelPreguntas->select('id,idTipoPregunta,valor');
                    $usermodelPreguntas->where('idEvaluacion',$idEvaluacion);
                    $usermodelPreguntas->where('idTipoPregunta',2);
                    $usermodelPreguntas->where('deleted',0);
                    $query = $usermodelPreguntas->get();
                    $resultado = $query->getResult();

                    $puntos = 0;
                    $valortotalevaluacion = 0;

                    foreach($resultado as $fila){
                        foreach($preguntasCalificadasOptionMultiple as $idpregunta=>$respuesta){
                            if($idpregunta == $fila->id){ 
                                if($respuesta == 1){
                                    $puntos += $fila->valor;
                                    $valortotalevaluacion += $fila->valor;
                                }else{
                                    $valortotalevaluacion += $fila->valor;
                                }
                            }
                        }
                    }

                    $usermodelControlEvaluacion = new Control_grupos_calificaciones_evaluaciones_model($db);

                    $data = ['id_alumno'=> $this->session->get('id'),
                    'id_grupo'=> $idGrupo,
                    'id_evaluacion' =>$idEvaluacion,
                    'id_curso' =>$REQUEST->getPost('IdCurso'),
                    'id_nivel' =>$REQUEST->getPost('IdNivel'),
                    'id_ciclo' =>$REQUEST->getPost('Idciclo'),
                    'calificacion'=>$puntos,
                    'calificaciontotal'=>$valortotalevaluacion,
                    'fecha_creacion'=> $hoy,
                    'fecha_ultimo_cambio' => $hoy,
                    ];

                    $usermodelControlEvaluacion->insert($data);

                    $data = ['EvaluacionContestadaOk'  => 'La evaluación de registro correctamente'];

                    $this->session->set($data,true);

                    return redirect()->to(site_url('Alumno/index'));    
                }               
            }else{
                return redirect()->to(site_url('Home/salir'));
            }     
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function calificaciones($idGrupo)
	{
        if($this->session->get('login') && $this->session->get('roll') == 1){
            $data['idGrupo'] = '';
            $data['idNivel'] = '';
            $data['idCurso'] = '';
            $data['idCiclo'] = '';
            $data[''] = '';
            $data[] = '';
            $data[] = '';
            $data[] = '';
            $data[] = '';
            $data[] = '';
            $data[] = '';

            return view('alumnos/alumno/calificaciones');
        }
    }


    function detallesgrupo(){
        $db = \Config\Database::connect();

        $id_usuario= $this->session->get('id');
        $usermodel = $db->table('usuarios U');
        $usermodel->select('AL.matricula,G_AL.id_grupo,G_TH.id_teacher');
        $usermodel->join('alumnos AL',"U.id = AL.id_usuario and U.id = $id_usuario");
        $usermodel->join('grupo_alumnos G_AL','G_AL.id_alumno = U.id and G_AL.deleted = 0','left');
        $usermodel->join('grupo_teachers G_TH','G_TH.id_grupo = G_AL.id_grupo and G_TH.deleted = 0','left');
        $resultado = $usermodel->get();   
        $row = $resultado->getRow();

        $data['matricula'] = $row->matricula;

        if($row->id_grupo != null){
            $usermodel_grupo = new Grupos_model();
            $usermodel_grupo->select('nombre,codigo_acceso,id_unidad_negocio,id_plantel,id_curso,id_nivel,id_ciclo');
            $usermodel_grupo->where('id',$row->id_grupo);
            $usermodel_grupo->where('deleted',0);
            $query = $usermodel_grupo->get();
            $row_grupo = $query->getRow();

            $data['id_grupo'] = $row->id_grupo;
            $data['nombre_grupo'] = $row_grupo->nombre;	
            $data['codigo_acceso'] = $row_grupo->codigo_acceso;
            $data['id_unidad_negocio']= $row_grupo->id_unidad_negocio;	
            $data['id_plantel']= $row_grupo->id_plantel;	
            $data['id_ciclo']= $row_grupo->id_ciclo;	
            $data['id_curso']= $row_grupo->id_curso;	
            $data['id_nivel']= $row_grupo->id_nivel;	
            $data['unidad_negocio'] = getUnidadNegocioEspecifico($row_grupo->id_unidad_negocio);	
            $data['nombre_plantel'] = getPlanteEspecifico($row_grupo->id_plantel);
            $data['nombre_curso'] = CatalagoGetNombreCurso($row_grupo->id_curso);

            if($row->id_teacher != null){
                $maestro = getMaestroEspecifico($row->id_teacher);
                $data['nombre_maestro'] = $maestro->nombre;
            }

            return view('alumnos/alumno/detalles_grupo',$data);

        }else{
            $data['id_grupo'] = $row->id_grupo;
            $data['page_title'] = "Alumnos";	

            return view('alumnos/alumno/detalles_grupo',$data);
        }  
    }
}