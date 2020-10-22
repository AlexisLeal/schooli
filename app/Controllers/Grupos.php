<?php namespace App\Controllers;

class Grupos extends BaseController{

    public function index()
	{
        $data['page_title'] = "Grupos";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('grupos/grupos_crud',$data);
        }
	}
	




}