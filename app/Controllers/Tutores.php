<?php namespace App\Controllers;

class Tutores extends BaseController{

    public function index()
	{
        $data['page_title'] = "Tutores";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('tutores/tutores_crud',$data);
        }
	}
	




}