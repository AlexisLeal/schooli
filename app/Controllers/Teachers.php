<?php namespace App\Controllers;
use  App\Models\Usuarios; 
use  App\Models\Direcciones;
use  App\Models\Planteles;

class Teachers extends BaseController{

    public function index()
	{
        $data['page_title'] = "Teachers";	
        
        if($this->session->get('login')){
            return view('teachers/panel_teacher',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
	}
	

    public function agregarteacher()
	{
        $data['page_title'] = "Teachers";	
        
        if($this->session->get('login')){
            return view('teachers/crear/agregar_teacher');
            }else{
            return redirect()->to(site_url('Home/salir'));
        }
	}



}