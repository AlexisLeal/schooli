<?php namespace App\Controllers;

class Teachers extends BaseController{

    public function index()
	{
        $data['page_title'] = "Teachers";	
        
        if($this->session->get('login')){
            return view('teachers/teachers',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
	}
	




}