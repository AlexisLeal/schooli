<?php namespace App\Controllers;
use  App\Models\Usuarios;
use  App\Models\Maestros;
use  App\Models\Asistencias;

class Teacher extends BaseController{

    public function index()
	{
        if($this->session->get('login') && $this->session->get('roll') == 3){
            $data['page_title'] = "Teacher";
            return view('teachers/teacher/index_teacher',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }
    

    public function getContenidoGrupoAsignado($id_grupo,$id_unidad_negocio,$id_plantel)
	{
        if($this->session->get('login') && $this->session->get('roll') == 3){
            $data['page_title'] = "Teacher";
            $data['id_grupo'] = $id_grupo;
            $data['id_unidad_negocio'] = $id_unidad_negocio;
            $data['id_plantel'] = $id_plantel;

            return view('teachers/teacher/contenidogrupo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }
    
    
    public function alumnosasignados($id_grupo,$id_unidad_negocio,$id_plantel)
	{
        if($this->session->get('login') && $this->session->get('roll') == 3){
            $data['page_title'] = "Teacher";
            $data['id_grupo'] = $id_grupo;
            $data['id_unidad_negocio'] = $id_unidad_negocio;
            $data['id_plantel'] = $id_plantel;
            return view('teachers/teacher/alumnosasignados',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }


    public function recursosasignados($id_grupo)
	{
        if($this->session->get('login') && $this->session->get('roll') == 3){
            $data['page_title'] = "Teacher";
            $data['id_grupo'] = $id_grupo;
            return view('teachers/teacher/recursosasignados',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }


    public function asistencia($id_grupo,$id_unidad_negocio,$id_plantel)
	{
        if($this->session->get('login') && $this->session->get('roll') == 3){
            $id_grupo;
            $id_teacher;
            $num_semana;
            $hoy = date("Y-m-d");            
            $data['page_title'] = "Teacher";
            $data['id_grupo'] = $id_grupo;
            $data['id_unidad_negocio'] = $id_unidad_negocio;
            $data['id_plantel'] = $id_plantel;
            return view('teachers/teacher/asistencia',$data);

        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }



    public function insertar_asistencia()
	{
        if($this->session->get('login') && $this->session->get('roll') == 3){
            $REQUEST           = \Config\Services::request();
            $id_grupo          = $REQUEST->getPost('id_grupo');
            $id_teacher        = $REQUEST->getPost('id_teacher');
            $num_semana        = $REQUEST->getPost('num_semana');
            $alumnosComa       = $REQUEST->getPost('alumnos');
            $id_unidad_negocio = $REQUEST->getPost('id_unidad_negocio');
            $id_plantel        = $REQUEST->getPost('id_plantel');
            $hoy               = date("Y-m-d");
            $idAlumno          = explode(",", $alumnosComa);
            $usermodel         = new Asistencias();

            foreach($idAlumno as $fila){            
                $data = ['id_grupo'=> $id_grupo,
                'id_usuario' =>$fila,
                'id_teacher'=>$id_teacher,
                'numero_de_semana'=>$num_semana,
                'fecha_asistencia'=>$hoy,
                'valor_asistencia'=> $REQUEST->getPost($fila),
                'fecha_creacion' => $hoy, 
                'fecha_ultimo_cambio' => $hoy,
                ];
                $usermodel->insert($data);
                $data = ['Asistencia'  => 'Se registro la asistencia correctamente'];
                $this->session->set($data,true);
                
            }
            $data['page_title']  = "Teacher";
            $data['id_grupo']    = $id_grupo;
            $data['id_unidad_negocio'] = $id_unidad_negocio;
            $data['id_plantel']  = $id_plantel;

            return view('teachers/teacher/contenidogrupo',$data);

        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }


}


