<?php namespace App\Controllers;
use  App\Models\Usuarios; 
use  App\Models\Direcciones;
use  App\Models\Alumnos_model;
use  App\Models\Planteles;

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
                    'calle' => $REQUEST->getPost('calle'),
                    'numero_interior' => $REQUEST->getPost('num_interior'),
                    'numero_exterior' => $REQUEST->getPost('num_exterior'),
                    'colonia' => $REQUEST->getPost('colonia'),
                    'codigo_postal' => $REQUEST->getPost('cp'),
                    'municipio_delegacion' => $REQUEST->getPost('municipio_delegacion'),
                    'id_entidad_federativa' => $REQUEST->getPost('entidad_federativa'),
                    'id_pais' => $REQUEST->getPost('pais'),
                    'fecha_creacion' => $hoy,
                    'fecha_ultimo_cambio' => $hoy,
                ];
                //Insertamos los datos de la dirrecion 
                $usermodel_D = new Direcciones($db);
                $usermodel_D->insert($data_direccion); 
                $ultimo_id_direccion = $usermodel_D->insertID();

                 //Capturamos los datos del alummno/Usuario
                $data_usuario =[
                    'nombre' => $REQUEST->getPost('nombre'),
                    'apellido_paterno' => $REQUEST->getPost('apellido_paterno'),
                    'apellido_materno' => $REQUEST->getPost('apellido_materno'),
                    'usuario' => $REQUEST->getPost('usuario'),
                    'password' => $REQUEST->getPost('password'),
                    'email' => $REQUEST->getPost('email'),
                    'estado' => 1,
                    'telefono' => $REQUEST->getPost('telefono'),
                    'movil' => $REQUEST->getPost('movil'),
                    'id_direccion' => $ultimo_id_direccion,
                    'roll' => $REQUEST->getPost('roll'),
                    'fecha_creacion' => $hoy,
                    'fecha_ultimo_cambio' => $hoy,
                    'id_tipo_usuario' => 1,

                ];
                //Insertamos los datos 
                $usermodel_U = new Usuarios($db);
                $usermodel_U->insert($data_usuario); 
                $ultimo_id_usuario = $usermodel_U->insertID();
                //Capturamos los datos del Alumno 

                $data_alummno=[
                    'id_usuario' => $ultimo_id_usuario,
                    'matricula' => $REQUEST->getPost('matricula'),
                    'id_plantel' => $REQUEST->getPost('plantel'),
                    'id_unidad_negocio' => $REQUEST->getPost('unidad_negocio'),
                    'comentarios' => $REQUEST->getPost('comentarios'),
                    'fecha_creacion' => $hoy,
                    'fecha_ultimo_cambio' => $hoy,
                ];

                $usermodel_A = new Alumnos_model($db);
                $usermodel_A->insert($data_alummno); 

                //Poner una variable que nos cheque que los tres querys para crear una variable de session 
                $data = ['Alumno'  => 'El Alumno se agregro correctamente'];
                $this->session->set($data,true);
                return redirect()->to(site_url('Alumnos/agregaralumnos'));
        
    }else{
        return redirect()->to(site_url('Home/salir'));
       }
    }
	

    }


    public function editar($id_alumno)
    {
        
    }

    function plantelesUnidadNegocio()
    {
        
        $REQUEST = \Config\Services::request();
        $id_unidad_negocio = $REQUEST->getPost('id_unidad_negocio');
        
        $usermodel = new Planteles($db);
        $query = "SELECT id,nombre FROM  planteles WHERE deleted = 0 and id_unidad_negocio=$id_unidad_negocio";
        $resultado = $usermodel ->query($query);
        $rowArray = $resultado->getResult();
        echo "<option value=''>Seleccione una opción</option>";
        foreach($rowArray as $fila){
            echo "<option value=$fila->id>$fila->nombre</option>";
        }

    }
    

    public function eliminarAlumno($id_alumno)
    {
        if($this->session->get('login')){
            $usermodel_D = new Direcciones($db);
            $usermodel_U = new Usuarios($db);
            $usermodel_A = new Alumnos_model($db);
                
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