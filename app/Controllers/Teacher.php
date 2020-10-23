<?php namespace App\Controllers;

class Teacher extends BaseController{

    public function index()
	{
        $data['page_title'] = "Maestros";	
        //Pasamos de forma dinamica el titulo  y se crear un array
        if($this->session->get('login')){
        return view('teacher/teacher_crud',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
	




}