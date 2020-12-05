<?php namespace App\Controllers;

class Tutores extends BaseController{

    public function index()
	{	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login') && $this->session->get('roll') == 4 || 5){
            $data['page_title'] = "Tutores";
            return view('tutores/tutores_crud',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	




}