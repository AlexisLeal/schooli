<?php namespace App\Controllers;

class Horarios extends BaseController{

     
    public function index()
	{
        $data['page_title'] = "Horarios";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('horarios/panel_horarios',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	

    public function agregarhorario()
	{
        $data['page_title'] = "Agregar Horario";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('horarios/crear/agregar_horario',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}


    public function verhorario()
	{
        $data['page_title'] = "Vista detalle de Horario";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('horarios/mostrar/ver_horarios',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    

    
    public function editarhorario()
	{
        $data['page_title'] = "Editar Horario";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('horarios/editar/editar_horarios',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }




}