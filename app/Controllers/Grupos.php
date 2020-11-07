<?php namespace App\Controllers;

class Grupos extends BaseController{

    public function index()
	{
        $data['page_title'] = "Grupos";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('grupos/panel_grupos',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	


    public function agregargrupo()
	{
        $data['page_title'] = "Teachers";	
        
        if($this->session->get('login')){
            return view('grupos/crear/agregar_grupo');
            }else{
            return redirect()->to(site_url('Home/salir'));
        }
	}

}