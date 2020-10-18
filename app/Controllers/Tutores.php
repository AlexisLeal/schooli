<?php namespace App\Controllers;

class Tutores extends BaseController{

    public function index()
	{
        $title['page_title'] = "Tutores";	
        //Pasamos de forma dinamica el titulo  y se crear un array
		return view('tutores/tutores_crud',$title);
	}
	




}