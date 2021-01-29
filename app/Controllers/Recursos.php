<?php

namespace App\Controllers;
use  App\Models\Recursos_model;
use  App\Models\Cursos_model;


class Recursos extends BaseController
{

    public function recursos()
    {
        if ($this->session->get('login') && $this->session->get('roll') == 4) {
            $data['page_title'] = "Recursos";

            return view('recursos/biblioteca_recursos', $data);
        } else {
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function formrecursos()
    {
        if ($this->session->get('login') && $this->session->get('roll') == 4) {
            $data['page_title'] = "Recursos";

            return view('recursos/recursos', $data);
        } else {
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function editar($idRecurso){
        if ($this->session->get('login') && $this->session->get('roll') == 4) {
            $useModelRecurso = new Recursos_model($db);
            $useModelRecurso->select('nombre,tipo_recurso,id_evaluacion,id_curso,id_nivel,id_leccion');
            $useModelRecurso->where('id',$idRecurso);
            $useModelRecurso->where('deleted',0);
            $query = $useModelRecurso->get();
            try {
                $resultado = $query->getRow();
            } catch (\Throwable $th) {

                echo "Colocamos que se regrese ala vista anterior y que marque un error ";
                //throw $th;
            }
          
            $data['tipoRecurso'] = $resultado->tipo_recurso;
            $data['idRecurso'] = $idRecurso;
            $data['idCurso'] = $resultado->id_curso;
            $data['idNivel'] = $resultado->id_nivel;
            $data['sesion'] = $resultado->id_leccion;
            $data['nombreRecurso'] = $resultado->nombre;

            if($resultado->tipo_recurso == 1){
                $evaluacion = OperacionesObtenerDatosParaEditarEvaluacion($resultado->id_evaluacion);
                $data['idEvaluacion'] = $resultado->id_evaluacion;
                $data['nombreEvaluacion'] = $evaluacion->nombre;
                $data['idTipoEvaluacion'] = $evaluacion->tipo_evaluacion;
                $data['idCategoriaEvaluacion'] = $evaluacion->idCategoriaEvaluacion;

            }else{
                $data['idEvaluacion'] = null;
                $data['nombreEvaluacion'] = null;
                $data['idTipoEvaluacion'] = null;
                $data['idCategoriaEvaluacion'] = null;
            }

            return view('recursos/editar', $data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }



    public function agregarRecurso()
    {
        if ($this->session->get('login') && $this->session->get('roll') == 4) {
            if(isset($_POST['registrarRecurso'])){
            $REQUEST = \Config\Services::request();
            $hoy = date("Y-m-d H:i:s");
            if($REQUEST->getPost('tipoRecurso') != 1){
                $recurso_archivo = $REQUEST->getFile('recurso_archivo');
                $recurso_extension = $recurso_archivo->getClientExtension();
                switch ($recurso_extension) {
                    case 'docx':
                        $tipo_archivo = "Word";
                        break;
                    case 'xlsx':
                        $tipo_archivo = "Excel";
                        break;
                    case 'pdf':
                        $tipo_archivo = "Pdf";
                        break;
                    case 'zip':
                        $tipo_archivo = "Zip";
                        break;
                    case 'rar':
                        $tipo_archivo = "Rar";
                        break;
                    case 'jpg':
                        $tipo_archivo = "Jpg";
                        break;
                    case 'png':
                        $tipo_archivo = "Png";
                        break;
                    case 'mp3':
                        $tipo_archivo = "Mp3";
                        break;
                    case 'mp4':
                        $tipo_archivo = "Mp4";
                        break;
                    default:
                        $tipo_archivo = "Desconocido";
                }

                if ($recurso_archivo->isValid() && !$recurso_archivo->hasMoved()) {
                    $nombreCurso = str_replace(' ','',CatalagoGetNombreCurso($REQUEST->getPost('curso'))); 
                    $nombreNivel = str_replace(' ','',getnivelEspecifico($REQUEST->getPost('nivel')));
                    $nombreSesion = 'Sesion'.''.$REQUEST->getPost('sesion');
                    if (!is_dir("recursos/$nombreCurso/$nombreNivel/$nombreSesion")) {
                        try {
                            mkdir("recursos/$nombreCurso/$nombreNivel/$nombreSesion", 0777, TRUE);
                        } catch (\Exception $e) {
                            $data = [
                                'mensaje-recurso'  => 'Hay problemas a crear la carpeta',
                                'tipo-mensaje' => 'alert-danger'
                            ];
                            $this->session->set($data, true);
                            return redirect()->to(site_url("Recursos/formrecursos"));
                            
                        }  
                    }
                    $nombre_recurso = str_replace(' ','',$recurso_archivo->getClientName());
                    $ruta_recurso_basedatos = "recursos/$nombreCurso/$nombreNivel/$nombreSesion/$nombre_recurso";
                    $ruta_mover_recurso = "recursos/$nombreCurso/$nombreNivel/$nombreSesion";
                    try {
                        $recurso_archivo->move($ruta_mover_recurso, $nombre_recurso);
                    } catch (\Exception $e) {
                        $data = [
                            'mensaje-recurso'  => 'El recurso no se pudo copiar a ruta destino',
                            'tipo-mensaje' => 'alert-danger'
                        ];
                        $this->session->set($data, true);
                        return redirect()->to(site_url("Recursos/recursos"));
                    }
                }else {
                //Si algo sale mal nos marca un error 
                //throw new RuntimeException($recurso_audio->getErrorString().'('.$recurso_audio->getError().')');
                }
            }elseif($REQUEST->getPost('tipoRecurso')==1){

                $nombre_recurso = str_replace(' ','',$REQUEST->getPost('nombreEvaluacion'));
                $recurso_extension = null;
                $tipo_archivo = null;
                $ruta_recurso_basedatos = null;

            }
            
            $data = [
                'nombre' => $nombre_recurso,
                'extencion' => $recurso_extension,
                'tipo_archivo' => $tipo_archivo,
                'tipo_recurso' => $REQUEST->getPost('tipoRecurso'),
                'id_curso' => $REQUEST->getPost('curso'),
                'id_nivel' => $REQUEST->getPost('nivel'),
                'id_leccion' => $REQUEST->getPost('sesion'),
                'ruta' => $ruta_recurso_basedatos,
                'fecha_creacion' => $hoy,
                'fecha_ultimo_cambio' => $hoy,
            ];

            $usermodel = new Recursos_model($db);
            if ($usermodel->insert($data)) {
            } else {
                $data = [
                    'mensaje-recurso'  => 'El recurso no  se pudo agregar, consulte con el administrador del sistema.', 'tipo-mensaje' => 'alert-danger'
                ];
                $this->session->set($data, true);
                return redirect()->to(site_url("Recursos/recursos"));
            }
            if($REQUEST->getPost('tipoRecurso') == 1){
                $id_recurso = $usermodel->insertID();
                $tipo_evaluacion = $REQUEST->getPost('tipoFormulario');
                $categoria_evaluacion = $REQUEST->getPost('tipocategoriaevaluacion');
                $nombre_evaluacion = $REQUEST->getPost('nombreEvaluacion');

                try{
                    $id_evaluacion = InsertarEvaluacion($id_recurso,$tipo_evaluacion,$categoria_evaluacion,$nombre_evaluacion);

                }catch(\Exception $e){
                    $usermodel->delete(['id'=>$id_recurso]);
                    $data = [
                        'mensaje-recurso'  => 'El recurso no se puede crear correctamente',
                        'tipo-mensaje' => 'alert-danger'
                    ];
                    $this->session->set($data, true);
                    return redirect()->to(site_url("Recursos/recursos"));

                }
                $nombreCurso = str_replace(' ','',CatalagoGetNombreCurso($REQUEST->getPost('curso')));
                $nombreNivel = str_replace(' ','',getnivelEspecifico($REQUEST->getPost('nivel')));
                $nombreSesion = 'Sesion'.''.$REQUEST->getPost('sesion');
                try{
                    InsertaRutaEvaluacion($id_evaluacion,$nombreCurso,$nombreNivel,$nombreSesion);
                }catch(\Exception $e){
                    $data = [
                        'mensaje-recurso'  => 'El recurso no se puede crear correctamente',
                        'tipo-mensaje' => 'alert-danger'
                    ];
                    EliminarEvaluacion($id_evaluacion);
                    $this->session->set($data, true);
                    return redirect()->to(site_url("Recursos/recursos"));
                }
                
                //Actualiza el idevaluacion de la tabla recurso
                try {
                    $DataUpdateRecursor = [
                        'id_evaluacion' => $id_evaluacion,
                    ];
                    $usermodel->update($id_recurso,$DataUpdateRecursor);
                } catch (\Exception $e) {
                    $data = [
                        'mensaje-recurso'  => 'El recurso no se puede crear correctamente',
                        'tipo-mensaje' => 'alert-danger'
                    ];
                    EliminarEvaluacion($id_evaluacion);
                    $usermodel->delete(['id'=>$id_recurso]);
                    $this->session->set($data, true);
                    return redirect()->to(site_url("Recursos/recursos"));
                }
               
                return redirect()->to(site_url("Evaluaciones/panel_evaluaciones/$id_evaluacion"));
                
            }
                $data = [
                'mensaje-recurso'  => 'El recurso se agrego correctamente correctamente',
                'tipo-mensaje' => 'alert-success'
                ];
                $this->session->set($data, true);
                return redirect()->to(site_url("Recursos/formrecursos"));
            }else{
                return redirect()->to(site_url('Home/salir'));
            }
        } else {
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function AjaxNiveles(){
        $REQUEST = \Config\Services::request();
        $Id_Curso = $REQUEST->getPost('Id_Curso');
        $UserModel = new Cursos_model($db);
        $UserModel->select('num_niveles');
        $UserModel->where('id',$Id_Curso);
        $UserModel->where('deleted',0);
        $Query = $UserModel->get();
        $Resultado = $Query->getRow();
        echo "<option value=''>Seleccione una opción</option>";
        for($i=1;$i<=$Resultado->num_niveles;$i++){
          echo "<option value=$i>$i</option>";
        } 
    }

    public function AjaxSesiones(){
        $REQUEST = \Config\Services::request();
        $Id_Curso = $REQUEST->getPost('Id_Curso');
        $UserModel = new Cursos_model($db);
        $UserModel->select('total_dias_laborales');
        $UserModel->where('id',$Id_Curso);
        $UserModel->where('deleted',0);
        $Query = $UserModel->get();
        $Resultado = $Query->getRow();
        echo "<option value=''>Seleccione una opción</option>";
        for($i=1;$i<=$Resultado->total_dias_laborales;$i++){
            echo "<option value=$i>Sesion $i</option>";
        }
    } 

    public function ActualizarRecurso(){
        if ($this->session->get('login') && $this->session->get('roll') == 4) {
            if(isset($_POST['actualizarRecurso'])){
                $hoy = date("Y-m-d H:i:s");
                $REQUEST = \Config\Services::request();
                $useModelRecursos = new Recursos_model($db);

                $curso = $REQUEST->getPost('curso');
                $nivel = $REQUEST->getPost('nivel');
                $sesion = $REQUEST->getPost('sesion');

                $nombreCurso = CatalagoGetNombreCurso($curso);
                $nombreNivel = getnivelEspecifico($nivel);
                $nombreSesion = 'Sesion'.''.$sesion;

                if($REQUEST->getPost('tipoRecurso') == 1){
                    $idTipoEvaluacion = $REQUEST->getPost('tipoFormulario');
                    $idCategegoriaEvaluacion = $REQUEST->getPost('tipocategoriaevaluacion');
                    $nombreEvaluacion = $REQUEST->getPost('nombreEvaluacion');
                   
                    if (!is_dir("recursos/$nombreCurso/$nombreNivel/$nombreSesion")) {
                        try {
                            mkdir("recursos/$nombreCurso/$nombreNivel/$nombreSesion", 0777, TRUE);
                        }catch(\Exception $e){

                        }  
                    }
                    $rutaActual = ObtenerRutaEvaluacion($REQUEST->getPost('idEvaluacion'));
                    $claveEvaluacion = ObtenerClaveEvaluacion($REQUEST->getPost('idEvaluacion'));
                    $rutaNueva = "recursos/$nombreCurso/$nombreNivel/$nombreSesion/$claveEvaluacion";

                    try {
                        rename($rutaActual,$rutaNueva);
                    } catch (\Exception $e) {
                         
                    }
                    $dataEvaluacion = [ 'nombre' =>$nombreEvaluacion, 
                    'tipo_evaluacion'=> $idTipoEvaluacion,
                    'idCategoriaEvaluacion' => $idCategegoriaEvaluacion,
                    'fecha_ultimo_cambio'=>$hoy,
                    'directorio_uploads' => $rutaNueva,
                    ];
                    try {
                        ActualizarEvaluacion($REQUEST->getPost('idEvaluacion'),$dataEvaluacion);
                    } catch (\Exception $e){
                        //throw $th;
                    }
                    $dataRecurso = ['nombre' =>$nombreEvaluacion,
                    'id_curso' => $curso,
                    'id_nivel' => $nivel,
                    'id_leccion' => $sesion,
                    'fecha_ultimo_cambio' => $hoy,
                    ];

                    try{
                        $useModelRecursos->update($REQUEST->getPost('idRecurso'),$dataRecurso);
                    }catch(\Exception $e) {
                         
                    }
                    foreach(ObtenerPreguntasdeEvaluacionEspecifica($REQUEST->getPost('idEvaluacion')) as $fila){
                        if($fila->tiene_imagen == 1){
                            $rutaNuevaImagen = "recursos/$nombreCurso/$nombreNivel/$nombreSesion/$claveEvaluacion/imagen-pregunta/$fila->clave_pregunta_imagen";
                            $data = ['ruta_imagen'=>$rutaNuevaImagen,
                            'fecha_ultimo_cambio' => $hoy,
                            ];
                            try {
                                ActualizarPregunta($fila->id,$data);
                            } catch (\Throwable $th) {
                                //throw $th;
                            }
                            
                        }
                        if($fila->tiene_audio_pregunta == 1){
                            $rutaNuevaAudio = "recursos/$nombreCurso/$nombreNivel/$nombreSesion/$claveEvaluacion/audio-pregunta/$fila->clave_pregunta_audio";
                            $data = ['ruta_audio_pregunta'=>$rutaNuevaAudio,
                            'fecha_ultimo_cambio' => $hoy,
                            ];
                            try {
                                ActualizarPregunta($fila->id,$data);
                            } catch (\Throwable $th) {
                                //throw $th;
                            }
                            
                        }

                    }
                   
                    echo "Checar la vieja ruta $rutaActual y ver la nueva ruta $rutaNueva";

                }else{
                     //NUEVA RUTA
                    $nombreRecurso = $REQUEST->getPost('nombreRecurso');
                    if (!is_dir("recursos/$nombreCurso/$nombreNivel/$nombreSesion")) {
                        try {
                            mkdir("recursos/$nombreCurso/$nombreNivel/$nombreSesion", 0777, TRUE);
                        }catch(\Exception $e){

                        }  
                    }
                    $rutaActual = ObtenerRutaActualdeRecurso($REQUEST->getPost('idRecurso'));
                    $rutaNueva = "recursos/$nombreCurso/$nombreNivel/$nombreSesion/$nombreRecurso";

                    try {
                        rename($rutaActual,$rutaNueva);
                    } catch (\Exception $e) {
                         
                    }
                    $data = ['id_curso' => $curso,
                    'id_nivel' => $nivel,
                    'id_leccion' => $sesion,
                    'ruta' => $rutaNueva,
                    'fecha_ultimo_cambio' => $hoy,
                    ];

                    try {
                        $useModelRecursos->update($REQUEST->getPost('idRecurso'),$data);
                    }catch(\Exception $e) {
                         
                    }
                   
                    echo "Checar la vieja ruta $rutaActual y ver la nueva ruta $rutaNueva";
                }
                
            }else{
                return redirect()->to(site_url('Home/salir'));
            }

        }else{
            return redirect()->to(site_url('Home/salir'));
        }
       
    }
}
