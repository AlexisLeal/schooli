<?php namespace App\Controllers;

class Recursos extends BaseController{

    public function recursos()
	{
        $data['page_title'] = "Recursos";	
         return view('recursos/recursos',$data);

	}
	
}