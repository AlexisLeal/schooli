<?php namespace App\Controllers;


class Panel extends BaseController{

    public function index()
	{
        if($this->session->get('login') && $this->session->get('roll') == 4 ){
            
            $data['page_title'] = "Plataforma de evaluaciones INBI";

		    return view('panel',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
        }
     }
	

}



