<?php namespace App\Controllers;
use  App\Models\Tipo_Preguntas;
class Preguntas extends BaseController{

    public function agregar_preguntas()
	{
        if(isset($_POST['submitAP'])){
            $REQUEST = \Config\Services::request();  
            $data['idEvaluacion'] = $REQUEST->getPost('idEvaluacion');
            $data['nombre'] = $REQUEST->getPost('nombre');
            $data['tipo_evaluacion'] = $REQUEST->getPost('nombre_tipo_evaluacion');
            $data['usuario_creo'] = $REQUEST->getPost('usuario_creo');
            $data['estado'] = $REQUEST->getPost('estado');
            $data['du'] = $REQUEST->getPost('du');
            $data['clave'] = $REQUEST->getPost('clave');
            $data['valorpreguntas'] = $REQUEST->getPost('valorpreguntas');	
            $data['totalpreguntas'] = $REQUEST->getPost('totalpreguntas');	
            $data['page_title'] = "Preguntas";	
        if($this->session->get('login')){
        return view('evaluaciones/crear/agregar_preguntas',$data);
        }else{
            return redirect()->to(site_url('Home/salir'));
           }
	}
}

public function insertar()
{
    

}



}