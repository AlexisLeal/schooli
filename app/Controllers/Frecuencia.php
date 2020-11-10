<?php namespace App\Controllers;

class Frecuencia extends BaseController{

    public function index()
	{
        $data['page_title'] = "Frecuencias";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('frecuencias/panel_frecuencias',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	
    public function agregarfrecuencia()
	{
        $data['page_title'] = "Frecuencias";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('frecuencias/crear/agregar_frecuencia',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    
    public function verfrecuencia()
	{
        $data['page_title'] = "Frecuencias";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('frecuencias/editar/ver_frecuencia',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    
    public function editarfrecuencia()
	{
        $data['page_title'] = "Frecuencias";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('frecuencias/editar/editar_frecuencia',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    
}