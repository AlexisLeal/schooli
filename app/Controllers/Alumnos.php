<?php namespace App\Controllers;

class Alumnos extends BaseController{

    public function index()
	{
        $title['page_title'] = "Alumnos";	
        //Pasamos de forma dinamica el titulo  y se crear un array
		return view('alumnos/alumnos_crud',$title);
	}
	




}