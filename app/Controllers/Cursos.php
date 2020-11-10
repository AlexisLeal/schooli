<?php namespace App\Controllers;

class Cursos extends BaseController{

     
    public function index()
	{
        $data['page_title'] = "Cursos";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('cursos/panel_cursos',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	
    public function agregarcurso()
	{
        $data['page_title'] = "Agregar Curso";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('cursos/crear/agregar_curso',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}


    public function vercurso()
	{
        $data['page_title'] = "Vista detalle del Curso";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('cursos/mostrar/ver_curso',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    

    
    public function editarcurso()
	{
        $data['page_title'] = "Editar Nivel";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('cursos/editar/editar_curso',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }



}