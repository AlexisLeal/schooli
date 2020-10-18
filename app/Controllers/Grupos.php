<?php namespace App\Controllers;

class Grupos extends BaseController{

    public function index()
	{
        $title['page_title'] = "Grupos";	
        //Pasamos de forma dinamica el titulo  y se crear un array
		return view('grupos/grupos_crud',$title);
	}
	




}