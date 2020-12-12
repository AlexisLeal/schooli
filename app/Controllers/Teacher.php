<?php namespace App\Controllers;
use  App\Models\Usuarios;
use  App\Models\Maestros;


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
            // Obtener las variables post
            // Insertar en la base de datos
            // Crear variable de session y regresar a el contenido del grupo
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

}


