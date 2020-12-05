<?php namespace App\Controllers;
use  App\Models\Usuarios; 
use  App\Models\Direcciones;
use  App\Models\Maestros;


class Teachers extends BaseController{

    public function index()
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Teachers";

            return view('teachers/panel_teacher',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
	}
	

    public function agregarteacher()
	{
       	
        if($this->session->get('login') && $this->session->get('roll') == 4){
            $data['page_title'] = "Teachers";
            return view('teachers/crear/agregar_teacher');
            }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }
    
    public function verTeachers($id_maestro)
	{
       	
        if($this->session->get('login') && $this->session->get('roll') == 4){
/*
            $usermodel_M = new Maestros($db);
            $usermodel_M->selec('idPlantel,idUnidadNegocio,comentarios,id_usuario');
            $usermodel_M->where('deleted',0);
            $query_M = "SELECT idPlantel,idUnidadNegocio,comentarios,id_usuario from maestros WHERE id = $id_maestro AND deleted = 0";
            $resultado_M = $usermodel_M->query($query_M);
            $row_M = $resultado_M->getRow();
            //--------------------------------------------------------------------
            $usermodel_U = new Usuarios($db);
            $query_U = "SELECT * from usuarios WHERE id = $row_M->id_usuario AND deleted = 0";
            $resultado_U = $usermodel_U->query($query_U);
            $row_U = $resultado_U->getRow();
            //--------------------------------------------
            $usermodel_D = new Direcciones($db);
            $query_D = "SELECT * from direcciones WHERE id = $row_U->id_direccion AND deleted = 0";
            $resultado_D = $usermodel_D->query($query_D);
            $row_D = $resultado_D->getRow();
            //-------------------------
  */         
                    //Aqui vamos a poner todos los datos de un alumno especifico
            
                    //Nueva Forma 
          $db = \Config\Database::connect();
          $usermodel = $db->table('usuarios U');
          $usermodel->select('U.nombre,U.apellido_paterno,U.apellido_materno,U.usuario,U.email,
           U.estado,U.telefono,U.movil,U.roll,TH.id_usuario,TH.idPlantel,TH.idUnidadNegocio,
           TH.comentarios,D.calle,D.numero_interior,D.numero_exterior,
           D.colonia,D.codigo_postal,D.municipio_delegacion,D.id_entidad_federativa,D.id_pais');
           $usermodel->join('maestros TH'," TH.id_usuario = U.id and TH.id = $id_maestro and U.deleted = 0 and TH.deleted = 0");
           $usermodel->join('direcciones D',' D.id = U.id_direccion and D.deleted = 0');
           $resultado = $usermodel->get();   
           $row = $resultado->getRow();
    
                    //Usuario 
            $data['nombre'] = $row->nombre;
            $data['apeliido_paterno'] = $row->apellido_paterno;
            $data['apeliido_materno'] = $row->apellido_materno;
            $data['usuario'] = $row->usuario;
            $data['email'] = $row->email;
            $data['estado'] = ($row->estado == 1) ? "Activo" : "Inactivo";
            $data['telefono'] = $row->telefono;
            $data['movil'] = $row->movil;
            $data['roll'] = getRollEspecifico($row->roll);
            //Maestro
            $data['plantel'] =getPlanteEspecifico($row->idPlantel);
            $data['unidad_negocio'] = getUnidadNegocioEspecifico($row->idUnidadNegocio);
            $data['comentarios'] = $row->comentarios;
           
            //Dirrecion 
            $data['calle'] = $row->calle;
            $data['numero_interior'] = $row->numero_interior;
            $data['numero_exterior'] = $row->numero_exterior;
            $data['colonia'] = $row->colonia;
            $data['codigo_postal'] = $row->codigo_postal;
            $data['municipio_delegacion'] = $row->municipio_delegacion;
            //Estado
            $data['estado'] = getEstadoEspecifico($row->id_entidad_federativa);
            //Pais 
            $data['pais'] = getPaisEspecifico($row->id_pais);
    
           
            return view('teachers/mostrar/ver_teacher',$data);
            }else{
                return redirect()->to(site_url('Home/salir'));
               }
    }
    

    public function editarTeachers($id_maestro)
	{
       	
        if($this->session->get('login') && $this->session->get('roll') == 4){
              /*
                $usermodel_M = new Maestros($db);
                $query_M = "SELECT * from maestros WHERE id = $id_maestro AND deleted = 0";
                $resultado_M = $usermodel_M->query($query_M);
                $row_M = $resultado_M->getRow();
                //--------------------------------------------------------------------
                $usermodel_U = new Usuarios($db);
                $query_U = "SELECT * from usuarios WHERE id = $row_M->id_usuario AND deleted = 0";
                $resultado_U = $usermodel_U->query($query_U);
                $row_U = $resultado_U->getRow();
                //--------------------------------------------
                $usermodel_D = new Direcciones($db);
                $query_D = "SELECT * from direcciones WHERE id = $row_U->id_direccion AND deleted = 0";
                $resultado_D = $usermodel_D->query($query_D);
                $row_D = $resultado_D->getRow();
                //-------------------------
               */
                        //Aqui vamos a poner todos los datos de un alumno especifico
                //Nueva Forma
                $db = \Config\Database::connect();
                $usermodel = $db->table('usuarios U');
                $usermodel->select('U.nombre,U.apellido_paterno,U.apellido_materno,U.usuario,U.email,
                 U.estado,U.telefono,U.movil,U.roll,TH.id_usuario,TH.idPlantel,TH.idUnidadNegocio,
                 TH.comentarios,D.calle,D.numero_interior,D.numero_exterior,
                 D.colonia,D.codigo_postal,D.municipio_delegacion,D.id_entidad_federativa,D.id_pais');
                 $usermodel->join('maestros TH'," TH.id_usuario = U.id and TH.id = $id_maestro and U.deleted = 0 and TH.deleted = 0");
                 $usermodel->join('direcciones D',' D.id = U.id_direccion and D.deleted = 0');
                 $resultado = $usermodel->get();   
                 $row = $resultado->getRow();
          
                //Usuario  
                $data['nombre'] = $row->nombre;
                $data['apeliido_paterno'] = $row->apellido_paterno;
                $data['apeliido_materno'] = $row->apellido_materno;
                $data['usuario'] = $row->usuario;
                $data['email'] = $row->email;
                $data['estado'] = ($row->estado == 1) ? "Activo" : "Inactivo";
                $data['telefono'] = $row->telefono;
                $data['movil'] = $row->movil;
                $data['roll'] = $row->roll;
        
                //Maestro
                $data['plantel'] =$row->idPlantel;
                $data['unidad_negocio'] = $row->idUnidadNegocio;
                $data['comentarios'] = $row->comentarios;
               
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
                 //ID_Alumno
                $data['idMaestro'] = $id_maestro;
                
        
            return view('teachers/editar/editar_teacher',$data);
            }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }
    
    //Funciones para CRUD de teachers 

    public function insertarmaestro()
    {
    
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitTH'])){
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
                    'usuario' => trim($REQUEST->getPost('usuario')),
                    'password' => trim($REQUEST->getPost('password')),
                    'email' => $REQUEST->getPost('email'),
                    'estado' => 1,
                    'telefono' => $REQUEST->getPost('telefono'),
                    'movil' => $REQUEST->getPost('movil'),
                    'id_direccion' => $ultimo_id_direccion,
                    'roll' => $REQUEST->getPost('roll'),
                    'fecha_creacion' => $hoy,
                    'fecha_ultimo_cambio' => $hoy,
                    'id_tipo_usuario' => 3,

                ];
                //Insertamos los datos 
                $usermodel_U = new Usuarios($db);
                $usermodel_U->insert($data_usuario); 
                $ultimo_id_usuario = $usermodel_U->insertID();
                //Capturamos los datos del Alumno 

                $data_maestro =[
                    'id_usuario' => $ultimo_id_usuario,
                    'idPlantel' => $REQUEST->getPost('plantel'),
                    'idUnidadNegocio' => $REQUEST->getPost('unidad_negocio'),
                    'comentarios' => $REQUEST->getPost('comentarios'),
                    'fecha_creacion' => $hoy,
                    'fecha_ultimo_cambio' => $hoy,
                ];

                $usermodel_M = new Maestros($db);
                $usermodel_M->insert($data_maestro); 

                //Poner una variable que nos cheque que los tres querys para crear una variable de session 
                $data = ['Maestro'  => 'El Maestro se agregro correctamente'];
                $this->session->set($data,true);
                return redirect()->to(site_url('Teachers/agregarteacher'));
        
    }else{
        return redirect()->to(site_url('Home/salir'));
    }

        }else{
        return redirect()->to(site_url('Home/salir'));
	
    }

    }


    public function editar()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            
            if(isset($_POST['submitTH'])){
                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");

                //Capturamos los datos del Alumno
                $data_maestro=[
                    'idPlantel' => $REQUEST->getPost('plantel'),
                    'idUnidadNegocio' => $REQUEST->getPost('unidad_negocio'),
                    'comentarios' => $REQUEST->getPost('comentarios'),
                    'fecha_ultimo_cambio' => $hoy,
                ];

                    //Capturamos los datos del alummno/Usuario
                    $data_usuario =[
                        'nombre' => $REQUEST->getPost('nombre'),
                        'apellido_paterno' => $REQUEST->getPost('apellido_paterno'),
                        'apellido_materno' => $REQUEST->getPost('apellido_materno'),
                        'usuario' => trim($REQUEST->getPost('usuario')),
                        'email' => $REQUEST->getPost('email'),
                        'telefono' => $REQUEST->getPost('telefono'),
                        'movil' => $REQUEST->getPost('movil'),
                        'roll' => $REQUEST->getPost('roll'),
                        'fecha_ultimo_cambio' => $hoy,
                    ];
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
                    'fecha_ultimo_cambio' => $hoy,
                ];
                $id_maestro = $REQUEST->getPost('idMaestro');
                /*
               
                $usermodel_M->select('id_usuario');
                $usermodel_M->where('id',$id_maestro);
                $usermodel_M->where('deleted',0);
               // $query_M = "SELECT id_usuario from maestros WHERE id = $id_maestro AND deleted = 0";
                $resultado_M = $usermodel_M->get();
                $row_M = $resultado_M->getRow();
                //--------------------------------------------------------------------
                $usermodel_U = new Usuarios($db);
                $usermodel_U->select('id_direccion');
                $query_U = "SELECT id_direccion from usuarios WHERE id = $row_M->id_usuario AND deleted = 0";
                $resultado_U = $usermodel_U->query($query_U);
                $row_U = $resultado_U->getRow();
                //--------------------------------------------
               */
             
              $db = \Config\Database::connect();
              $usermodel = $db->table('usuarios U');
              $usermodel->select('TH.id_usuario,U.id_direccion');
              $usermodel->join('maestros TH',"TH.id_usuario = U.id and TH.id = $id_maestro and U.deleted = 0 and TH.deleted = 0 ");
              $usermodel->join('direcciones D','D.id = U.id_direccion and D.deleted = 0');
              $resultado = $usermodel->get();   
              $row = $resultado->getRow();
               
               
                $usermodel_M = new Maestros($db);
                $usermodel_M->update($id_maestro,$data_maestro);

                $usermodel_U = new Usuarios($db);
                $usermodel_U->update($row->id_usuario,$data_usuario);

                //SE ACTUALIZA POR ID EL PRIMER PARAMETRO EL EL ID 
                $usermodel_D = new Direcciones($db);
                $usermodel_D->update($row->id_direccion,$data_direccion);


                 //Poner una variable que nos cheque que los tres querys para crear una variable de session 
                 $data = ['Maestro'  => 'El Maestro se modifico correctamente'];
                 $this->session->set($data,true);
                 return redirect()->to(site_url("Teachers/editarTeachers/$id_maestro"));


            }                
    }else{
        return redirect()->to(site_url('Home/salir'));
       }
    }


    public function eliminarTeachers(){
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitTH'])){
                $REQUEST = \Config\Services::request();
                $id_maestro = $REQUEST->getPost('idMaestro');
                
     /*           
        $query_M = "SELECT * from maestros WHERE id = $id_maestro AND deleted = 0";
        $resultado_M = $usermodel_M->query($query_M);
        $row_M = $resultado_M->getRow();
        //--------------------------------------------------------------------
        $query_U = "SELECT * from usuarios WHERE id = $row_M->id_usuario AND deleted = 0";
        $resultado_U = $usermodel_U->query($query_U);
        $row_U = $resultado_U->getRow();
        //--------------------------------------
*/
            $db = \Config\Database::connect();
            $usermodel = $db->table('usuarios U');
            $usermodel->select('TH.id_usuario,U.id_direccion');
            $usermodel->join('maestros TH',"TH.id_usuario = U.id and TH.id = $id_maestro and U.deleted = 0 and TH.deleted = 0 ");
            $usermodel->join('direcciones D','D.id = U.id_direccion and D.deleted = 0');
            $resultado = $usermodel->get();   
            $row = $resultado->getRow(); 

        $usermodel_M = new Maestros($db);       
        $usermodel_M->delete(['id'=> $id_maestro]);

        $usermodel_U = new Usuarios($db);
        $usermodel_U->delete(['id' => $row->id_usuario]);
        
        $usermodel_D = new Direcciones($db);
        $usermodel_D->delete(['id' => $row->id_direccion]);
        //Variables de session 
        return redirect()->to(site_url('Teachers/index'));

    
     }else{
            return redirect()->to(site_url('Home/salir'));
        }

 }else{
    return redirect()->to(site_url('Home/salir'));
}
}
}


