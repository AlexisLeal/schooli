<?php namespace App\Controllers;
class Home extends BaseController{
	
	public function index()
	{
		$data['page_title'] = "INBI";	
				
		return view('login',$data);
	}
	
	function salir()
	{
		$this->session->destroy();		
		return redirect()->to(site_url('Home/index'));	
	}
}