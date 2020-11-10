<?php namespace App\Controllers;

class Ciclos extends BaseController{

     
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
	




}