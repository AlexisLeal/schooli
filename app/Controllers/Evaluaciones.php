<?php namespace App\Controllers;
use  App\Models\Evaluaciones_model;
class Evaluaciones extends BaseController{


    //Funcion old
    public function index()
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Evaluaciones";	
           
            return view('evaluaciones/tipo_evaluaciones',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    //Funcion old
    public function crear_evaluacion()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Evaluaciones";	

            return view('evaluaciones/crear/crear_evaluaciones',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
        
    }
    //Funcion old
    public function tipo_evaluacion($view)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if($view == 1){

            $data["tipo_evaluacion"] = "Sistema";
            $data["id_evaluacion"] = 1;
           
            return view('evaluaciones/mostrar/niveles',$data);
            
        }elseif($view == 2){
           
        }else{
           

        }
        }else{
            return redirect()->to(site_url('Home/salir'));
       }
        
    }
    //Funcion old 
    public function lecciones($id_evaluacion,$id_nivel)
    {   
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['id_evaluaciones'] = $id_evaluacion;
            $data['id_nivel'] = $id_nivel;

            return view('evaluaciones/mostrar/lecciones',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
       }
    }


    public function panel_evaluaciones($id_evaluacion)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){

            $data['id_evaluacion'] = $id_evaluacion;

            return view('evaluaciones/panel_evaluaciones',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

   
    //Funcion old
    public function insertar_evaluacion()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['crearEvaluacion'])){
                $usermodel = new Evaluaciones_model($db);
                $REQUEST = \Config\Services::request();
               
                $tipo_evaluacion = $REQUEST->getPost('tipoEvaluacion');
                $nivel = $REQUEST->getPost('nivel');
                $leccion = $REQUEST->getPost('leccion');
                $hoy = date("Y-m-d H:i:s");

                $data = ['nombre' => $REQUEST->getPost('nombreEvaluacion'),
                'instrucciones' => $REQUEST->getPost('instrucciones'),
                'tipo_evaluacion' => $REQUEST->getPost('tipoEvaluacion'),
                'idCategoriaEvaluacion' => $REQUEST->getPost('categoriaEvaluacion'),
                'nivel' => $REQUEST->getPost('nivel'),
                'leccion' => $REQUEST->getPost('leccion'),
                'usuario_creo' => $REQUEST->getPost('idUsuario'),
                'usuario_modifico' => $REQUEST->getPost('idUsuario'),
                'estado' => $REQUEST->getPost('estado'),
                'fecha_creacion' => $hoy,
                'fecha_ultimo_cambio' => $hoy,
                ];
               
                $usermodel->select('tipo_evaluacion,nivel,leccion');
                $usermodel->where('tipo_evaluacion',$tipo_evaluacion);
                $usermodel->where('nivel',$nivel);
                $usermodel->where('leccion',$leccion);
                $usermodel->where('deleted',0);
                $resultado = $usermodel->get();
                $fila = $resultado -> getRow();    

            if(!empty($fila)){
               
                $data = ['existe'  => 'La evaluaciòn ya existe'];
                $this->session->set($data,true);

                if($this->session->get('login')){	
                    return redirect()->to(site_url('Evaluaciones/crear_evaluacion'));
                }else{
                    return redirect()->to(site_url('Home/salir'));
                }
            }

            $usermodel->insert($data);
            $id = $usermodel->insertID();
    
             
            //Forma de tener la clave 
            $hoyLimpio        = str_replace(' ','',$hoy);
            $hoyLimpio        = str_replace(':','',$hoyLimpio);
            $hoyLimpio        = str_replace('-','',$hoyLimpio);
            $clave ="EV".$id.$hoyLimpio;           
            $nombreRuta = base_url("uploads/$clave");

            //Actualizamos para inserta la clave y su ruta 
            $sqlUpdate ="UPDATE evaluaciones set clave = '".$clave."',directorio_uploads='".$nombreRuta."' where id=$id";
            $usermodel->query($sqlUpdate);

            //Creamos una carpeta donde se guardaran todos los archivos de la evaluacion(Imagenes,videos etc )
            if (!is_dir('uploads/'.$clave)) {
                mkdir('./uploads/' .$clave, 0777, TRUE);
            }else{
                echo "Se pone una view que marque que hubo un error inesperado ";
            }
            $data = ['exito'  => 'Se ha creado la evaluación correctamente'];
            $this->session->set($data,true);

            return redirect()->to(site_url('Evaluaciones/crear_evaluacion'));
    
              
            }
        }

    }  
}

   






