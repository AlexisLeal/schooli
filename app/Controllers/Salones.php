<?php namespace App\Controllers;

class Salones extends BaseController{

     
    public function index()
	{
        $data['page_title'] = "Salones";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('salones/panel_salones',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	

    public function agregarsalon()
	{
        $data['page_title'] = "Agregar Nivel";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('salones/crear/agregar_salon',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}


    public function versalon()
	{
        $data['page_title'] = "Vista detalle Salon";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('salones/mostrar/ver_salon',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    

    
    public function editarsalon()
	{
        $data['page_title'] = "Editar Salon";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('salones/editar/editar_salon',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }


}