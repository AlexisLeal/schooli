<?php namespace App\Controllers;

class Ciclos extends BaseController{

     
    public function index()
	{
        $title['page_title'] = "Ciclos";	
        //Pasamos de forma dinamica el titulo  y se crear un array
		return view('ciclos/ciclos_crud',$title);
	}
	




}