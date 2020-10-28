<?php namespace App\Controllers;

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




}



/*else if($_GET['id']){
    // ya se inserto una pregunta y se esta haciendo Back.
  
    $idEvaluacion     = $_GET['id'];
    $sqlEvaluaciones  = "SELECT id,nombre,
    (select nombre from tipo_evaluacion where id=tipo_evaluacion) as nombre_tipo_evaluacion,
    (select nombre from usuarios where id=usuario_creo ) as usuario_creo,
    estado,clave,directorio_uploads
    FROM evaluaciones where id=$idEvaluacion";
  
    $qEval = $conn->query($sqlEvaluaciones);
    
    $data             = $qEval->fetch_assoc();
    $nombre           = $data['nombre'];
    $tipo_evaluacion  = $data['nombre_tipo_evaluacion'];
    $usuario_creo     = $data['usuario_creo'];
    $estado           = $data['estado'];
    $clave            = $data['clave'];
    $du               = $data['directorio_uploads'];
  

*/
