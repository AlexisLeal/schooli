<?php namespace App\Controllers;

class Niveles extends BaseController{

     
    public function index()
	{
        $data['page_title'] = "Niveles";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('niveles/panel_niveles',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	


    public function agregarnivel()
	{
        $data['page_title'] = "Agregar Nivel";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('niveles/crear/agregar_nivel',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}


    public function vernivel()
	{
        $data['page_title'] = "Vista detalle Nivel";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('niveles/mostrar/ver_niveles',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }
    

    
    public function editarnivel()
	{
        $data['page_title'] = "Editar Nivel";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('niveles/editar/editar_niveles',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
    }


}