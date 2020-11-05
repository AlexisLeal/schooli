<?php namespace App\Controllers;
use  App\Models\Usuarios; 
use  App\Models\Direcciones;
use  App\Models\Alumnos_model;

class Alumnos extends BaseController{

    public function index()
	{
        
        if($this->session->get('login')){
        $data['page_title'] = "Alumnos";	
        return view('alumnos/panel_alumnos',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    //Tambien le podemos pasar el parametro de la matricula 
    public function verAlumno($id_alumno)
    {
        if($this->session->get('login')){
        $usermodel_D = new Direcciones($db);
        $usermodel_U = new Usuarios($db);
        $usermodel_A = new alumnos($db);

        $query_A = "SELECT * from alumnos WHERE id = $id_alumno AND deleted = 0";
        $resultado_A = $usermodel_A->query($query_A);
        $row_A = $resultado_A->getRow();
        //--------------------------------------------------------------------
        $query_U = "SELECT * from usuarios WHERE id = $row_A->id_usuario AND deleted = 0";
        $resultado_U = $usermodel_U->query($query_U);
        $row_U = $resultado_U->getRow();
        //--------------------------------------------
        $query_D = "SELECT * from direcciones WHERE id = $row_U->id_direccion AND deleted = 0";
        $resultado_D = $usermodel_U->query($query_U);
        $row_D = $resultado_D->getRow();

        //Aqui vamos a poner todos los datos de un alumno especifico

        return view('alumnos/mostrar/ver_alumno',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    

    public function agregaralumnos()
    {   
        if($this->session->get('login')){
        return view('alumnos/crear/agregar_alumno');

        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    public function editaralumnos()
    {   
        if($this->session->get('login')){
        return view('alumnos/editar/editar_alumno');

        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }

    public function insertarAlumno()
    {
        if($this->session->get('login')){
            
            if(isset($_POST['submitAL'])){
                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");
                //Caputaramos los datos de la dirrecion 
                $data_direccion =[
                    'calle' => $REQUEST->getPost(),
                    'numero_interior' => $REQUEST->getPost(),
                    'numero_exterior' => $REQUEST->getPost(),
                    'colonia' => $REQUEST->getPost(),
                    'codigo_postal' => $REQUEST->getPost(),
                    'municipio_delegacion' => $REQUEST->getPost(),
                    'id_entidad_federativa' => $REQUEST->getPost(),
                    'pais' => $REQUEST->getPost(),
                    'fecha_creacion' => $hoy,
                    'fecha_ultimo_cambio' => $hoy,
                ];
                //Insertamos los datos de la dirrecion 
                $usermodel_D = new Direcciones($db);
                $usermodel_D->insert($data_direccion); 
                $ultimo_id_direccion = $usermodel_D->insertID();

                 //Capturamos los datos del alummno/Usuario
                $data_usuario =[
                    'nombre' => $REQUEST->getPost(),
                    'apellido_paterno' => $REQUEST->getPost(),
                    'apellido_materno' => $REQUEST->getPost(),
                    'usuario' => $REQUEST->getPost(),
                    'password' => $REQUEST->getPost(),
                    'email' => $REQUEST->getPost(),
                    'estado' => $REQUEST->getPost(),
                    'telefono' => $REQUEST->getPost(),
                    'movil' => $REQUEST->getPost(),
                    'id_direccion' => $ultimo_id_direccion,
                    'roll' => $REQUEST->getPost(),
                    'fecha_creacion' => $hoy,
                    'fecha_ultimo_cambio' => $hoy,
                    'id_tipo_usuario' => $REQUEST->getPost(),

                ];
                //Insertamos los datos 
                $usermodel_U = new Usuarios($db);
                $usermodel_U->insert($data_usuario); 
                $ultimo_id_usuario = $usermodel_U->insertID();
                //Capturamos los datos del Alumno 

                $data_alummno=[
                    'id_usuario' => $ultimo_id_usuario,
                    'matricula' => $REQUEST->getPost(),
                    'id_plantel' => $REQUEST->getPost(),
                    'id_unidad_negocio' => $REQUEST->getPost(),
                    'fecha_creacion' => $hoy,
                    'fecha_ultimo_cambio' => $hoy,
                ];

                $usermodel_A = new alumnos($db);
                $usermodel_A->insert($data_alummno); 

                //Poner una variable que nos cheque que los tres querys para crear una variable de session 
                return redirect()->to(site_url('Alumnos/agregaralumnos'));
        
    }else{
        return redirect()->to(site_url('Home/salir'));
       }
    }
	

    }


    public function editar($id_alumno)
    {
        
    }


    public function eliminarAlumno($id_alumno)
    {
        if($this->session->get('login')){
            $usermodel_D = new Direcciones($db);
            $usermodel_U = new Usuarios($db);
            $usermodel_A = new alumnos($db);
                
        $query_A = "SELECT id from alumnos WHERE id = $id_alumno AND deleted = 0";
        $resultado_A = $usermodel_A->query($query_A);
        $row_A = $resultado_A->getRow();
        //--------------------------------------------------------------------
        $query_U = "SELECT id from usuarios WHERE id = $row_A->id_usuario AND deleted = 0";
        $resultado_U = $usermodel_U->query($query_U);
        $row_U = $resultado_U->getRow();
        //--------------------------------------------
        $query_D = "SELECT id from direcciones WHERE id = $row_U->id_direccion AND deleted = 0";
        $resultado_D = $usermodel_U->query($query_U);
        $row_D = $resultado_D->getRow();

        $usermodel_A->delete(['id'=> $id_alumno]);
        $usermodel_U->delete(['id' => $row_A->id_usuario]);
        $usermodel_D->delete(['id' => $row_U->id_direccion]);
        //Variables de session 


        return redirect()->to(site_url('Alumnos/editaralumnos'));
    }else{
    return redirect()->to(site_url('Home/salir'));
   }
}
}