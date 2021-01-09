<?php namespace App\Controllers;
use  App\Models\Usuarios; 
use  App\Models\Direcciones;
use  App\Models\Alumnos_model;
use  App\Models\Planteles;
use  App\Models\Grupos_alumnos_model;
use  App\Models\Grupos_model;

class Alumnos extends BaseController{

    public function index()
	{
        if($this->session->get('login') && $this->session->get('roll') == 4){
        $data['page_title'] = "Alumnos";	
             return view('alumnos/panel_alumnos',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function verAlumno($id_alumno)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
    
            $db = \Config\Database::connect();
            $usermodel = $db->table('usuarios U');

            $usermodel->select('U.nombre,U.apellido_paterno,U.apellido_materno,U.usuario,U.email,
            U.estado,U.telefono,U.movil,U.roll,AL.id_plantel,AL.id_unidad_negocio,AL.matricula,
            AL.comentarios,D.calle,D.numero_interior,D.numero_exterior,
            D.colonia,D.codigo_postal,D.municipio_delegacion,D.id_entidad_federativa,D.id_pais');

            $usermodel->join('alumnos AL', "AL.id_usuario = U.id and AL.id = $id_alumno and U.deleted = 0 and AL.deleted = 0");
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

            //Alummno
            $data['matricula'] =$row->matricula ;
            $data['plantel'] =getPlanteEspecifico($row->id_plantel);
            $data['unidad_negocio'] = getUnidadNegocioEspecifico($row->id_unidad_negocio);
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

            return view('alumnos/mostrar/ver_alumno',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }
    
    public function agregaralumnos()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            return view('alumnos/crear/agregar_alumno');
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function editaralumno($id_alumno)
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
          
            $db = \Config\Database::connect();
            $usermodel = $db->table('usuarios U');
            $usermodel->select('U.nombre,U.apellido_paterno,U.apellido_materno,U.usuario,U.email,
            U.estado,U.telefono,U.movil,U.roll,AL.id_plantel,AL.id_unidad_negocio,AL.matricula,
            AL.comentarios,D.calle,D.numero_interior,D.numero_exterior,
            D.colonia,D.codigo_postal,D.municipio_delegacion,D.id_entidad_federativa,D.id_pais');
            $usermodel->join('alumnos AL', "AL.id_usuario = U.id and AL.id = $id_alumno and U.deleted = 0 and AL.deleted = 0");
            $usermodel->join('direcciones D',' D.id = U.id_direccion and D.deleted = 0');
            $resultado = $usermodel->get();   
            $row = $resultado->getRow();

            //Usuario  
            $data['nombre'] = $row->nombre;
            $data['apeliido_paterno'] = $row->apellido_paterno;
            $data['apeliido_materno'] = $row->apellido_materno;
            $data['email'] = $row->email;
            $data['estado'] = ($row->estado == 1) ? "Activo" : "Inactivo";
            $data['telefono'] = $row->telefono;
            $data['movil'] = $row->movil;
            $data['roll'] = $row->roll;

            //Alummno
            $data['matricula'] =$row->matricula ;
            $data['plantel'] =$row->id_plantel;
            $data['unidad_negocio'] = $row->id_unidad_negocio;
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
            $data['idAlumno'] = $id_alumno;

            return view('alumnos/editar/editar_alumno',$data);
            }else{
                return redirect()->to(site_url('Home/salir'));
            }
    }
    //Insert in DB
    public function insertarAlumno()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitAL'])){

                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");
               

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
               
                
                $usermodel_D = new Direcciones($db);
                try {
                    $usermodel_D->insert($data_direccion); 
                    $ultimo_id_direccion = $usermodel_D->insertID();
                } catch (\Exception $e) {
                    $data = ['Alumno'  => 'El Alumno no se pudo agregar correctamente'];
                    $this->session->set($data,true);
                    return redirect()->to(site_url('Alumnos/agregaralumnos'));
                }

                $usuario = strtolower(trim($REQUEST->getPost('email')));
                $data_usuario =[
                    'nombre' => $REQUEST->getPost('nombre'),
                    'apellido_paterno' => $REQUEST->getPost('apellido_paterno'),
                    'apellido_materno' => $REQUEST->getPost('apellido_materno'),
                    'usuario' => $usuario,
                    'password' => trim($REQUEST->getPost('password')),
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
               
                $usermodel_U = new Usuarios($db);
                try {
                    $usermodel_U->insert($data_usuario); 
                    $ultimo_id_usuario = $usermodel_U->insertID();
                } catch (\Exception $e) {

                    $usermodel_D->delete(['id' => $ultimo_id_direccion]);
                    $data = ['Alumno'  => 'El Alumno no se pudo agregar correctamente'];
                    $this->session->set($data,true);
                    return redirect()->to(site_url('Alumnos/agregaralumnos'));
                    
                }
                
                $data_alummno=[
                    'id_usuario' => $ultimo_id_usuario,
                    'matricula' => trim($REQUEST->getPost('matricula')),
                    'id_plantel' => $REQUEST->getPost('plantel'),
                    'id_unidad_negocio' => $REQUEST->getPost('unidad_negocio'),
                    'comentarios' => $REQUEST->getPost('comentarios'),
                    'fecha_creacion' => $hoy,
                    'fecha_ultimo_cambio' => $hoy,
                ];
                $usermodel_A = new Alumnos_model($db);
                try {
                    $usermodel_A->insert($data_alummno);
                    $ultimo_id_alumno = $usermodel_A->insertID();   
                } catch (\Exception $e) {
                    $usermodel_U->delete(['id' => $ultimo_id_usuario]);
                    $usermodel_D->delete(['id' => $ultimo_id_direccion]);
                    $data = ['Alumno'  => 'El Alumno no se pudo agregar correctamente'];
                    $this->session->set($data,true);
                    return redirect()->to(site_url('Alumnos/agregaralumnos'));
                    
                }
               
                
                $data_Grupo =['id_grupo' =>$REQUEST->getPost('id_grupo'),
                'id_alumno' =>$ultimo_id_usuario,
                'fecha_creacion' =>$hoy,
                'fecha_ultimo_cambio' =>$hoy,
                ];

                try {
                    $usermodel_GrupoAlumno = new Grupos_alumnos_model($db);
                    $usermodel_GrupoAlumno->insert($data_Grupo);
                } catch (\Exception $e) {
                    $usermodel_A->delete(['id'=> $ultimo_id_alumno]);
                    $usermodel_U->delete(['id' => $ultimo_id_usuario]);
                    $usermodel_D->delete(['id' => $ultimo_id_direccion]);
                    $data = ['Alumno'  => 'El Alumno no se pudo agregar correctamente'];
                    $this->session->set($data,true);
                    return redirect()->to(site_url('Alumnos/agregaralumnos'));   
                }
                

                $data = ['Alumno'  => 'El Alumno se agregro correctamente'];

                $this->session->set($data,true);

                return redirect()->to(site_url('Alumnos/agregaralumnos'));
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
            if(isset($_POST['submitAL'])){
                $REQUEST = \Config\Services::request();
                $hoy = date("Y-m-d H:i:s");
               
                $data_alummno=[
                    'matricula' => $REQUEST->getPost('matricula'),
                    'id_plantel' => $REQUEST->getPost('plantel'),
                    'id_unidad_negocio' => $REQUEST->getPost('unidad_negocio'),
                    'comentarios' => $REQUEST->getPost('comentarios'),
                    'fecha_ultimo_cambio' => $hoy,
                ];
               
                $usuario = strtolower(trim($REQUEST->getPost('email')));
                $data_usuario =[
                    'nombre' => $REQUEST->getPost('nombre'),
                    'apellido_paterno' => $REQUEST->getPost('apellido_paterno'),
                    'apellido_materno' => $REQUEST->getPost('apellido_materno'),
                    'usuario' => $usuario,
                    'email' => $REQUEST->getPost('email'),
                    'telefono' => $REQUEST->getPost('telefono'),
                    'movil' => $REQUEST->getPost('movil'),
                    'roll' => $REQUEST->getPost('roll'),
                    'fecha_ultimo_cambio' => $hoy,
                    ];
                
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
          
                $id_alumno = $REQUEST->getPost('idAlumno');
                $usermodel_A = new Alumnos_model($db);
                $usermodel_A->select('id_usuario');
                $usermodel_A->where('id',$id_alumno);
                $usermodel_A->where('deleted',0);
                $resultado_A = $usermodel_A->get();
                $row_A = $resultado_A->getRow();
              
                $usermodel_U = new Usuarios($db);
                $usermodel_U->select('id_direccion');
                $usermodel_U->where('id',$row_A->id_usuario);
                $usermodel_U->where('deleted',0);
                $resultado_U = $usermodel_U->get();
                $row_U = $resultado_U->getRow();

                $usermodel_D = new Direcciones($db);
                try {
                    $usermodel_A->update($id_alumno,$data_alummno);
                   
                } catch (\Exception $e) {
                    $data = ['Alumno'  => 'Los datos del alumno no se pudieron modificar'];
                    $this->session->set($data,true);
                    return redirect()->to(site_url("Alumnos/editaralumno/$id_alumno"));
                    
                }
                try {
                    $usermodel_U->update($row_A->id_usuario,$data_usuario);
                   
                }catch (\Exception $e) {
                    $data = ['Alumno'  => 'El datos del alumno no se pudieron actualizar'];
                    $this->session->set($data,true);
                    return redirect()->to(site_url("Alumnos/editaralumno/$id_alumno"));    
                }
                try {
                    $usermodel_D->update($row_U->id_direccion,$data_direccion);
                   
                }catch (\Exception $e) {
                    $data = ['Alumno'  => 'Los datos de la dirrecion del alumno no se pudieron modificar'];
                    $this->session->set($data,true);
                    return redirect()->to(site_url("Alumnos/editaralumno/$id_alumno"));
                }    
                
                $data = ['Alumno'  => 'El Alumno se modifico correctamente'];
                $this->session->set($data,true);

                return redirect()->to(site_url("Alumnos/editaralumno/$id_alumno"));
             }else{
                return redirect()->to(site_url('Home/salir'));
            }
            
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    //Funcion AJAX
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
    function Ajaxgrupos()
    {
        $REQUEST = \Config\Services::request();
        $id_plantel = $REQUEST->getPost('id_plantel');
        $id_unidadNegocio = $REQUEST->getPost('id_unidadNegocio');
        $usermode = new Grupos_model($db);
        $usermode->select('id,nombre');
        $usermode->where('id_unidad_negocio',$id_unidadNegocio);
        $usermode->where('id_plantel',$id_plantel);
        $usermode->where('deleted',0);
        $resultado = $usermode->get();
        $rowArray = $resultado->getResult();
        echo "<option value=''>Seleccione una opción</option>";
        foreach($rowArray as $fila){
            echo "<option value=$fila->id>$fila->nombre</option>";
        }

    }
    
    public function eliminarAlumno()
    {
        if($this->session->get('login') && $this->session->get('roll') == 4){
            if(isset($_POST['submitAL'])){

            $usermodel_D = new Direcciones($db);

            $REQUEST = \Config\Services::request();
            $id_alumno = $REQUEST->getPost('idAlumno');  

            $usermodel_A = new Alumnos_model($db);   
            $usermodel_A->select('id_usuario');
            $usermodel_A->where('id',$id_alumno);
            $usermodel_A->where('deleted',0);
            $resultado_A = $usermodel_A->get();
            $row_A = $resultado_A->getRow();
           
            $usermodel_U = new Usuarios($db);
            $usermodel_U->select('id_direccion');
            $usermodel_U->where('id',$row_A->id_usuario);
            $usermodel_U->where('deleted',0);
            $resultado_U = $usermodel_U->get();
            $row_U = $resultado_U->getRow();
            
            try {
                $usermodel_A->delete(['id'=> $id_alumno]);
                   
            } catch (\Exception $e) {
                $data = ['Alumno'  => 'No se pudo eleminar el alumno'];
                $this->session->set($data,true);
                return redirect()->to(site_url("Alumnos/editaralumno/$id_alumno"));
               
            }
            try {
                $usermodel_U->delete(['id' => $row_A->id_usuario]);
                   
            } catch (\Exception $e) {
                $DataDB = ['deleted' => 0,];
                $usermodel_A->update($id_alumno,$DataDB);
                $data = ['Alumno'  => 'No se pudo eleminar el alumno'];
                $this->session->set($data,true);
                return redirect()->to(site_url("Alumnos/editaralumno/$id_alumno"));
                
            }
            try {
                $usermodel_D->delete(['id' => $row_U->id_direccion]);
                   
            } catch (\Exception $e) {
                $DataDB = ['deleted' => 0,];
                $usermodel_A->update($id_alumno,$DataDB);
                $usermodel_U->update($id_alumno,$DataDB);
                $data = ['Alumno'  => 'No se pudo eleminar el alumno'];
                $this->session->set($data,true);

                return redirect()->to(site_url("Alumnos/editaralumno/$id_alumno"));
                
            }

            return redirect()->to(site_url('Alumnos/index'));
        
            }else{
                return redirect()->to(site_url('Home/salir'));
         }
   
        }else{
             return redirect()->to(site_url('Home/salir'));
        }
    }

}