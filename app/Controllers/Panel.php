<?php namespace App\Controllers;
use  App\Models\Usuarios;

class Panel extends BaseController{

    public function index()
	{
        $this->response->setHeader('Cache-Control', 'no-cache');
        $REQUEST = \Config\Services::request();  

        if(isset($_POST['login'])){
                
            $datos = array(
                'credencial' => $REQUEST->getPost('credencial'),
                'inputPassword' => $REQUEST ->getPost('inputPassword'),
                'tipo_usuario' => $REQUEST ->getPost('tipo_usuario')
                    );

                    if($datos['credencial'] == null|| $datos['inputPassword'] == null || $datos['tipo_usuario'] == null){
                        //  || $datos['tipo_usuario'] == null  -> esta linea se va agregar mas adelante 
                        $data['page_title'] = "INBI";	
                         return view('login',$data);
                    }


        $usermodel = new Usuarios($db);
        $data['page_title'] = "Plataforma de evaluaciones INBI";	
        //Pasamos de forma dinamica el titulo propio de Codelgniter
		return view('panel',$data);
            
        }
    }
    
    //Posiblemente funcion temporal 
    public function panel()
    {
        $title['page_title'] = "Plataforma de evaluaciones INBI";	
        //Pasamos de forma dinamica el titulo propio de Codelgniter
		return view('panel',$title);
    }
	




}
