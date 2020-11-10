<?php namespace App\Controllers;

class Ciclos extends BaseController{

     
    public function index()
	{
        $data['page_title'] = "Ciclos";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('ciclos/panel_ciclos',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	
    public function agregarciclo()
	{
        $data['page_title'] = "Agregar un Ciclo";
        if($this->session->get('login')){
        $data['page_title'] = "Alumnos";	
        return view('ciclos/crear/agregar_ciclo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }

    public function verciclo()
	{
        $data['page_title'] = "Agregar un Ciclo";
        if($this->session->get('login')){
        $data['page_title'] = "Alumnos";	
        return view('ciclos/mostrar/ver_ciclo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }

    public function editarciclo()
	{
        $data['page_title'] = "Agregar un Ciclo";
        if($this->session->get('login')){
        $data['page_title'] = "Alumnos";	
        return view('ciclos/editar/editar_ciclo',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }


}