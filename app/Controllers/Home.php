<?php namespace App\Controllers;
use  App\Models\Tipo_usuarios;
class Home extends BaseController{
	
	public function index()
	{
		$usermodel = new Tipo_usuarios($db);
		$query = "Select id,nombre FROM  tipo_usuarios";
		$resultado = $usermodel ->query($query);	
		// Lo comvertimos del tipo array 
		$rowArray = $resultado -> getResult();

		//Se guia por las etiquetas codelgniter
		$data['page_title'] = "INBI";	
		$data['rowArray'] = $rowArray;	
			
		return view('login',$data,);
	}
	


	//--------------------------------------------------------------------

}