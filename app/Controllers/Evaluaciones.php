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
        if($view == 1){
            $data["tipo_evaluacion"] = "Sistema";
            $data["id_evaluacion"] = 1;
            //El id de Sistema es uno por la tabla de tipo_evaluacion

            return view('evaluaciones/mostrar/niveles',$data);
            
        }elseif($view == 2){
           //Mas a futuro se agrega la vista apropiada 
          //  $data["tipo_evaluacion"] = "Sistema";
           // return view('evaluaciones/mostrar/niveles',$data);

        }else{
            //Mas adelante se agrega la vista apropiada 

        }
        
    }

    public function lecciones()
    {   
        return view();
    }

    //-------------------------------------------------- Funciones para insertar o actualizar en la base de datos ----------------------------------
    public function insertar_evaluaciion()
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
          
            //Forma de tener la clave 
            $hoyLimpio        = str_replace(' ','',$hoy);
            $hoyLimpio        = str_replace(':','',$hoyLimpio);
            $hoyLimpio        = str_replace('-','',$hoyLimpio);
            $nombreDirectorio ="EV".$id_usuario.$hoyLimpio;
            //Variable para la ruta 
            $nombreRuta = "Uploads/".$nombreDirectorio;

         /*   $query = "select nombre from evaluaciones where nombre like '%"$nombre_evaluacion"%'";
            $resultado = $usermodel->query($query);
            $row = $resultado->getRow();//Obtemos el numero de columnas que nos regresa el query 
            if($row > 0){
                $nombre_evaluacion_existe = true;
            }
*/
  
 $sqlInsert = "INSERT INTO evaluaciones(nombre,instrucciones,tipo_evaluacion,nivel,leccion,usuario_creo,usuario_modifico,estado,fecha_creacion,fecha_ultimo_cambio,clave,directorio_uploads) values ('".$nombre_evaluacion."','".$instrucciones."',$tipo_evaluacion,$nivel,$leccion,$id_usuario,$id_usuario,$estado,'".$hoy."','".$hoy."','".$nombreDirectorio."','".$nombreRuta."')";
               
            //Ejecutamos el query 
             $resultado = $usermodel->query($sqlInsert);

            return redirect()->to(site_url('Evaluaciones/crear_evaluacion'));


        }
        
       


    }

   






}