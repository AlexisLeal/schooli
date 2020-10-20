<?php namespace App\Controllers;

class Home extends BaseController{
	
	public function index()
	{       
	

		$title['page_title'] = "INBI";	
		return view('login',$title);
	}
	


	//--------------------------------------------------------------------

}
