<?php namespace App\Controllers;

class Teacher extends BaseController{

    public function index()
	{
        $title['page_title'] = "Maestros";	
        //Pasamos de forma dinamica el titulo  y se crear un array
		return view('teacher/teacher_crud',$title);
	}
	




}