<?php namespace App\Controllers;
use  App\Models\Grupos_alumnos_model;

class Alumno extends BaseController{

    public function index()
	{
        if($this->session->get('login')){
            $db = \Config\Database::connect();
            $id_usuario= $this->session->get('id');
            $usermodel = $db->table('usuarios U');
            $usermodel->select('*');
            $usermodel->join('alumnos AL',"U.id = AL.id_usuario and U.id = $id_usuario");
            $usermodel->join(' grupo_alumnos G_AL','G_AL.id_alumno = U.id and G_AL.deleted = 0','left');
            $resultado = $usermodel->get();   
            $row = $resultado->getRow();
            $data['matricula'] = $row->matricula;
            $data['id_grupo'] = $row->id_grupo;
            $data['page_title'] = "Alumnos";	
            return view('alumnos/alumno/index_alumno',$data);
            }else{
                return redirect()->to(site_url('Home/salir'));
               }
	}
    
    public function evaluaciones()
    {
        if($this->session->get('login')){
            $usermodel = new Grupos_alumnos_model($db);
            $usermodel->select('id_grupo');
            $usermodel->where('id_alumno',$this->session->get('id'));
            $usermodel->where('deleted',0);
            $resultado = $usermodel->get();   
            $row = $resultado->getRow();
            if(empty($row)){
                $data['id_grupo'] = null;
            }else{
                $data['id_grupo'] = $row->id_grupo;
            }
            return view('alumnos/alumno/evaluaciones',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }

    public function presentarevaluacion($id_evaluacion)
    {
        if($this->session->get('login')){
            $data['id_evaluacion'] = $id_evaluacion;
            return view('alumnos/alumno/presentarevaluacion',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }

    public function perfil()
    {
        if($this->session->get('login')){
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




}