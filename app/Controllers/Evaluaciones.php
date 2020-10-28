<?php namespace App\Controllers;
use  App\Models\Evaluaciones_model;
class Evaluaciones extends BaseController{

    public function index()
	{
        $data['page_title'] = "Evaluaciones";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('evaluaciones/tipo_evaluaciones',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
  
    public function crear_evaluacion()
    {
        if($this->session->get('login')){
            $data['page_title'] = "Evaluaciones";	
        return view('evaluaciones/crear/crear_evaluaciones',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
        
    }

    public function tipo_evaluacion($view)
    {
        //Nos indica si es sistema o exci o basic 
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
        
    }

    public function lecciones($id_evaluacion,$id_nivel)
    {   //Estos parametros son enviados desde la vista niveles 
        $data['id_evaluaciones'] = $id_evaluacion;
        $data['id_nivel'] = $id_nivel;
        //Hacemos esto para pasarlo ala pagina de manera dinamica 
        //y mas adelante se hara un query 
        if($this->session->get('login')){
        return view('evaluaciones/mostrar/lecciones',$data);
    }else{
        return redirect()->to(site_url('Home/salir'));
       }
    }


    public function panel_evaluaciones($id_evaluacion,$id_nivel,$id_leccion)
    {
        $data['id_evaluacion'] = $id_evaluacion;
        $data['id_nivel'] = $id_nivel;
        $data['id_leccion'] = $id_leccion;
        if($this->session->get('login')){
        return view('evaluaciones/panel_evaluaciones',$data);
    }else{
        return redirect()->to(site_url('Home/salir'));
       }
    }

    //-------------------------------------------------- Funciones para insertar o actualizar en la base de datos ----------------------------------
    public function insertar_evaluacion()
    {
        if(isset($_POST['crearEvaluacion'])){
            $usermodel = new Evaluaciones_model($db);
            $REQUEST = \Config\Services::request();
        
            //Capturamos los datos que son enviados 
            $nombre_evaluacion = $REQUEST->getPost('nombreEvaluacion');
            $instrucciones = $REQUEST->getPost('instrucciones');
            $tipo_evaluacion = $REQUEST->getPost('tipoEvaluacion');
            $nivel = $REQUEST->getPost('nivel');
            $leccion = $REQUEST->getPost('leccion');
            $id_usuario = $REQUEST->getPost('idUsuario');
            $estado = $REQUEST->getPost('estado');
            $hoy = date("Y-m-d H:i:s");


            //Primero comprobamos si ya existe una evaluacion

            $query = "SELECT * FROM evaluaciones WHERE tipo_evaluacion = $tipo_evaluacion AND nivel = $nivel AND leccion = $leccion";
            $resultado = $usermodel->query($query);
            $rowArray = $resultado -> getRow();
            if(!empty($rowArray)){
                //Si esta vacio segnifica que no hay una evaluacion para en el nivel y seccion especifico 
                $this->session->set('creada', true);
                if($this->session->get('login')){	
                    return redirect()->to(site_url('Evaluaciones/crear_evaluacion'));
                }else{
                    return redirect()->to(site_url('Home/salir'));
                   }
         }

          
            //Forma de tener la clave 
            $hoyLimpio        = str_replace(' ','',$hoy);
            $hoyLimpio        = str_replace(':','',$hoyLimpio);
            $hoyLimpio        = str_replace('-','',$hoyLimpio);
            $nombreDirectorio ="EV".$id_usuario.$hoyLimpio;
            //Variable para la ruta 
            $nombreRuta = "uploads/".$nombreDirectorio;
  
 $sqlInsert = "INSERT INTO evaluaciones(nombre,instrucciones,tipo_evaluacion,nivel,leccion,usuario_creo,usuario_modifico,estado,fecha_creacion,fecha_ultimo_cambio,clave,directorio_uploads) values ('".$nombre_evaluacion."','".$instrucciones."',$tipo_evaluacion,$nivel,$leccion,$id_usuario,$id_usuario,$estado,'".$hoy."','".$hoy."','".$nombreDirectorio."','".$nombreRuta."')";
               
             //Ejecutamos el query 
            $resultado = $usermodel->query($sqlInsert);



            return redirect()->to(site_url('Evaluaciones/crear_evaluacion'));

        }
        
       


    }

   






}