<?php namespace App\Controllers;

class Alumnos extends BaseController{

    public function index()
	{
        $data['page_title'] = "Alumnos";	
        //Pasamos de forma dinamica el titulo  y se crear un array

        if($this->session->get('login')){
        return view('alumnos/alumnos_crud',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	




}