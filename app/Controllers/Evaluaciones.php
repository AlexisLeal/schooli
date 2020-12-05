<?php namespace App\Controllers;
use  App\Models\Evaluaciones_model;
class Evaluaciones extends BaseController{



    public function index()
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Evaluaciones";	
            //Pasamos de forma dinamica el titulo  y se crear un array   
            return view('evaluaciones/tipo_evaluaciones',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
  
    public function crear_evaluacion()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Evaluaciones";	
            return view('evaluaciones/crear/crear_evaluaciones',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
        
    }

    public function tipo_evaluacion($view)
    {
        //Nos indica si es sistema o exci o basic 

        if($this->session->get('login') && $this->session->get('roll') == 4){
            if($view == 1){
            $data["tipo_evaluacion"] = "Sistema";
            $data["id_evaluacion"] = 1;
            //El id de Sistema es uno por la tabla de tipo_evaluacion
            return view('evaluaciones/mostrar/niveles',$data);
            
        }elseif($view == 2){
           //Mas a futuro se agrega la vista apropiada 
          //  $data["tipo_evaluacion"] = "EXCI";
           // return view('evaluaciones/mostrar/niveles',$data);

        }else{
            //Mas adelante se agrega la vista apropiada 

        }
        }else{
            return redirect()->to(site_url('Home/salir'));
       }
        
    }

    public function lecciones($id_evaluacion,$id_nivel)
    {   //Estos parametros son enviados desde la vista niveles 
        $data['id_evaluaciones'] = $id_evaluacion;
        $data['id_nivel'] = $id_nivel;
        //Hacemos esto para pasarlo ala pagina de manera dinamica 
        //y mas adelante se hara un query 
        if($this->session->get('login') && $this->session->get('roll') == 4){
            return view('evaluaciones/mostrar/lecciones',$data);
    }else{
        return redirect()->to(site_url('Home/salir'));
       }
    }


    public function panel_evaluaciones($id_evaluacion,$id_nivel,$id_leccion)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['id_evaluacion'] = $id_evaluacion;
            $data['id_nivel'] = $id_nivel;
            $data['id_leccion'] = $id_leccion;
        
            return view('evaluaciones/panel_evaluaciones',$data);
    }else{
        return redirect()->to(site_url('Home/salir'));
       }
    }

    //-------------------------------------------------- Funciones para insertar o actualizar en la base de datos ----------------------------------
    public function insertar_evaluacion()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['crearEvaluacion'])){
                $usermodel = new Evaluaciones_model($db);
                $REQUEST = \Config\Services::request();
                //Capturamos los datos que son enviados 
                //$nombre_evaluacion = $REQUEST->getPost('nombreEvaluacion');
                //$instrucciones = $REQUEST->getPost('instrucciones');
                $tipo_evaluacion = $REQUEST->getPost('tipoEvaluacion');
                //$categoriaEvaluacion = $REQUEST->getPost('categoriaEvaluacion');
                $nivel = $REQUEST->getPost('nivel');
                $leccion = $REQUEST->getPost('leccion');
                //$id_usuario = $REQUEST->getPost('idUsuario');
                //$estado = $REQUEST->getPost('estado');
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
                //Primero comprobamos si ya existe una evaluacion
                $usermodel->select('tipo_evaluacion,nivel,leccion');
                $usermodel->where('tipo_evaluacion',$tipo_evaluacion);
                $usermodel->where('nivel',$nivel);
                $usermodel->where('leccion',$leccion);
                $usermodel->where('deleted',0);
                //$query = "SELECT * FROM evaluaciones WHERE tipo_evaluacion = $tipo_evaluacion AND nivel = $nivel AND leccion = $leccion AND deleted = 0;";
                $resultado = $usermodel->get();
                //$resultado = $usermodel->query($query);
                $fila = $resultado -> getRow();
                // Crear variable se sesion
            

            if(!empty($fila)){
                //Si esta vacio segnifica que no hay una evaluacion para en el nivel y seccion especifico 
                $data = ['existe'  => 'La evaluaciòn ya existe'];
                $this->session->set($data,true);
                if($this->session->get('login')){	
                    return redirect()->to(site_url('Evaluaciones/crear_evaluacion'));
                }else{
                    return redirect()->to(site_url('Home/salir'));
                }
            }

          
 //$sqlInsert = "INSERT INTO evaluaciones(nombre,instrucciones,tipo_evaluacion,idCategoriaEvaluacion,nivel,leccion,usuario_creo,usuario_modifico,estado,fecha_creacion,fecha_ultimo_cambio) values ('".$nombre_evaluacion."','".$instrucciones."',$tipo_evaluacion,$categoriaEvaluacion,$nivel,$leccion,$id_usuario,$id_usuario,$estado,'".$hoy."','".$hoy."')";
               
            //Ejecutamos el query 
            $usermodel->insert($data);

            //Obtenemos el id de la evaluacion 
            //$query = "select id from evaluaciones where tipo_evaluacion = $tipo_evaluacion AND nivel = $nivel AND leccion = $leccion";
            //$resultado = $usermodel ->query($query);
            //$fila = $resultado -> getRow();
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

   






