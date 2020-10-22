<?php namespace App\Controllers;

class Evaluaciones extends BaseController{

    public function index()
	{
        $data['page_title'] = "Evaluaciones";	
        //Pasamos de forma dinamica el titulo  y se crear un array
		return view('evaluaciones/tipo_evaluaciones',$data);
    }
    
    public function tipo_evaluacion()
    {
        # ESTA REGRESA LA VISTA Del tipo de evulacion que haya escodigo segun el usuario 
        #Por mientras sera un ejemplo

        return view('evaluaciones/pagina_temporal');
    }
    
    public function crear_evaluacion()
    {
        return view('evaluaciones/crear_evaluaciones');
        
    }





}