<?php namespace App\Controllers;

class Panel extends BaseController{

    public function index()
	{
        $title['page_title'] = "Plataforma de evaluaciones INBI";	
        //Pasamos de forma dinamica el titulo 
		return view('panel',$title);
	}
	




}
