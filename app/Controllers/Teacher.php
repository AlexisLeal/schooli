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
    


    public function asistencia()
	{
        if($this->session->get('login') && $this->session->get('roll') == 3){
            $data['page_title'] = "Teacher";
            return view('teachers/teacher/asistencia',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }
    

    public function getContenidoGrupoAsignado($id_grupo)
	{
        if($this->session->get('login') && $this->session->get('roll') == 3){
            $data['page_title'] = "Teacher";
            $data['id_grupo'] = $id_grupo;

            return view('teachers/teacher/contenidogrupo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
    }
    

}


