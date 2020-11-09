<?php namespace App\Controllers;

class Ciclos extends BaseController{

     
    public function index()
	{
        $data['page_title'] = "Ciclos";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('cursos/panel_cursos',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	




}